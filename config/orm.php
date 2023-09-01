<?php

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Zenstruck\Foundry\Factory\Persistence\ORM\ORMPersistenceManager;

return static function (ContainerConfigurator $container): void {
    $container->services()
        ->set('.zenstruck_foundry.persistence_manager.orm', ORMPersistenceManager::class)
            ->args([
                service('doctrine'),
            ])
            ->tag('.foundry.persistence_manager')
    ;
};