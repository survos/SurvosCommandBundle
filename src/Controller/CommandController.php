<?php

namespace Survos\CommandBundle\Controller;

use Survos\CommandBundle\Form\CommandFormType;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Zenstruck\Console\CommandRunner;

class CommandController extends AbstractController
{

    private Application $application;

    public function __construct(private KernelInterface $kernel, private array $namespaces)
    {
        $this->application = new Application($this->kernel);
    }

    #[Route('/commands', name: 'command_list')]
    public function commands(): Response
    {
        $commands = [];
        foreach ($this->namespaces as $namespace) {
            $commands[$namespace] = $this->application->all($namespace);
        }
        // from the bundle get the regex of allowable commands?
        return $this->render('@SurvosCommand/index.html.twig', [
            'commands' => $commands
        ]);
    }

    #[Route(path: '/run-command/{commandName}', name: 'run_command')]
    public function runCommand(Request $request, KernelInterface $kernel, string $commandName): Response|array
    {
//        $commandName = $request->get('commandName');
        $application = new Application($kernel);
        $command = $application->get($commandName);

        chdir($kernel->getProjectDir());

        /** @var InputDefinition $definition */
        $definition = $command->getDefinition();

        // so we can preset some options in the querystring
        $defaults = $request->query->all();

//        $option = $definition->getOption('createProjects');
//        assert($option->getDefault() === true);
//        dd($command::class, $definition::class);

        // load from request? for command?
        foreach (array_merge($definition->getArguments(), $definition->getOptions()) as $cliArgument) {
            $value = $defaults[$cliArgument->getName()] ?? null;
            if (!$value) {
                $defaults[$cliArgument->getName()] = $cliArgument->getDefault();
            }
        }

//        dd($request);

        $cliString = $commandName;

        $form = $this->createForm(CommandFormType::class, $defaults, ['command' => $command]);
        $form->handleRequest($request);
        $result = '';
        if ($form->isSubmitted() && $form->isValid()) {
            $output = new \Symfony\Component\Console\Output\BufferedOutput();

            $settings = $form->getData();
            $cli[] = $commandName;
            foreach ($definition->getArguments() as $cliArgument) {
                $cli[] = $settings[$cliArgument->getName()];
            }
            foreach ($definition->getOptions() as $cliOption) {
                $optionName = $cliOption->getName();
                $value = $settings[$optionName]; // @todo: arrays
                dump($optionName, $value, $cliOption);
                if ($cliOption->isValueOptional()) {
                    if ($value) {
                        $cli[] = '--' . $optionName . ' ' . $value;
                    }
                } elseif ($cliOption->isNegatable()) {
                    if ($value === true) {
                        $cli[] = '--' . $optionName;
                    } elseif ($value === false) {
                        $cli[] = '--no-' . $optionName;
                    }
                } else {
                    if ($value <> '' && !is_bool($value)) {
                        $cli[] = '--' . $optionName . ' ' . $value;
                    } elseif ($value)  {
                        $cli[] = '--' . $optionName;
                    }
                }
            }

            $cliString = join(' ', $cli);
            $result = null;

            if (!$form->get('dryRun')->getData()) {
                CommandRunner::from($application, $cliString)
                    ->withOutput($output) // any OutputInterface
                    ->run();
                $result = $output->fetch();
            }

            try {
            } catch (\Exception $exception) {
                dd($cliString, $command, $application, $exception->getMessage());
            }

//                CommandRunner::for($command, 'Bob p@ssw0rd --role ROLE_ADMIN')->run(); // works great
        }


//        CommandRunner::from($application, 'my:command --help')
//            ->run();
//
//        CommandRunner::for($command, '--help')->run(); // fails, says --help isn't defined

        return $this->render('@SurvosCommand/run.html.twig', [
            'cliString' => $cliString,
            'form' => $form->createView(),
            'result' => $result,
            'command' => $command
        ]);
    }
}
