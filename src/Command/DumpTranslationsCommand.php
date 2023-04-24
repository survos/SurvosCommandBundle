<?php

namespace Survos\CommandBundle\Command;

use Roave\BetterReflection\Reflection\Adapter\ReflectionClass;
use SebastianBergmann\Diff\Differ;
use Survos\Bundle\MakerBundle\Service\MakerService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\StreamableInputInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;
use Twig\Environment;
use Zenstruck\Console\Attribute\Argument;
use Zenstruck\Console\Attribute\Option;
use Zenstruck\Console\ConfigureWithAttributes;
use Zenstruck\Console\InvokableServiceCommand;
use Zenstruck\Console\IO;
use Zenstruck\Console\RunsCommands;
use Zenstruck\Console\RunsProcesses;
use Symfony\Bundle\FrameworkBundle\Console\Application;

#[AsCommand('survos:command:dump-as-messages', 'Dump the command descriptions as a message for file translations')]
final class DumpTranslationsCommand extends InvokableServiceCommand
{
    use ConfigureWithAttributes;
    use RunsCommands;
    use RunsProcesses;

    private Application $application;

    public function __construct(private KernelInterface $kernel, private array $namespaces, string $name = null
    )
    {
        $this->application = new Application($this->kernel);
        parent::__construct($name);
    }

    public function __invoke(
        IO     $io,
        #[Option(description: 'The namespace(s) to dump (defaults to config value)')]
        string $namespace = 'app',
    ): void
    {

        $commands = [];
        foreach ($this->namespaces as $namespace) {
            $commands[$namespace] = $this->application->all($namespace);
            foreach ($commands[$namespace] as $command) {
                $messages[$command->getName()] = [
                    'description' => $command->getDescription(),
                    'help' => $command->getHelp()
                ];
            }
        }

        file_put_contents($fn = $this->kernel->getProjectDir() . sprintf('/translations/commands.%s.yaml', 'en'), Yaml::dump($messages));

        $io->success(sprintf('File %s written', $fn));
    }
}
