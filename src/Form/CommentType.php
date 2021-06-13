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

class CommentType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Comment', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([

        ]);
    }
}