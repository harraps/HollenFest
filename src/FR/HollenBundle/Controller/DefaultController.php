<?php

namespace FR\HollenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('FRHollenBundle:Default:index.html.twig');
    }
    
    public function planningAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Stage');
        
        $stages = $repository->findAll();
        
        return $this->render('FRHollenBundle:Default:planning.html.twig', array(
            'stages' => $stages
        ));
    }
    
}
