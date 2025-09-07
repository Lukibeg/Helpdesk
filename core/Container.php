<?php

namespace core;

use DI\ContainerBuilder;
use app\model\Database;
use League\Plates\Engine;


$builder = new ContainerBuilder();

//Autowiring on
$builder->addDefinitions([

    Database::class => \DI\create(Database::class),
    Engine::class => function () {
        $templates = __DIR__ . '/../app/view';
        return new Engine($templates);
    },
]);

$container = $builder->build();

return $container;
