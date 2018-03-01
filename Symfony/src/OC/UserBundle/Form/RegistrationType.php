<?php 


namespace OC\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;


class RegistrationType extends AbstractType {
	
 public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('nom', TextType::class)
                ->add('prenom', TextType::class)
                ->add('date_de_naissance', BirthdayType::class,array('label' => 'Date de naissance'))
                ->add('num_telephone', NumberType::class, array('label' => 'Numéro de téléphone'))
                ->add('file',null,array('label'=>'Photo de profil'))
                ->add('CU_nom', TextType::class,array('label' => 'Nom'))
                ->add('CU_prenom', TextType::class,array('label' => 'Prénom'))
                ->add('CU_num_telephone',  NumberType::class, array('label' => 'Numéro de téléphone'))
                ->add('CU_profession', TextType::class,array('label' => 'Profession'))
                ->add('CU_addr_postale',null,array('label' => 'Adresse postale'));
        
    }
	
	public function getParent(){
		return 'FOS\UserBundle\Form\Type\RegistrationFormType';
	}
        
        public function getBlockPrefix()
    {
        return 'oc_user_registration';
    }

	    public function getName()
    {
        return $this->getBlockPrefix();
    }

}


?>