<?php

namespace FR\HollenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FR\HollenBundle\Entity\Genre;
use FR\HollenBundle\Entity\Rockband;
use FR\HollenBundle\Entity\Stage;
use FR\HollenBundle\Entity\Concert;
use FR\HollenBundle\Entity\User;


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
        $em = $this->getDoctrine()->getEntityManager();
        $runningOrder = $this->getUser()->getConcerts();
        
        // we send the running order of the user so he could edit it
        $repo_stages = $em->getRepository('FRHollenBundle:Stage');
        $repo_concerts = $em->getRepository('FRHollenBundle:Concert');
        
        // we search for the stages asked by the user
        $concerts_stage = [];
        if( $stage_id == "ALL" ){ // we want all the stages
            $stages = $repo_stages->findAll();
            foreach( $stages as &$stage ){
                $concerts_stage[$stage->getName()] = $repo_concerts->findBy(
                    array( 'stage' => $stage ),
                    array( 'beginTime' => "asc" ),
                    null,
                    null
                );
            }
        }else{ // we only want the given stage
            $stage = $repo_stages->findById($stage_id);
            $concerts_stage[$stage->getName()] = $repo_concerts->findBy(
                array( 'stage' => $stage ),
                array( 'beginTime' => "asc" ),
                null,
                null
            );
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
            $repo_genre = $em->getRepository('FRHollenBundle:Genre');
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
            'orders' => $runningOrder,
            'stages' => $concerts_stage,
            'begin' => $global_begin,
            'end' => $global_end,
            'genre' => $genre_name
        ));
    }
    
    public function addOrderAction($id)
    {
        $em = $this->getDoctrine()->getmanager();
        $repo_concert = $em->getRepository('FRHollenBundle:Concert');
        
        $concert = $repo_concert->findOneById($id);
        $user = $this->getUser();
        
        if( $concert == null ){
            return $this->render('FRHollenBundle:Default:index.html.twig');
        }
        
        $user->addConcert($concert);
        
        $this->get('fos_user.user_manager')->updateUser($user);
        $em->flush();
        
        return $this->PlanningAction("ALL","NO_BEGIN","NO_END","ANY");
    }
    
    public function removeOrderAction($id)
    {
        $em = $this->getDoctrine()->getmanager();
        $repo_concert = $em->getRepository('FRHollenBundle:Concert');
        
        $concert = $repo_concert->findOneById($id);
        $user = $this->getUser();
        
        if( $concert == null ){
            return $this->render('FRHollenBundle:Default:index.html.twig');
        }
        
        $user->removeConcert($concert);
        
        $this->get('fos_user.user_manager')->updateUser($user);
        $em->flush();
        
        return $this->PlanningAction("ALL","NO_BEGIN","NO_END","ANY");
    }
    
    public function otherAction()
    {
        return $this->render('FRHollenBundle:Default:other.html.twig');
    }
    public function html2pdfAction()
    {
        //on stocke la vue à convertir en PDF, en n'oubliant pas les paramètres twig si la vue comporte des données dynamiques
        $html = $this->renderView('FRHollenBundle:Default:index.html.twig', array('name' => "planning"));
         
        //on instancie la classe Html2Pdf_Html2Pdf en lui passant en paramètre
        //le sens de la page "portrait" => p ou "paysage" => l
        //le format A4,A5...
        //la langue du document fr,en,it...
        $html2pdf = new \Html2Pdf_Html2Pdf('P','A4','fr');
 
        //SetDisplayMode définit la manière dont le document PDF va être affiché par l’utilisateur
        //fullpage : affiche la page entière sur l'écran
        //fullwidth : utilise la largeur maximum de la fenêtre
        //real : utilise la taille réelle
        $html2pdf->pdf->SetDisplayMode('real');
 
        //writeHTML va tout simplement prendre la vue stocker dans la variable $html pour la convertir en format PDF
        $html2pdf->writeHTML($html);
 
        //Output envoit le document PDF au navigateur internet avec un nom spécifique qui aura un rapport avec le contenu à convertir (exemple : Facture, Règlement…)
        $html2pdf->Output('Facture.pdf');
         
     
        return new Response();
    }
}
