<?php

namespace OC\CoursBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use OC\CoursBundle\Entity\ElevePresence;
use OC\CoursBundle\Entity\Semaines;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use OC\CoursBundle\Form\ElevePresenceType;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
    	$repo = $this
    	->getDoctrine()
    	->getManager()
    	->getRepository('OCCoursBundle:ElevePresence');
    	$un = $repo->findBy(
    		array('jour' => 'mardi', 'plage' => '17h30-18h30')
    	);
    	$deux = $repo->findBy(
    		array('jour' => 'mardi', 'plage' => '19h00-20h00')
    	);
    	$trois = $repo->findBy(
    		array('jour' => 'mercredi', 'plage' => '14h00-15h00')
    	);
    	$quatre = $repo->findBy(
    		array('jour' => 'mercredi', 'plage' => '15h00-16h00')
    	);
    	$cinq = $repo->findBy(
    		array('jour' => 'mercredi', 'plage' => '16h00-17h00')
    	);
    	$six = $repo->findBy(
    		array('jour' => 'mercredi', 'plage' => '17h00-18h00')
    	);
    	$sept = $repo->findBy(
    		array('jour' => 'vendredi', 'plage' => '17h30-18h30')
    	);
    	$huit = $repo->findBy(
    		array('jour' => 'vendredi', 'plage' => '18h45-19h45')
    	);
    	$neuf = $repo->findBy(
    		array('jour' => 'samedi', 'plage' => '10h00-11h00')
    	);
    	$dix = $repo->findBy(
    		array('jour' => 'samedi', 'plage' => '11h00-12h00')
    	);
    	$onze = $repo->findBy(
    		array('jour' => 'samedi', 'plage' => '14h00-15h00')
    	);
    	$douze = $repo->findBy(
    		array('jour' => 'samedi', 'plage' => '15h00-16h00')
    	);
     	$treize = $repo->findBy(
    		array('jour' => 'samedi', 'plage' => '16h00-17h00')
    	);
     	$quatorze = $repo->findBy(
    		array('jour' => 'dimanche', 'plage' => '10h00-11h00')
    	);
     	$quinze = $repo->findBy(
    		array('jour' => 'dimanche', 'plage' => '11h00-12h00')
    	);
    	$repo = $this
    	->getDoctrine()
    	->getManager()
    	->getRepository('OCUserBundle:User');
    	$user = $repo->findAll();
    	$eleve = new ElevePresence();
    	$form = $this->get('form.factory')->create(ElevePresenceType::class, $eleve);
    	if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      		$em = $this->getDoctrine()->getManager();
      		$em->persist($eleve);
      		$em->flush();

      		$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

      		return $this->redirectToRoute('oc_cours_homepage');
    		}
        return $this->render('OCCoursBundle:Cour:ajout_eleve.html.twig', array(
        	'form' => $form->createView(),'un'=>$un,'deux'=>$deux,'trois'=>$trois,'quatre'=>$quatre,'cinq'=>$cinq,'six'=>$six,'sept'=>$sept,'huit'=>$huit,'neuf'=>$neuf,'dix'=>$dix,'onze'=>$onze,'douze'=>$douze,'treize'=>$treize,'quatorze'=>$quatorze,'quinze'=>$quinze,
        ));
    }
    public function supAction($id) {
        $rep = $this->getDoctrine()->getManager()->getRepository('OCCoursBundle:ElevePresence');
        $em = $this->getDoctrine()->getManager();
        $eleve = $rep->find($id);
        $em->remove($eleve);
        $em->flush();
        return $this->redirectToRoute('oc_cours_homepage');
    }
}
