<?php

namespace App\Form;

use App\Entity\Convocation;
use App\Entity\Etudiant;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConvocationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Date')
            ->add('Motif')
            ->add('Description')
            ->add('ActionMiseEnPlace')
            ->add('refResponsable', EntityType::class, [
                'class' => User::class,
                'disabled' => true,
            ])
            ->add('refEtudiant', EntityType::class, [
                'class' => Etudiant::class,
                'disabled' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Convocation::class,
        ]);
    }
}
