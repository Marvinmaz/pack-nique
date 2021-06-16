<?php 

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;

use Symfony\Component\OptionsResolver\OptionsResolver;

class UserInfoType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address', TextType::class, ['label' => 'Adresse'])
            ->add('postalcode', TextType::class, ['label' => 'Code Postal'])
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('age', TextType::class, ['label' => 'Age'])
            ->add('tel', TextType::class, ['label' => 'Téléphone'])
            ->add('country', TextType::class, ['label' => 'ville']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }


}