<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OC\ChevalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use OC\ChevalBundle\Entity\Cheval;
use OC\ChevalBundle\Entity\Soin;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Description of ChevalController
 *
 * @author Alexis
 */
class ChevalController extends Controller {
    
    public function indexAction(){
        
        $repository = $this
                       ->getDoctrine()
                       ->getManager()
                       ->getRepository('OCChevalBundle:Cheval');

                $chevaux = $repository->findAll();
        
         return $this->render('OCChevalBundle:Affichage:chevaux.html.twig',array('chevaux'=>$chevaux));
    }
    
    public function addAction(Request $request){
            $cheval = new Cheval();

    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $cheval);


    $formBuilder
      ->add('nom',   TextType::class)
      ->add('race',   TextType::class)
      ->add('robe',   TextType::class)
      ->add('pere',   TextType::class)
      ->add('mere',   TextType::class)
      ->add('sexe', ChoiceType::class , array(
             'choices' => array('Mâle' => 'Mâle', 'Femelle' => 'Femelle'),
             'expanded' => true,
             'multiple' => false))
      ->add('file',null,array('label'=>'Photo de profil'))
      ->add('proprietaire',   TextType::class)
      ->add('naisseur',   TextType::class)
      ->add('taille',   NumberType::class)
      ->add('dateDeNaissance',   DateType::class)
      ->add('Ajouter',      SubmitType::class);
   
    $form = $formBuilder->getForm();
    
    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) 
          {
          if ($form->get('file')->getData()!=null){
                $cheval->uploadProfilePicture();
                }
        $em = $this->getDoctrine()->getManager();
        
        $em->persist($cheval);
        $em->flush();
       
        $request->getSession()->getFlashBag()->add('notice', 'Cheval bien enregistrée.');

        return $this->redirectToRoute('oc_cheval_afficher');
      }
    }
    

    return $this->render('OCChevalBundle:Affichage:ajouter.html.twig', array(
      'form' => $form->createView(),));
    }
    
    public function ficheAction($id,Request $request){
        $em = $this->getDoctrine()->getManager();
        $cheval=$this->getDoctrine()->getManager()->getRepository('OCChevalBundle:Cheval')->find($id);
        if (!$cheval){
            throw $this->createNotFoundException('Impossible d\'accéder à ce cheval');
        }
        $soins = $em->getRepository('OCChevalBundle:Soin')->findBy(array('cheval' => $cheval),array('date'=>'asc'));
        $soin = new Soin($cheval);
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $soin);
        $formBuilder->add('date',     DateType::class)
                    ->add('type',     TextType::class)
                    ->add('ajouter',    SubmitType::class);
        $form = $formBuilder->getForm();
        if ($request->isMethod('POST')) {
             $form->handleRequest($request);
        
         if ($form->isValid()) {
              $em->persist($soin);
              $em->flush();
              $request->getSession()->getFlashBag()->add('notice', 'Soin bien enregistrée.');
              return $this->redirectToRoute('oc_cheval_fiche',array('id'=>$id));
         }
         }
        
        return $this->render('OCChevalBundle:Affichage:cheval.html.twig', array(
            'cheval'=>$cheval, 'soins'=>$soins, 'form'=>$form->createView(),));
    }
    
    
    public function supAction($id,Request $request){
        $em = $this->getDoctrine()->getManager();
        $cheval= $em->getRepository('OCChevalBundle:Cheval')->find($id);
        if (!$cheval){
            throw $this->createNotFoundException('Impossible de supprimer ce cheval');
        }
           $soins = $em->getRepository('OCChevalBundle:Soin')->findBy(array('cheval' => $cheval));
           foreach($soins  as $soin) {
               $em->remove($soin);
           }
        $em->remove($cheval);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Cheval bien supprimé.');
        return $this->redirectToRoute('oc_cheval_afficher');
        
    }
    
    public function modifierAction($id,Request $request){
         $em = $this->getDoctrine()->getManager();
        $cheval=$this->getDoctrine()->getManager()->getRepository('OCChevalBundle:Cheval')->find($id);
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $cheval);
        if (!$cheval){
            throw $this->createNotFoundException('Impossible de modifier ce cheval');
        }
        $formBuilder 
                    ->add('nom',   TextType::class)
                    ->add('race',   TextType::class)
                    ->add('robe',   TextType::class)
                    ->add('pere',   TextType::class)
                    ->add('mere',   TextType::class)
                    ->add('sexe', ChoiceType::class , array(
             'choices' => array('Mâle' => 'Mâle', 'Femelle' => 'Femelle'),
             'expanded' => true,
             'multiple' => false))
                ->add('description', TextareaType::class,array('label' => 'Description'))
                ->add('file',null,array('label'=>'Photo de profil'));
        $formBuilder->add('Modifier',      SubmitType::class);
        $formBuilder->setData($cheval);
        $form = $formBuilder->getForm();
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            if ($cheval->getPictureName()==null){
                if ($form->get('file')->getData()!=null){
                $cheval->uploadProfilePicture();
                }
            } else {
                if ($form->get('file')->getData()!=null){
                $cheval->uploadProfilePictureModif();
                }
            }
             
            $cheval->setDescription($form->get('nom')->getData());
            $cheval->setDescription($form->get('race')->getData());
            $cheval->setDescription($form->get('pere')->getData());
            $cheval->setDescription($form->get('mere')->getData());
            $cheval->setDescription($form->get('sexe')->getData());
            $cheval->setDescription($form->get('description')->getData());
            $em->flush(); 
            return $this->redirectToRoute('oc_cheval_fiche',array('id'=>$id));
        }
        
        return $this->render('OCChevalBundle:Affichage:modifier.html.twig', array(
            'form' => $form->createView()));
    }
    public function supSoinAction($id,Request $request){
        $em = $this->getDoctrine()->getManager();
        $soin= $em->getRepository('OCChevalBundle:Soin')->find($id);
        if (!$soin){
            throw $this->createNotFoundException('Impossible de supprimer ce soin');
        }
        $em->remove($soin);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Soin bien supprimé.');
        return $this->redirectToRoute('oc_cheval_fiche',array('id'=>$soin->getCheval()->getId()));
        
    }
}
