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
                'choice_label' => function (User $user) {
                return $user->getPrenom() . ' ' . $user->getNom();
                }
            ])
            ->add('refEtudiant', EntityType::class, [
                'class' => Etudiant::class,
                'choice_label' => fn(Etudiant $e) => $e->getPrenom() . ' ' . $e->getNom(),
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
