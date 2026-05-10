<?php

use App\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withConfigs([
        'app/Config/database.php' => function ($config) {
            \App\Foundation\Database\ConnectionResolver::boot($config);
        },
    ])
    ->withRouting(
        web: 'app/Routes/web.php'
    )
    ->withMiddleware([
        'auth' => \App\Http\Middlewares\AuthMiddleware::class,
        'role.admin' => \App\Http\Middlewares\AdminMiddleware::class,
        'role.staff' => \App\Http\Middlewares\StaffMiddleware::class,
        'role.citizen' => \App\Http\Middlewares\CitizenMiddleware::class,
        'role.guest' => \App\Http\Middlewares\GuestMiddleware::class,
    ])
    ->withHelpers([
        'app/Helpers/services.php',
        'app/Helpers/helpers.php',
    ])
    ->run();
