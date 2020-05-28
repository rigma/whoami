<?php
namespace App\Form\Type;

use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault('csrf_protection', false);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('email', TextType::class, ['required' => true])
            ->add('password', PasswordType::class, ['required' => true])
            ->add('phone_number', PhoneNumberType::class, ['required' => true, 'default_region' => 'FR']);
    }
}
