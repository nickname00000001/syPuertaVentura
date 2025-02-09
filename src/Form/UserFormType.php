<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\UserService;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username',TextType::class, [
                'label' => 'Usuario',
                'required' => true,
                'label_attr'=> [
                    'class'=> 'form-label mt-3 fw-bold text-dark',
                ],
                'attr'=>[
                    'class'=> 'form-control',
                    'id' =>'user_form_name',
                    'placeholder' =>'escribe tu nombre aqui'
                ]
            ])
            ->add('email',TextType::class, [
                'label' => 'Email',
                'required' => true,
                'label_attr'=> [
                    'class'=> 'form-label mt-3 fw-bold text-dark',
                ],
                'attr'=>[
                    'class'=> 'form-control',
                    'id' =>'user_form_email',
                    'placeholder' =>'escribe tu email aqui'
                ]
            ])
            ->add('password',TextType::class, [
                'label' => 'Contraseña',
                'required' => true,
                'label_attr'=> [
                    'class'=> 'form-label mt-3 fw-bold text-dark',
                ],
                'attr'=>[
                    'class'=> 'form-control',
                    'id' =>'user_form_pass',
                    'placeholder' =>'escribe tu contraseña aqui'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
