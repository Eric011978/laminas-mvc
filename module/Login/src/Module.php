<?php

namespace Login;

use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    // Add this method:
    public function getControllerConfig()
    {
        return [
            'factories' => [
                Controller\LoginController::class => function($container) {
                    return new Controller\LoginController(
                        $container->get(Model\UserTable::class)
                    );
                },
            ],
        ];
    }

    // Add this method:
    public function getServiceConfig()
    {
        return [
            'factories' => [
                Model\UserTable::class => function($container) {
                    $tableGateway = $container->get(Model\UserTableGateway::class);
                    return new Model\UserTable($tableGateway);
                },
                Model\UserTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\User());

                    return new TableGateway('album', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }
}
