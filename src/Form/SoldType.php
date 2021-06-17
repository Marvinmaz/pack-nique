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
            ->add('code', TextType::class, ['label' => 'Code promo']);           // Permet de rentrer le code promotionnel dans l'affichage
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Sold::class
        ]);
    }
}
