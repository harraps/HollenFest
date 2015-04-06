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
    
    public function planningAction($stage, $begin, $end, $genre)
    {
        // we send the running order of the user so he could edit it
        $runningOrder = $this->getUser()->getRunningOrder();
        
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Stage');
        
        // we search for the stages asked by the user
        $stages = [];
        if( $stage == "ALL" ){ // we want all the stages
            $stages = $repository->findAll();
        }else{ // we only want the given stage
            $stages = $repository->findById($stage);
        }
        
        // we search for all the concerts starting after the begin time
        $stages_begin = [];
        if( $begin == "NO_BEGIN" ){
            $stages_begin = $stages;
        }else{
            $begin = (int) $begin;
            foreach( $stages as &$s ){
                $concerts = [];
                foreach( $s->getConcerts() as &$concert ){
                    // we only want the concerts starting after the begin time
                    if( $concert->beginint() >= $begin ){
                        $concerts[] = $concert;
                    }
                }
                // we create a new stage object to store the concerts
                $new_stage = new Stage();
                $new_stage->setId($s->getId())
                    ->setName($s->getName())
                    ->setConcerts($concerts);
                $stages_begin[] = $new_stage; 
            }
        }
        
        // we search for all the concerts ending after the end time
        $stages_end = [];
        if( $end == "NO_END" ){
            $stages_end = $stages_begin;
        }else{
            $end = (int) $end;
            foreach( $stages_begin as &$s ){
                $concerts = [];
                foreach( $s->getConcerts() as &$concert ){
                    // we only want the concert ending before the end time
                    if( $concert->endint() <= $end ){
                        $concerts[] = $concert;
                    }
                }
                // we create a new stage object to store the concerts
                $new_stage = new Stage();
                $new_stage->setId($s->getId())
                    ->setName($s->getName())
                    ->setConcerts($concerts);
                $stages_end[] = $new_stage; 
            }
        }
        
        // we search for the concerts featuring a rockband of the given genre
        $result = [];
        $genre_name;
        if( $genre == "ANY" ){
            $result = $stages_end;
            $genre_name = "ANY";
        }else{
            $genre = (int) $genre;
            foreach( $stages_end as &$s ){
                $concerts = [];
                foreach( $s->getConcerts() as &$concert ){
                    // we only want the rockbands of the given genre
                    if( $concert->getRockband()->isGenreById($genre) ){
                        $concerts[] = $concert;
                    }
                }
                // we create a new stage object to store the concerts
                $new_stage = new Stage();
                $new_stage->setId($s->getId())
                    ->setName($s->getName())
                    ->setConcerts($concerts);
                $result[] = $new_stage;  
            }
            // we want to get the name of the genre
            $genre_repo = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('FRHollenBundle:Genre');
            $genre_name = $genre_repo->findById($genre);
        }
        
        // we want the global begin and end times so the running order fit the concerts correctly
        $global_begin = PHP_INT_MAX;
        $global_end = 0;
        foreach( $result as &$s ){
            foreach( $s->getConcerts() as &$c ){
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
            'stages' => $result,
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
