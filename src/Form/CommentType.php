<?php

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CommentType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content', TextType::class, ['label' => 'Votre commentaire'])
            ->add('note', NumberType::class, ['label' => 'Note sur 5']);
    }

    public function configureOptions(OptionsResolver $resolver){
        $resolver->setDefaults([
            'data_class' => Comment::class
        ]);
    }
}