<?php

namespace App\Form;

use App\Entity\Unidad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UnidadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codigo', null, [
                'attr' => [
                    'class' => 'form-control ',
                ]
            ])
            ->add('capacidad', null, [
                'attr' => [
                    'class' => 'form-control ',
                ]
            ])
            ->add('estado', null, [
                'attr' => [
                    'class' => 'form-control ',
                ]
            ])
            ->add('placa', null, [
                'attr' => [
                    'class' => 'form-control ',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Unidad::class,
        ]);
    }
}
