<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckPremiumMember;
use App\Http\Middleware\postLoginActions;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->alias([
            'premium' => CheckPremiumMember::class,
            'postLoginActions' => postLoginActions::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
