<?php

namespace App\Form;

use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Ex: Société XYZ'
                ],
                'label' => 'Nom de l\'entreprise'
            ])
            ->add('siret', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '123 456 789 00012'
                ],
                'label' => 'Numéro SIRET'
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '5 Av. du Général de Gaulle, 93440 Dugny',
                    'id' => 'autocomplete-input',
                    'autocomplete' => 'off'
                ],
                'label' => 'Adresse complète',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
        ]);
    }
}
