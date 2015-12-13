<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
                'attr' => array('placeholder' => 'Ton prénom'),
                'label' => false
            ))
            ->add('lastname', TextType::class, array(
                'attr' => array('placeholder' => 'Ton nom'),
                'label' => false
            ))
            ->add('phoneNumber', TextType::class, array('attr' => array('placeholder' => '33782922697'),'label' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Participant',
        ));
    }
}
