<?php

   namespace App\Http\Middleware;

   use Closure;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;
   use Symfony\Component\HttpFoundation\Response;

   class EnsureIsEmployer
   {
       public function handle(Request $request, Closure $next): Response
       {
           if (!Auth::check() || !Auth::user()->isEmployer()) {
               return response()->view('errors.403', [], 403);
           }

           return $next($request);
       }
   }