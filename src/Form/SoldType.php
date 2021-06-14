<?php

namespace App\Form;

use App\Entity\Sold;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoldType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options){
       
        $builder
            ->add('address', TextType::class, ['label' => 'Adresse'])
            ->add('postalcode', TextType::class, ['label' => 'Code Postal'])
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('age', TextType::class, ['label' => 'Age'])
            ->add('tel', TextType::class, ['label' => 'Téléphone'])
            ->add('country', TextType::class, ['label' => 'ville'])
            ->add('code', Sold::class, ['label' => 'Code promo',
                                        'class' => TextType::class]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sold::class
        ]);
    }
}
