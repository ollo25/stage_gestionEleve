<?php

namespace App\Form;

use App\Entity\PotentielEleve;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PotentielEleveForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Dupont'
                ],
                'label' => 'Nom de famille'
            ])
            ->add('Prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Jean'
                ],
                'label' => 'Prénom'
            ])
            ->add('Email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'jean.dupont@example.com'
                ]
            ])
            ->add('Telephone', TelType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '0612345678'
                ],
                'label' => 'Téléphone'
            ])
            ->add('NumDossierPsup', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '123456'
                ],
                'label' => 'Numéro dossier Parcoursup'
            ])
            ->add('FiliereEnvisage', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Informatique'
                ],
                'label' => 'Filière envisagée'
            ])
            ->add('AncienEtablissement', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Lycée Descartes'
                ],
                'label' => 'Ancien établissement'
            ])
            ->add('refResponsable', EntityType::class, [
                'class' => User::class,
                'choice_label' => function(User $user) {
                    return $user->getNom() . ' ' . $user->getPrenom();
                },
                'attr' => ['class' => 'form-select'],
                'label' => 'Responsable',
                'placeholder' => 'Sélectionnez un responsable'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PotentielEleve::class,
        ]);
    }
}
