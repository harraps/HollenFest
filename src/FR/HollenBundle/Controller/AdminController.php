<?php

namespace FR\HollenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('FRHollenBundle:Admin:index.html.twig');
    }

/* Users */
    public function listUsersAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:User');

        $users = $repository->findAll();

        return $this->render('FRHollenBundle:Admin:list_users.html.twig', array(
            'users' => $users
        ));
    }
    
    public function grantUserAction($id)
    {
        $userMan = $this->get('fos_user.user_manager');
        $user = $userMan->findUserBy(array( 'id' => $id ));
        $user->addRole("ROLE_ADMIN");
        $userMan->updateUser($user);

        return $this->listUsersAction();
    }
    
    public function ungrantUserAction($id)
    {
        
    }
    
    public function removeUserAction($id)
    {
        $userMan = $this->get('fos_user.user_manager');
        $user = $userMan->findUserBy(array( 'id' => $id ));
        $userMan->deleteUser($user);
        
        return $this->listUsersAction();
    }
    
/* Rockbands */
    public function listRockbandsAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Rockband');

        $rockbands = $repository->findAll();

        return $this->render('FRHollenBundle:Admin:list_rockbands.html.twig', array(
            'rockbands' => $rockbands
        ));
    }
    
    public function addRockbandAction($data)
    {
        
    }
    
    public function updateRockbandAction($id)
    {

    }
    
    public function removeRockbandAction($id)
    {
        
    }
    
/* Concerts */
    public function listConcertsAction()
    {
        
    }
    
    public function addConcertAction($data)
    {
        
    }
    
    public function updateConcertAction($id)
    {

    }
    
    public function removeConcertAction($id)
    {
        
    }

}