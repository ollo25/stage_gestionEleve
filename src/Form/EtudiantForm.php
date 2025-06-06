<?php

namespace App\Form;

use App\Entity\Alternance;
use App\Entity\Etudiant;
use App\Entity\Promotion;
use App\Entity\Stage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtudiantForm extends AbstractType
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
            ->add('refStage', EntityType::class, [
                'class' => Stage::class,
                'choice_label' => function (Stage $stage) {
                    return $stage->getPoste()."(".$stage->getRefEntreprise()->getNom().")";
                },
                'attr' => ['class' => 'form-select'],
                'label' => 'Stage associé',
                'placeholder' => 'Sélectionnez un stage',
                'required' => false
            ])
            ->add('refAlternance', EntityType::class, [
                'class' => Alternance::class,
                'choice_label' => function (Alternance $alternance) {
                return $alternance->getPoste()." (".$alternance->getRefEntreprise()->getNom().")";
                },
                'attr' => ['class' => 'form-select'],
                'label' => 'Alternance associée',
                'placeholder' => 'Sélectionnez une alternance',
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
