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
                'label' => 'Ton prénom'
            ))
            ->add('lastname', TextType::class, array(
                'label' => 'Ton nom de famille'
            ))
            ->add('phoneNumber', TextType::class, array('label' => 'Ton numéro de téléphone', 'attr' => array('placeholder' => 'Ex: 33782922697')))
            ->add('alcoholOptin', CheckboxType::class, array('label' => 'Tu bois ?', 'required' => false))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Participant',
        ));
    }
}