<?php

   use Illuminate\Foundation\Application;
   use Illuminate\Foundation\Configuration\Exceptions;
   use Illuminate\Foundation\Configuration\Middleware;
   use App\Http\Middleware\EnsureIsAdmin;
   use App\Http\Middleware\EnsureIsEmployer;
   use App\Http\Middleware\EnsureIsCandidate;

   return Application::configure(basePath: dirname(__DIR__))
       ->withRouting(
           web: __DIR__.'/../routes/web.php',
           commands: __DIR__.'/../routes/console.php',
           health: '/up',
       )
       ->withMiddleware(function (Middleware $middleware) {
           $middleware->alias([
               'admin' => EnsureIsAdmin::class,
               'employer' => EnsureIsEmployer::class,
               'candidate' => EnsureIsCandidate::class,
           ]);
       })
       ->withExceptions(function (Exceptions $exceptions) {
           //
       })->create();