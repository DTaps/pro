<?php

namespace OC\CoursBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ElevePresenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('username', EntityType::class, array(
            'class' => 'OC\UserBundle\Entity\User',
            'choice_label' => 'username'
        ))
        ->add('jour', ChoiceType::class, array(
            'choices' => array(
                "Mardi" => "mardi",
                "Mercredi" => "mercredi",
                "Vendredi" => "vendredi",
                "Samedi" => "samedi",
                "Dimanche" => "dimanche",
            )
        ))
        ->add('plage', ChoiceType::class, array(
            'choices' => array(
                "10h00-11h00" => "10h00-11h00",
                "11h00-12h00" => "11h00-12h00",
                "14h00-15h00" => "14h00-15h00", 
                "15h00-16h00" => "15h00-16h00", 
                "16h00-17h00" => "16h00-17h00",
                "17h00-18h00" => "17h00-18h00",
                "17h30-18h30" => "17h30-18h30",
                "18h45-19h45" => "18h45-19h45",
                "19h00-20h00" => "19h00-20h00",                 
            )
        ))
        ->add('Envoyer', SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OC\CoursBundle\Entity\ElevePresence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'oc_coursbundle_elevepresence';
    }


}
