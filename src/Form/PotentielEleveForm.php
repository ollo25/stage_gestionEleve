<?php

namespace App\Form;

use App\Entity\PotentielEleve;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PotentielEleveForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Prenom')
            ->add('Email')
            ->add('telephone')
            ->add('numDossierPsup')
            ->add('filiereEnvisage')
            ->add('ancienEtablissement')
            ->add('refResponsable', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PotentielEleve::class,
        ]);
    }
}
