<?php

namespace App\Form;

use App\Entity\Alternance;
use App\Entity\Etudiant;
use App\Entity\Promotion;
use App\Entity\Stage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Dupont'
                ],
                'label' => 'Nom de famille'
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Jean'
                ],
                'label' => 'Prénom'
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'jean.dupont@example.com'
                ]
            ])
            ->add('telephone', TelType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0612345678'
                ],
                'label' => 'Téléphone'
            ])
            ->add('handicap', CheckboxType::class, [
                'label' => 'Handicap',
                'row_attr' => ['class' => 'form-check mb-3'],
                'attr' => ['class' => 'form-check-input'],
                'required'=>false
            ])
            ->add('note', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Informations supplémentaires ...',
                ],
                'label'=>'Note',
                'required' => false

            ])

            ->add('refPromotion', EntityType::class, [
                'class' => Promotion::class,
                'choice_label' => function(Promotion $promotion) {
                    return $promotion->getAnnee() . ' - ' . $promotion->getFiliere();
                },
                'attr' => ['class' => 'form-select'],
                'label' => 'Promotion',
                'placeholder' => 'Sélectionnez une promotion'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudiant::class,
        ]);
    }
}
