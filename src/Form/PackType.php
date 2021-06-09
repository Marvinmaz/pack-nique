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

class PackType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du pack'])
            ->add('picture', FileType::class, [
                'label' => 'Image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '4096k',
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/webp'],
                        'mimeTypesMessage' => 'Merci de mettre une image en format jpeg, jpg, png ou webp',
                    ])
                ],
            ])
            ->add('price', MoneyType::class, ['label' => 'Prix'])
            ->add('categories', ChoiceType::class, [
                'label' => 'Catégories',
                'choices' => Pack::STANDARD_CATEGORIES,
            ])
            ->add('content', TextType::class, ['label' => 'Contenu']);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([

        ]);
    }
}