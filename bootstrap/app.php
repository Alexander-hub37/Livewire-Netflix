<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;



return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (AuthenticationException $exceptions) {
            $returnData = [
                'message' => 'You do not have the required authorization.',
                'error' => $exceptions->getMessage()
            ];

            return response()->json($returnData, 401);
        });

        $exceptions->render(function (\Spatie\Permission\Exceptions\UnauthorizedException $exceptions) {
            $returnData = [
                'message' => 'You do not have the required authorization.',
                'error' => $exceptions->getMessage()
            ];

            return response()->json($returnData, 403);
        });

        $exceptions->render(function (NotFoundHttpException $exceptions, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Route not found.',
                    'error' => $exceptions->getMessage()
                ], 404);
            }
        });

        return $exceptions;
  
    })->create();
