<?php

namespace FR\HollenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FRHollenBundle:Default:index.html.twig');
    }
    
    public function editUserAction()
    {
        
    }
    
    public function planningAction($stage_id, $begin_int, $end_int, $genre_id)
    {
        // we send the running order of the user so he could edit it
        $runningOrder = $this->getUser()->getRunningOrder();
        
        $repo_stages = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Stage');
        
        $repo_concerts = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Concert');
        
        // we search for the stages asked by the user
        $concerts_stage = [];
        if( $stage_id == "ALL" ){ // we want all the stages
            $stages = $repo_stages->findAll();
            foreach( $stages as &$stage ){
                $concerts_stage[$stage->getName()] = $repo_concerts->findByStage($stage);
            }
        }else{ // we only want the given stage
            $stage = $repo_stages->findById($stage_id);
            $concerts_stage[$stage->getName()] = $repo_concerts->findByStage($stage);
        }
        
        // we search for all the concerts starting after the begin time
        if( $begin_int != "NO_BEGIN" ){
            $begin_int = (int) $begin_int;
            foreach( $concerts_stage as &$s ){
                foreach( $s as $key => &$concert ){
                    // we only want the concerts starting after the begin time
                    if( $concert->beginint() < $begin_int ){
                        unset($s[$key]); // the concert doesn't match the requirement, we remove it
                    }
                }
            }
        }
        
        // we search for all the concerts ending after the end time
        if( $end_int != "NO_END" ){
            $end_int = (int) $end_int;
            foreach( $concerts_stage as &$s ){
                foreach( $s as $key => &$concert ){
                    // we only want the concert ending before the end time
                    if( $concert->endint() > $end_int ){
                        unset($s[$key]); // the concert doesn't match the requirement, we remove it
                    }
                }
            }
        }
        
        // we search for the concerts featuring a rockband of the given genre
        $genre_name;
        if( $genre_id == "ANY" ){
            $genre_name = "ANY";
        }else{
            $genre_id = (int) $genre_id;
            foreach( $concerts_stage as &$s ){
                foreach( $s as $key => &$concert ){
                    // we only want the rockbands of the given genre
                    if( !$concert->getRockband()->isGenreById($genre_id) ){
                        unset($s[$key]); // the concert doesn't match the requirement, we remove it
                    }
                } 
            }
            // we want to get the name of the genre
            $repo_genre = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('FRHollenBundle:Genre');
            $genre_name = $genre_repo->findById($genre_id);
        }
        
        // we want the global begin and end times so the running order fit the concerts correctly
        $global_begin = PHP_INT_MAX;
        $global_end = 0;
        foreach( $concerts_stage as &$s ){
            foreach( $s as &$c ){
                if( $global_begin > $c->beginint() ){
                    $global_begin = $c->beginint();
                }
                if( $global_end < $c->endint() ){
                    $global_end = $c->endint();
                }
            }
        }
        
        return $this->render('FRHollenBundle:Default:planning.html.twig', array(
            'runningOrder' => $runningOrder,
            'stages' => $concerts_stage,
            'begin' => $global_begin,
            'end' => $global_end,
            'genre' => $genre_name
        ));
    }
    
    public function otherAction()
    {
        return $this->render('FRHollenBundle:Default:other.html.twig');
    }
    
}
