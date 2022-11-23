<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create User'])
            ->add('team', ChoiceType::class, [
                'choices' => [
                    'Group 1' => 'g1',
                    'Group 2' => 'g2',
                    'Group 3' => 'g3'
                ]
            ])
        ;
    }
}