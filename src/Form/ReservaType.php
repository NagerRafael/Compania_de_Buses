<?php

namespace App\Form;

use App\Entity\Bus;
use App\Entity\Reserva;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idBus', EntityType::class,[
                'class'=>Bus::class,
                'choice_label' => 'informacion',
                'attr' => [
                    'label'=>'Seleccionar bus:',
                    'class'=>'form-control',
                    'required'=>true                    
                ]
            ])
            ->add('horario', DateTimeType::class,[
                'years' => range(date('Y'), date('Y')+5),
                'months' => range(date('m'), 12),
                'days' => range(date('d'), 31),
                'attr' => [
                    'label'=>'Horario: ',
                    'class'=>'form-control',
                    'required'=>true                    
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reserva::class,
        ]);
    }
}
