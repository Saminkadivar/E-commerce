<?php

// use Illuminate\Foundation\Application;
// use Illuminate\Foundation\Configuration\Exceptions;
// use Illuminate\Foundation\Configuration\Middleware;

// return Application::configure(basePath: dirname(__DIR__))
//     ->withRouting(
//         web: __DIR__.'/../routes/web.php',
//         commands: __DIR__.'/../routes/console.php',
//         health: '/up',
//     )
  
//     ->withMiddleware(function (Middleware $middleware) {
//         $middleware->alias([
//             'role' => \App\Http\Middleware\RoleMiddleware::class,
//             'web' => \App\Http\Middleware\RedirectIfNotVendor::class,
//             'vendor' => \App\Http\Middleware\EnsureVendor::class,
//         ]);
//         $middleware->group('web', [
//             \App\Http\Middleware\RedirectIfNotVendor::class,
//         ]);
//     })
    
//     ->withExceptions(function (Exceptions $exceptions): void {
//         //
//     })->create();

// use Illuminate\Foundation\Application;
// use Illuminate\Foundation\Configuration\Middleware;
// use Illuminate\Foundation\Configuration\Exceptions;
// use App\Http\Middleware\RoleMiddleware;

// return Application::configure(basePath: dirname(__DIR__))
//     ->withRouting(
//         web: __DIR__.'/../routes/web.php',
//         commands: __DIR__.'/../routes/console.php',
//         health: '/up',
//     )
//     ->withMiddleware(function (Middleware $middleware ) {
//         // Alias your middleware
//         // $middleware->alias([
//         //     'role' => \App\Http\Middleware\RoleMiddleware::class,
//         //     'vendor' => \App\Http\Middleware\EnsureVendor::class,
//         //     'admin' => \App\Http\Middleware\EnsureAdmin::class,
//         // ]);
// $routeMiddleware = [
//     ...
//     'role' => \App\Http\Middleware\RoleMiddleware::class,
// ];
//         // Web middleware group
//         $middleware->group('web', [
//             // \App\Http\Middleware\EncryptCookies::class,
//             \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
//             \Illuminate\Session\Middleware\StartSession::class,
//             \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//             // \App\Http\Middleware\VerifyCsrfToken::class,
//             \Illuminate\Routing\Middleware\SubstituteBindings::class,
//         ]);
//     })
//     ->withExceptions(function (Exceptions $exceptions): void {
//         //
//     })
//     ->create();

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\EnsureVendor;
use App\Http\Middleware\EnsureAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role'   => RoleMiddleware::class,
            // 'vendor' => EnsureVendor::class,
            // 'admin'  => EnsureAdmin::class,
        ]);

        // ✅ Web middleware group
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
