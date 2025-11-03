<?php
// src/Form/FormulaireFilterType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormulaireFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('studentName', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de stagiaire'
                ]
            ])
            // ->add('societyName', TextType::class, [
            //     'label' => 'Nom de la société',
            //     'required' => false,
            //     'attr' => [
            //         'class' => 'form-control',
            //         'placeholder' => 'Rechercher par nom de société'
            //     ]
            // ])
            // ->add('guardianName', TextType::class, [
            //     'label' => 'Nom du tuteur',
            //     'required' => false,
            //     'attr' => [
            //         'class' => 'form-control',
            //         'placeholder' => 'Rechercher par nom de tuteur'
            //     ]
            // ])
            // ->add('trainingAdvisor', TextType::class, [
            //     'label' => 'Conseiller en formation',
            //     'required' => false,
            //     'attr' => [
            //         'class' => 'form-control',
            //         'placeholder' => 'Rechercher par conseiller'
            //     ]
            // ])
            ->add('startDateFrom', DateType::class, [
                'label' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('startDateTo', DateType::class, [
                'label' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control']
            ])
            ->add('sortBy', ChoiceType::class, [
                'label' => false,
                'required' => false,
                'choices' => [
                    'Date de création (récent)' => 'created_desc',
                    'Date de création (ancien)' => 'created_asc',
                    'Date de début (proche)' => 'start_date_asc',
                    'Date de début (lointain)' => 'start_date_desc',
                    'Nom stagiaire (A-Z)' => 'student_asc',
                    'Nom stagiaire (Z-A)' => 'student_desc',
                ],
                'data' => 'created_desc',
                'attr' => ['class' => 'form-control']
            ])
            // ->add('filter', SubmitType::class, [
            //     'label' => false,
            //     'attr' => ['id' => 'btnFilter',
            //         'class' => 'btnFilter'
            //     ]
            // ])
            ->add('reset', SubmitType::class, [
                'label' => false,
                'attr' => ['class' => 'btnReset']
            ]);
    }

    // public function configureOptions(OptionsResolver $resolver): void
    // {
    //     $resolver->setDefaults([
    //         'method' => 'GET',
    //         'csrf_protection' => false,
    //     ]);
    // }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'method' => 'GET',
            'csrf_protection' => false,
            'allow_extra_fields' => true,
        ]);
    }
}