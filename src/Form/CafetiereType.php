<?php

namespace App\Form;

use App\Entity\Cafetiere;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CafetiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('couleur', ChoiceType::class, [
                'placeholder' => 'choisissez une couleur couleur',
                'choices' => [
                    'green' => 'green',
                    'black' => 'black',
                    'blue' => 'blue',
                    'red' => 'red',
                    'yellow' => 'yellow',
                    'pink' => 'pink',
                ],
                ]
            )
            ->add('isOn')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cafetiere::class,
        ]);
    }
}