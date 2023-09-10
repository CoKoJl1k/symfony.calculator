<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class CalculatorForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('arg1', NumberType::class, [
                'label' => 'Аргумент 1',
                'required' => true,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Введите аргумент 1']),
                    new Type(['type' => 'numeric'])
                ],
            ])
            ->add('operation', ChoiceType::class, [
                'label' => 'Операция',
                'choices' => [
                    '+' => '+',
                    '-' => '-',
                    '*' => '*',
                    '/' => '/',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank(['message' => 'Введите операцию']),
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('arg2', NumberType::class, [
                'label' => 'Аргумент 2',
                'required' => true,
                'attr' => ['class' => 'form-control'],
                'constraints' => [
                    new NotBlank(['message' => 'Введите аргумент 2']),
                    new Type(['type' => 'numeric'])
                ],
            ])
            ->add('calculate', SubmitType::class, [
                'label' => 'Вычислить',
                 'attr' => ['class' => 'btn btn-primary'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}