<?php

namespace FR\HollenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FRHollenBundle:Default:index.html.twig');
    }
    
    public function planningAction($stage, $day)
    {
        $runningOrder = $this->getUser()->getRunningOrder();
        
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Stage');
        
        $result = [];
        $stages = [];
        
        if( $stage == "ALL" ){ // we want all the stages
            
            $stages = $repository->findAll();
            
        }else{ // we only want the given stage
            
            $stages = $repository->findByName($stage);
            
        }
        
        if( $day == "ALL" ){ // we want all days
            
            $result = $stages;
            
        }else{ // we only want the given day
            
            $day = (int) $day;
            foreach( $stages as &$s ){
                $concerts = [];
                foreach( $s->getConcerts() as &$concert ){
                    // beginint return the date in minutes so we divide it by (60*24) to get the days
                    if( $concert->getBeginTime()->format("d") == $day ){
                        $concerts[] = $concert;
                    }
                }
                
                // we create a new stage object to store only the concerts starting the given day
                $new_stage = new Stage();
                $new_stage->setId($s->getId())
                    ->setName($s->getName())
                    ->setConcerts($concerts);
                
                $result[] = $new_stage;
                
            }
        }
        
        $begin = PHP_INT_MAX;
        $end = 0;
        
        foreach( $result as &$s ){
            foreach( $s->getConcerts() as &$c ){
                if( $begin > $c->beginint() ){
                    $begin = $c->beginint();
                }
                if( $end < $c->endint() ){
                    $end = $c->endint();
                }
            }
        }
        
        return $this->render('FRHollenBundle:Default:planning.html.twig', array(
            'runningOrder' => $runningOrder,
            'stages' => $result,
            'begin' => $begin,
            'end' => $end,
            'day' => $day
        ));
    }
    
}
