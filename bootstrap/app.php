<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
return Application::configure(basePath: dirname(__DIR__))

    ->withRouting(

        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {

            Route::middleware('api')
                   ->group(base_path('routes/openeds/openeds.php'));

            Route::middleware('api')

                   ->prefix("backoffice")
                   ->group(base_path('routes/closeds/backoffice/users.php'));


            Route::middleware('api')

               ->prefix("erp")
               ->group(base_path('routes/closeds/erp/peoples.php'));


        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {

       $exceptions->render(function (NotFoundHttpException $e, Request $request) {

            return response()->json([
                'message' => 'Record not found.'
            ], 404);

    });
    })
    ->create();
