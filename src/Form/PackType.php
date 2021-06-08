<?php

namespace App\Form;

use App\Entity\Pack;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PackType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom du pack'])
            ->add('picture', TextType::class, ['label' => 'Image'])
            ->add('price', TextType::class, ['label' => 'Prix'])
            ->add('categories', TextType::class, ['label' => 'Catégorie'])
            ->add('content', TextType::class, ['label' => 'Contenu']);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([

        ]);
    }
}