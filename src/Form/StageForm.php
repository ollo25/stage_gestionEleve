<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Stage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StageForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Poste', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: Développeur web'
                ],
                'label' => 'Poste proposé'
            ])
            ->add('Description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 5,
                    'placeholder' => 'Décrivez les missions du stage...'
                ]
            ])
            ->add('DateDebut', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control datepicker'],
                'label' => 'Date de début'
            ])
            ->add('DateFin', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control datepicker'],
                'label' => 'Date de fin'
            ])
            ->add('refEntreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'Nom',
                'attr' => ['class' => 'form-select'],
                'label' => 'Entreprise',
                'placeholder' => 'Sélectionnez une entreprise'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stage::class,
        ]);
    }
}
