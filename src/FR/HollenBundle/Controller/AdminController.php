<?php

namespace FR\HollenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FR\HollenBundle\Entity\Genre;
use FR\HollenBundle\Entity\Rockband;
use FR\HollenBundle\Entity\Concert;

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
        $userMan = $this->get('fos_user.user_manager');
        $user = $userMan->findUserBy(array( 'id' => $id ));
        $user->removeRole("ROLE_ADMIN");
        $userMan->updateUser($user);
        
        return $this->listUsersAction();
    }
    
    public function removeUserAction($id)
    {
        $userMan = $this->get('fos_user.user_manager');
        $user = $userMan->findUserBy(array( 'id' => $id ));
        $userMan->deleteUser($user);
        
        return $this->listUsersAction();
    }
    
/* Genres */
    public function listGenresAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Genre');

        $genres = $repository->findAll();

        return $this->render('FRHollenBundle:Admin:Genre/list.html.twig', array(
            'genres' => $genres
        ));
    }
    
    public function addGenreAction()
    {
        $genre = new Genre();
        $formBuilder = $this->get('form.factory')->createBuilder('form', $genre);
        
        // we add the field needed
        $formBuilder
            ->add( 'name', 'text' )
            ->add( 'save', 'submit' );
        
        // we generate the form
        $form = $formBuilder->getForm();
        
        return $this->render('FRHollenBundle:Admin:Genre/add.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function updateGenreAction($id)
    {
        
    }
    
    public function removeGenreAction($id)
    {
        // first we find the object in the database
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Genre');
        $genre = $repository->find($id);
        
        // than we delete it
        $entityMan = $this->getDoctrine()->getEntityManager();
        $entityMan->remove($genre);
        $entityMan->flush();
        return $this->listGenresAction();
    }
    
/* Rockbands */
    public function listRockbandsAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Rockband');

        $rockbands = $repository->findAll();

        return $this->render('FRHollenBundle:Admin:Rockband:list.html.twig', array(
            'rockbands' => $rockbands
        ));
    }
    
    public function addRockbandAction()
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
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Concert');

        $concerts = $repository->findAll();

        return $this->render('FRHollenBundle:Admin:Concert:list.html.twig', array(
            'concerts' => $concerts
        ));
    }
    
    public function addConcertAction()
    {
        
    }
    
    public function updateConcertAction($id)
    {

    }
    
    public function removeConcertAction($id)
    {
        
    }

}