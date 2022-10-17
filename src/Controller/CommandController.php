<?php

namespace Survos\CommandBundle\Controller;

use Survos\CommandBundle\Form\CommandFormType;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;
use Zenstruck\Console\CommandRunner;

class CommandController extends AbstractController
{

    private Application $application;
    public function __construct(private KernelInterface $kernel)
    {
        $this->application = new Application($this->kernel);
    }

    #[Route('/commands', name: 'command_list')]
    public function commands(): Response
    {
        $commands = $this->application->all('app');
        // from the bundle get the regex of allowable commands?

        return $this->render('@SurvosCommand/index.html.twig', [
            'commands' => $commands
        ]);
    }

    #[Route(path: '/run-command/{commandName}', name: 'run_command')]
    public function runCommand(Request $request, KernelInterface $kernel, string $commandName): Response|array
    {
//        $commandName = $request->get('commandName');

        // load from request?
        $defaults = (object)[];
        $application = new Application($kernel);
        $command = $application->get($commandName);

        $form = $this->createForm(CommandFormType::class, $defaults, ['command' => $command]);
        $form->handleRequest($request);


//        CommandRunner::from($application, 'my:command --help')
//            ->run();
//
//        CommandRunner::for($command, 'Bob p@ssw0rd --role ROLE_ADMIN')->run(); // works great
//        CommandRunner::for($command, '--help')->run(); // fails, says --help isn't defined

        return $this->render('@SurvosCommand/run.html.twig', [
            'form' => $form->createView(),
            'command' => $command
        ]);
    }
}
