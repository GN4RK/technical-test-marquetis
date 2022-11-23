<?php

namespace App\Form\Type;

use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class PointAttributionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('points', IntegerType::class)
            ->add('date', DateTimeType::class)
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'mapped' => false,
            ])
            ->add('group', ChoiceType::class, [
                'choices' => [
                    'no' => 'false',
                    'Group 1' => 'g1',
                    'Group 2' => 'g2',
                    'Group 3' => 'g3'
                ],
                'mapped' => false,
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Point Attribution']);
        ;
    }
}