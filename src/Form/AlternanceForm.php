<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Alternance;
use App\Entity\Entreprise;

class AlternanceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('poste', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Support réseau'
                ],
                'label' => 'Poste'
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Potentiels détails'
                ],
                'label' => 'Description'
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Date de début'
            ])
            ->add('dateFin', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Date de fin'
            ])
            ->add('coutContrat', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Coût du contrat'
            ])
            ->add('tuteurProfesseur', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Nom du tuteur'
                ],
                'label' => 'Tuteur professeur'
            ])
            ->add('refEntreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'nom',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Entreprise'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Alternance::class,
        ]);
    }
}
