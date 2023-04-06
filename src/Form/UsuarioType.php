<?php

namespace App\Form;

use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsuarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', null, [
                'attr' => [
                    'class' => 'form-control ',
                ]
            ])
            ->add('correo', null, [
                'attr' => [
                    'class' => 'form-control ',
                ]
            ])
            ->add('clave', null, [
                'attr' => [
                    'class' => 'form-control ',
                ]
            ])
            ->add('estado', null, [
                'attr' => [
                    'class' => 'form-control ',
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'mapped' => false,
                'choices'  => [
                    'Secretaria' => Usuario::ROLE_SECRETARIA,
                    'Cliente' => Usuario::ROLE_CLIENTE,
                    'Administrador' => Usuario::ROLE_ADMIN,
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usuario::class,
        ]);
    }
}
