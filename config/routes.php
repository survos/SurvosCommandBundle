<?php

use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Survos\CommandBundle\Controller\CommandController;

return function (RoutingConfigurator $routes) {
    $routes->add('survos_commands', '/commands')
        ->controller([CommandController::class, 'commands'])
    ;

    $routes->add('survos_command', '/run-command/{commandName}')
        ->controller([CommandController::class, 'runCommand'])
    ;

};
