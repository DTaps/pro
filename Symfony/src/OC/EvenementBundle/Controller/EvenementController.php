<?php

namespace OC\EvenementBundle\Controller;
use OC\EvenementBundle\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Response;

class EvenementController extends Controller
{
    public function affparticipantsAction($id){
        $evenement = $this->getDoctrine()->getManager()->getRepository('OCEvenementBundle:Evenement')->find($id);
        return $this->render('OCEvenementBundle:Affichage:evenement.html.twig',array('evenement'=>$evenement));
        
    }
    
 public function participationAction($id,$choix,Request $request){
     $rep=$this->getDoctrine()->getManager()->getRepository('OCEvenementBundle:Evenement');
     $em = $this->getDoctrine()->getManager();
     $evenement = $em->getRepository('OCEvenementBundle:Evenement')->find($id);
     $user = $this->get('security.token_storage')->getToken()->getUser();

     if ($choix == 'participant') {
       if ($rep->estNonParticipant($evenement,$user)){
           $evenement->removeNon_Participant($user);
       }
       if (!$rep->estParticipant($evenement,$user)){
         $evenement->addParticipant($user);
         $em->flush(); 
         $request->getSession()->getFlashBag()->add('message', 'Participation enregistrée');
       } else {
           $request->getSession()->getFlashBag()->add('message', 'Participation déjà enregistrée');
       }
         
     } else if ($choix == 'nonparticipant'){
         if ($rep->estParticipant($evenement,$user)){
           $evenement->removeParticipant($user);
       }
       if (!$rep->estNonParticipant($evenement,$user)){
        $evenement->addNon_Participant($user);
        $em->flush();
        $request->getSession()->getFlashBag()->add('message', 'Non participation  enregistrée');
       }  else {
        $request->getSession()->getFlashBag()->add('message', 'Non participation déjà enregistrée');
       }    
     }
     return $this->redirectToRoute('oc_evenement_afficher');
 }   
 
 
     public function formAction(Request $request){
        
        $formulaire = $this->createFormBuilder()
            ->add('search', SearchType::class, array('constraints' => new Length(array('min' => 2)), 'attr' => array('placeholder' => 'Type d\'évènement')))
            ->add('send', SubmitType::class, array('label' => 'Rechercher'))
            ->getForm();
 
        $formulaire->handleRequest($request);
        return $formulaire;
    }
    
    
    public function indexAction(Request $request) {
        $repository = $this
                       ->getDoctrine()
                       ->getManager()
                       ->getRepository('OCEvenementBundle:Evenement');
        $listeEvenement = $repository->findAll();
        $formulaire = EvenementController::formAction($request);    
        if($formulaire->isSubmitted() && $formulaire->isValid()) {
            $search = $formulaire['search']->getData();
            return $this->redirectToRoute('oc_evenement_search',array('search'=>$search));
        }
        return $this->render('OCEvenementBundle:Affichage:afficher.html.twig', array(
      'formulaire' => $formulaire->createView(), 'listeEvenement' => $listeEvenement));      
    }
      
       public function searchAction(Request $request){
        $type = $request->query->get('search');
        $rep = $this->getDoctrine()->getManager()->getRepository('OCEvenementBundle:Evenement');
        $listeEvenement=$rep->findByType($type);
        $formulaire = EvenementController::formAction($request);
        return $this->render('OCEvenementBundle:Affichage:afficher.html.twig',
                array('formulaire' => $formulaire->createView(),
                    'listeEvenement' => $listeEvenement));
        }
    
    
    
     public function addAction(Request $request){
         $evenement = new Evenement();
    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $evenement);
    $formBuilder
      ->add('type',   TextType::class)
      ->add('date', DateType::class)
      ->add('lieu', TextType::class)
      ->add('description', TextareaType::class)
      ->add('Ajouter',      SubmitType::class);
    $form = $formBuilder->getForm();

    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($evenement);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Evenement bien enregistrée.');
        return $this->redirectToRoute('oc_evenement_afficher');
      }
    }
      return $this->render('OCEvenementBundle:Affichage:add.html.twig', array(
      'form' => $form->createView(),));
}


public function supAction($id,Request $request){
        $rep = $this->getDoctrine()->getManager()->getRepository('OCEvenementBundle:Evenement');
        $em = $this->getDoctrine()->getManager();
        $evenement = $rep->find($id);
        if (!$evenement){
            throw $this->createNotFoundException('Impossible de supprimer cet évènement');
        }
        $em->remove($evenement);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Evenement bien supprimé.');
        return $this->redirectToRoute('oc_evenement_afficher');
        
    }
    




}