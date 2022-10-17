<?php

namespace Survos\CommandBundle\Form;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Form\AbstractType;
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
                    'mapped' => false, // until we create an object that holds the data
                    'help' => $argument->getDescription(),
                    'attr' => [
                        'placeholder' => $argument->getDefault(),

            ]
                ])
            ;
        }

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
