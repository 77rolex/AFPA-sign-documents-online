<?php

namespace App\Form;

use App\Entity\Convention;
use App\Entity\Formulaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;



class FormulaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('SocietyName', TextType::class, 
                [
                    'label' => 'Nom de la société:',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: Samsung',
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('SocietyAdress', TextType::class, 
                [
                    'label' => "Adresse de la société:",
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: 23 rue du Soleil',
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('SIRETSIREN', TextType::class, 
                [
                    'label' => 'SIRET/SIREN:',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: 999777333',
                        'inputmode' => 'numeric',
                        'pattern' => '[0-9]*',
                        'id' => 'siretInput'
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('Quality', TextType::class, 
                [
                    'label' => 'Qualité de stagiaire:',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: Developpeur WEB/WEB Mobile',
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('GuardianName', TextType::class, 
                [
                    'label' => 'Nom du tuteur de stage:',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: John SNOW',
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('GuardianEmail', TextType::class, 
                [
                    'label' => 'Email du tuteur:',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: j.snow@gmail.com',
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('GuardianPhone', TextType::class, 
                [
                    'label' => 'Téléphone du tuteur:',
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: 0669065553',
                        'pattern' => '[0-9]*',
                        'inputmode' => 'numeric',
                        'pattern' => '[0-9]*',
                        'id' => 'phoneInput'
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('StartDate', DateType::class, 
                [
                    'widget' => 'single_text',
                    'label' => 'Date de début de stage:',
                    'attr' => ['class' => 'form-control'],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('EndDate', DateType::class, 
                [
                    'widget' => 'single_text',
                    'label' => 'Date de fin de stage:',
                    'attr' => ['class' => 'form-control'],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('TrainingAdvisor', TextType::class, 
                [
                    'label' => "Conseiller en formation:",
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: Brad PITT 0687542345',
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
            ->add('TrainerOfIntern', TextType::class, 
                [
                    'label' => "Formateur de stagiaire:",
                    'attr' => [
                        'class' => 'form-control',
                        'placeholder' => 'ex: Tom CROUZE 0789345478',
                    ],
                    'row_attr' => ['class' => 'form-row'],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Formulaire::class,
        ]);
    }
}
