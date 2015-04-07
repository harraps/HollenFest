<?php

namespace FR\HollenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FR\HollenBundle\Entity\Genre;
use FR\HollenBundle\Entity\Rockband;
use FR\HollenBundle\Entity\Stage;
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
    
    public function addGenreAction(Request $request, $id = null)
    {
        $genre;
        if( $id == null ){
            $genre = new Genre();
        }else{
            $genre = $this->getDoctrine()
                ->getManager()
                ->getRepository('FRHollenBundle:Genre')
                ->find($id);
        }
        
        $form = $this->get('form.factory')->createBuilder('form', $genre)
            ->add( 'name', 'text' )
            ->add( 'save', 'submit' )
            ->getForm();
        
        // we make a link between the request and the form
        $form->handleRequest($request);
        
        // we check that the values are correct
        if( $form->isValid() ){
            
            // we save the genre in the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($genre);
            $em->flush();
            
            // we redirect the the list of genres
            return $this->listGenresAction();
        }
        
        // here the request is invalid so we return to the form
        return $this->render('FRHollenBundle:Admin:Genre/add.html.twig', array(
            'form' => $form->createView()
        ));
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
        
        return $this->render('FRHollenBundle:Admin:Rockband/list.html.twig', array(
            'rockbands' => $rockbands
        ));
    }
    
    public function addRockbandAction(Request $request, $id = null)
    {
        $rockband;
        if( $id == null ){
            $rockband = new Rockband();
        }else{
            $rockband = $this->getDoctrine()
                ->getManager()
                ->getRepository('FRHollenBundle:Rockband')
                ->find($id);
        }
        
        $form = $this->get('form.factory')->createBuilder('form', $rockband)
            ->add( 'name', 'text' )
            ->add( 'genres', 'entity', array(
                'class' => 'FRHollenBundle:Genre',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true
            ))
            ->add( 'save', 'submit' )
            ->getForm();
        
        // we make a link between the request and the form
        $form->handleRequest($request);
        
        // we check that the values are correct
        if( $form->isValid() ){
            
            // we save the genre in the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($rockband);
            $em->flush();
            
            // we redirect the the list of genres
            return $this->listRockbandsAction();
        }
        
        // here the request is invalid so we return to the form
        return $this->render('FRHollenBundle:Admin:Rockband/add.html.twig', array(
            'form' => $form->createView()
        ));
    }
        
    public function removeRockbandAction($id)
    {
        // first we find the object in the database
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Rockband');
        $rockband = $repository->find($id);
        
        // than we delete it
        $entityMan = $this->getDoctrine()->getEntityManager();
        $entityMan->remove($rockband);
        $entityMan->flush();
        return $this->listRockbandsAction();
    }
    
/* Stages */
    public function listStagesAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Stage');
        
        $stages = $repository->findAll();
        
        return $this->render('FRHollenBundle:Admin:Stage/list.html.twig', array(
            'stages' => $stages
        ));
    }
    
    public function addStageAction(Request $request, $id = null)
    {
        $stage;
        if( $id == null ){
            $stage = new Stage();
        }else{
            $stage = $this->getDoctrine()
                ->getManager()
                ->getRepository('FRHollenBundle:Stage')
                ->find($id);
        }
        
        $form = $this->get('form.factory')->createBuilder('form', $stage)
            ->add( 'name', 'text' )
            ->add( 'save', 'submit' )
            ->getForm();
        
        // we make a link between the request and the form
        $form->handleRequest($request);
        
        // we check that the values are correct
        if( $form->isValid() ){
            
            // we save the genre in the database
            $em = $this->getDoctrine()->getManager();
            $em->persist($stage);
            $em->flush();
            
            // we redirect the the list of genres
            return $this->listStagesAction();
        }
        
        // here the request is invalid so we return to the form
        return $this->render('FRHollenBundle:Admin:Stage/add.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function removeStageAction($id)
    {
        // first we find the object in the database
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Stage');
        $stage = $repository->find($id);
        
        // than we delete it
        $entityMan = $this->getDoctrine()->getEntityManager();
        $entityMan->remove($stage);
        $entityMan->flush();
        return $this->listStagesAction();
    }
    
/* Concerts */
    public function listConcertsAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Concert');
        
        $concerts = $repository->findAll();
        
        return $this->render('FRHollenBundle:Admin:Concert/list.html.twig', array(
            'concerts' => $concerts
        ));
    }
    
    public function addConcertAction(Request $request, $id = null)
    {
        $concert;
        if( $id == null ){
            $concert = new Concert();
        }else{
            $concert = $this->getDoctrine()
                ->getManager()
                ->getRepository('FRHollenBundle:Concert')
                ->find($id);
        }
        
        $form = $this->get('form.factory')->createBuilder('form', $concert)
            ->add( 'rockband', 'entity', array(
                'class' => 'FRHollenBundle:Rockband',
                'property' => 'name',
                'multiple' => false,
                'expanded' => true
            ))
            ->add( 'stage', 'entity', array(
                'class' => 'FRHollenBundle:Stage',
                'property' => 'name',
                'multiple' => false,
                'expanded' => true
            ))
            ->add( 'beginTime', 'datetime' )
            ->add( 'endTime', 'datetime' )
            ->add( 'save', 'submit' )
            ->getForm();
        
        // we make a link between the request and the form
        $form->handleRequest($request);
        
        // we check that the values are correct
        // and that the times are correct
        if( $form->isValid() ){
            
            if( $concert->checkTimes() ){
                
                // we have to remove all the other concert overlaping with the new one
                $repository = $this
                    ->getDoctrine()
                    ->getManager()
                    ->getRepository('FRHollenBundle:Concert');
                
                // we want a list of other concerts on the same stage
                $concerts_stage = $repository->findByStage($concert->getStage());
                
                // we want a list of other concerts with the same rockband
                $concerts_band = $repository->findByRockband($concert->getRockband());
                
                $em = $this->getDoctrine()->getManager();
                
                // if the concert overlap with other concerts on the same stage, we remove them
                foreach( $concerts_stage as &$c ){
                    if( $concert->checkSpace($c) ){
                        $em->remove($c);
                        $em->flush();
                    }
                }
                
                // if the concert overlap with other concerts with the same group, we remove them
                foreach( $concerts_band as &$c ){
                    if( $concert->checkSpace($c) ){
                        $em->remove($c);
                        $em->flush();
                    }
                }
                
                // we finally save the concert
                $em->persist($concert);
                $em->flush();
                
                // we redirect the the list of genres
                return $this->listConcertsAction();
            }
        }
        
        // here the request is invalid so we return to the form
        return $this->render('FRHollenBundle:Admin:Concert/add.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    public function removeConcertAction($id)
    {
        // first we find the object in the database
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('FRHollenBundle:Concert');
        $concert = $repository->find($id);
        
        // than we delete it
        $entityMan = $this->getDoctrine()->getEntityManager();
        $entityMan->remove($concert);
        $entityMan->flush();
        return $this->listConcertsAction();
    }

}