<?php

namespace core;

use DI\ContainerBuilder;
use app\model\Database;

$builder = new ContainerBuilder();

//Autowiring on
// $builder->addDefinitions([

//     Database::class => \DI\create(Database::class),

//     HomeAdminModel::class => \DI\create(HomeAdminModel::class)
//         ->constructor(\DI\get(Database::class)),

//     HomeAdminController::class => \DI\create(HomeAdminController::class)
//         ->constructor(\DI\get(HomeAdminModel::class)),
// ]);

$container = $builder->build();

return $container;
