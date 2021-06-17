<?php

namespace App\Form;

use App\Entity\Pack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PackType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du pack'])          // Permet d'ajouter le nom du pack
            ->add('picture', FileType::class, [                                 // Permet d'ajouter une photo du pack
                'label' => 'Image',
                'mapped' => false,                                              
                'required' => false,                                            // Permet de ne pas mettre obligatoirement de photo
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',                                   // Poids maximum de la photo : 4M
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],                       // Format des photos acceptées
                        'mimeTypesMessage' => 'Merci de mettre une image en format jpeg, jpg, png ou webp',         // Gestion de l'erreur du format d'image
                    ])
                ],
            ])
            ->add('price', MoneyType::class, ['label' => 'Prix'])               // Permet d'ajouter un prix
            ->add('categories', ChoiceType::class, [                            // Permet d'ajouter une catégorie
                'label' => 'Catégories',
                'choices' => Pack::STANDARD_CATEGORIES,
            ])
            ->add('content', TextareaType::class, ['label' => 'Contenu']);      // Permet une description du pack
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Pack::class
        ]);
    }
}