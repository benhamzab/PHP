<?php

namespace App\Form;

use App\Entity\Secretary;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class SecretaryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('phoneNumber', TextType::class, [
                'label' => 'Phone Number'
            ])
            ->add('assignedTasks', TextareaType::class, [
                'label' => 'Assigned Tasks',
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Secretary::class,
        ]);
    }
}
