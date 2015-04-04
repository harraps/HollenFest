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
        return $this->render('FRHollenBundle:Default:planning.html.twig');
    }
    
    
}
