<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
  ->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
  )
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->redirectGuestsTo(fn() => route('login'));
    $middleware->redirectUsersTo(function () {
      $role = \Illuminate\Support\Facades\Auth::user()->role;

      return match ($role) {
        'admin' => route('admin.dashboard'),
        'barberman' => route('barberman.dashboard'),
        'user' => route('halamanPelanggan'),
      };
    });
  })
  ->withMiddleware(function (Middleware $middleware) {
    $middleware->redirectGuestsTo('/auth/login-basic');
    // Daftarkan alias 'role'
    $middleware->alias([
      'role' => \App\Http\Middleware\RoleMiddleware::class,
    ]);
  })
  ->withExceptions(function (Exceptions $exceptions) {
    //
  })->create();
