<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurmentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('location', EntityType::class, [
                'label' => 'Location',
                'class' => Location::class,
                'choice_label' => fn (Location $location) => $location->getCity() . ', ' . $location->getCountry(),
                'placeholder' => 'Choose a location',
            ])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
                'input' => 'datetime',
            ])
            ->add('celsius', NumberType::class, [
                'label' => 'Temperature (°C)',
                'input' => 'string',
                'scale' => 0,
                'html5' => true,
                'attr' => [
                    'placeholder' => 'e.g. 12',
                    'step' => 1,
                    'min' => -60,
                    'max' => 60,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurment::class,
        ]);
    }
}
