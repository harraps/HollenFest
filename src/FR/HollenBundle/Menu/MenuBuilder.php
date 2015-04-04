<?php

namespace FR\HollenBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware{
    
    public function leftMenu( FactoryInterface $factory, array $options ){
        $menu = $factory->createItem('root');
        return $menu;
    }
    
    public function rightMenu( FactoryInterface $factory, array $options ){
        $menu = $factory->createItem('root');
        return $menu;
    }
    
    public function mainMenu( FactoryInterface $factory, array $options ){
        
        $menu = $factory->createItem('root');
        
        /* Exemple pour renvoyer aux groupe entrain de jouer
        // access services from the container!
        $em = $this->container->get('doctrine')->getManager();
        // findMostRecent and Blog are just imaginary examples
        $blog = $em->getRepository('AppBundle:Blog')->findMostRecent();
        
        $menu->addChild('Latest Blog Post', array(
            'route' => 'blog_show',
            'routeParameters' => array('id' => $blog->getId())
        ));*/
        
        /* Exemple pour faire des sous-menus
        // create another menu item
        $menu->addChild('About Me', array('route' => 'about'));
        // you can also add sub level's to your menu's as follows
        $menu['About Me']->addChild('Edit profile', array('route' => 'edit_profile'));
        */
        
        return $menu;
    }
    
}