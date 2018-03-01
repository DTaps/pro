<?php

namespace OC\RationBundle\Controller;

use OC\RationBundle\Entity\Ration;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
	public function indexAction()
	{
		$rations = $this->getDoctrine()->getRepository('OCRationBundle:Ration')->findAll();

		return $this->render('OCRationBundle:Default:index.html.twig',array('rations'=>$rations));
	}

	public function sauver() {
		foreach ($rations as $value) {
			$ration = new Ration();
			$ration->setNom($value.nom);
			$ration->setMatin($value.matin);
			$ration->setMidi($value.midi);
			$ration->setSoir($value.soir);
			$em = $this->getDoctrine()->getManager();
			$em->persist($ration);
			$em->flush();
		}
	}

}
