<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Import your custom middleware
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Auth\Middleware\Authenticate;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
    $middleware->alias([
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class, // Correct path
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'verified' => \App\Http\Middleware\EnsureUserIsVerified::class, // <-- Add this
    ]);
})

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
