<?php



namespace OC\UserBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Description of CavaliersController
 *
 * @author Alexis
 */
class CavaliersController extends Controller {
    function cavaliersAction(){
        $repository = $this->getDoctrine()->getManager()->getRepository('OCUserBundle:User');
                $cavaliers = $repository->findAll();
        return $this->render('OCUserBundle:Cavaliers:afficher.html.twig',array('cavaliers' => $cavaliers));
    }
    
    function ficheAction($id){
        $user=$this->getDoctrine()->getManager()->getRepository('OCUserBundle:User')->find($id);
        if (!$user){
            throw $this->createNotFoundException('Impossible d\'accéder à ce cavalier');
        }
        return $this->render('OCUserBundle:Cavaliers:cavalier.html.twig',array('user' => $user));
        
    }
    }
    

