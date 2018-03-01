<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace OC\UserBundle\Controller;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

use FOS\UserBundle\Controller\ProfileController as BaseController;



/**
 * Description of ProfileController
 *
 * @author Alexis
 */
class ProfileController extends BaseController 
{
         public function editAction(Request $request)
    {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory FactoryInterface */
        $formFactory = $this->get('fos_user.profile.form.factory');
          $form = $formFactory->createForm();
          $form->remove('username');    
          $form->remove('email');
          $form->add('num_telephone',  NumberType::class, array('label' => 'Numéro de téléphone'))
                ->add('file',null,array('label'=>'Photo de profil'))
                ->add('CU_nom', TextType::class,array('label' => 'Nom contact du d\'urgence'))
                ->add('CU_prenom', TextType::class,array('label' => 'Prénom contact du d\'urgence'))
                ->add('CU_num_telephone',  NumberType::class, array('label' => 'Numéro de téléphone du contact d\'urgence'))
                ->add('CU_profession', TextType::class,array('label' => 'Profession du  contact d\'urgence'))
                ->add('CU_addr_postale',null,array('label' => 'Adresse postale du contact d\'urgence'));
          $form->setData($user);
        
        
        

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($user->getPictureName()==null){
                if ($form->get('file')->getData()!=null){
                $user->uploadProfilePicture();
                }
            } else {
                if ($form->get('file')->getData()!=null){
                $user->uploadProfilePictureModif();
                }
            }
            /** @var $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);
            
            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_show');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}