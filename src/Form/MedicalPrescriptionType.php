<?php
namespace App\Form;

use App\Entity\MedicalPrescription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MedicalPrescriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('patientName', TextType::class, ['label' => 'Patient Name'])
            ->add('reasonForVisit', TextType::class, ['label' => 'Reason for Visit'])
            ->add('medicine', TextType::class, ['label' => 'Medicine'])
            ->add('nextAppointment', DateType::class, ['widget' => 'single_text'])
            ->add('save', SubmitType::class, ['label' => 'Save Prescription']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MedicalPrescription::class,
        ]);
    }
}
