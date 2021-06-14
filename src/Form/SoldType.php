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
            // ->add('user', UserInfoType::class, ["label" => "Coordonnées"])
            ->add('code', TextType::class, ['label' => 'Code promo']);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Sold::class
        ]);
    }
}
