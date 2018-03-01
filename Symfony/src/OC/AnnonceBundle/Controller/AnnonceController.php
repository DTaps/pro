<?php

namespace OC\AnnonceBundle\Controller;
use OC\AnnonceBundle\Entity\Annonce;
use OC\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
class AnnonceController extends Controller
{
  
    public function indexAction()
    {
        
    $repository = $this
                       ->getDoctrine()
                       ->getManager()
                       ->getRepository('OCAnnonceBundle:Annonce');

                $listeAnnonce = $repository->findAll();
                    
        return $this->render('OCAnnonceBundle:Affichage:annonce.html.twig',array('listeAnnonce' => $listeAnnonce));
    }
    
    public function addAction(Request $request){
        
         $annonce = new Annonce();

    $formBuilder = $this->get('form.factory')->createBuilder(FormType::class, $annonce);


    $formBuilder
      ->add('message',   TextareaType::class)
      ->add('Ajouter',      SubmitType::class);
   
    $form = $formBuilder->getForm();
    
    if ($request->isMethod('POST')) {
      $form->handleRequest($request);

      if ($form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($annonce);
        $em->flush();
        
        /*$repositoryuser = $this
                       ->getDoctrine()
                       ->getManager()
                       ->getRepository('OCUserBundle:User');
        $listeuser = $repositoryuser->find(5);
      
        $listeemail = array();
        
        foreach ($listeuser as $user){
            array_push($listeemail, $user->getEmail());
        }
        
        $mailer = $this->get('mailer');
        $message = \Swift_Message::newInstance();
        $message
                ->setSubject('test')
                ->setFrom('alexis.legrain@orange.fr')
                ->setTo($listeemail)
                ->setBody($annonce->getMessage());
        $mailer->send($message);*/
        
        $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

        return $this->redirectToRoute('oc_annonce_afficher');
      }
    }
    

    return $this->render('OCAnnonceBundle:Affichage:admin.html.twig', array(
      'form' => $form->createView(),));
    }
    
    public function supAction($id){
        $rep = $this->getDoctrine()->getManager()->getRepository('OCAnnonceBundle:Annonce');
        $em = $this->getDoctrine()->getManager();
        $annonce = $rep->find($id);
        if (!$annonce){
            throw $this->createNotFoundException('Impossible de supprimer cette annonce');
        }
        $em->remove($annonce);
        $em->flush();
      
        return $this->redirectToRoute('oc_annonce_afficher');
        
    }
}
