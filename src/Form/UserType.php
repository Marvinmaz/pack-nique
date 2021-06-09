<?php 

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, ['label' => 'Prénom'])
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('age', NumberType::class, ['label' => 'Age'])
            ->add('mail', EmailType::class, ['label' => 'Adresse Email'])
            ->add('password', PasswordType::class, ['label' => 'Mot de passe'])
            ->add('address', TextType::class, ['label' => ' Adresse de residence'])
            ->add('postalCode', NumberType::class, ['label' => 'Code postale'])
            ->add('country', TextType::class, ['label' => 'Ville'])
            ->add('tel', NumberType::class, ['label' => 'Téléphone'])
            ->add('pics', UrlType::class, ['label' => 'Ajouter une photo de profil']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }

}
