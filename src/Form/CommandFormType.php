<?php

namespace Survos\CommandBundle\Form;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $command = $options['command'];
        /** @var Command $command */
        $defintion = $command->getDefinition();
        foreach ($defintion->getArguments() as $argument) {
            $builder
                ->add($argument->getName(), null, [
                    'help' => $argument->getDescription(),
                    'required' => false,
                    'attr' => [
                        'placeholder' => $argument->getDefault(),

                    ]
                ]);
        }

        foreach ($defintion->getOptions() as $option) {
            // no type?
            if ($option->isNegatable()) {
                $type = CheckboxType::class;
            } elseif (is_int($option->getDefault())) {
                $type = NumberType::class;
            } else {
                $type = TextType::class;
            }
            $builder
                ->add($option->getName(), $type, [
                    'help' => $option->getDescription(),
                    'required' => false,
                    'attr' => [
                        'placeholder' => $option->getDefault(),
                    ]
                ]);
        }

        $builder->add('submit', SubmitType::class, [
            'label' => 'Run Command'
        ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'command' => null,
//            'data_class' => Command::class
            // Configure your form options here
        ]);
    }
}
