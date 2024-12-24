<?php

use App\Constants\ResponseCode;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn () => route('login'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e) {
            return response()->json([
                'status_code' => ResponseCode::ERROR,
                'message' => Arr::get(ResponseCode::MESSAGE, Response::HTTP_NOT_FOUND, null),
            ], Response::HTTP_NOT_FOUND);
        });

        $exceptions->render(function (AccessDeniedHttpException $e) {
            return response()->json([
                'status_code' => ResponseCode::ERROR,
                'message' => Arr::get(ResponseCode::MESSAGE, Response::HTTP_FORBIDDEN, null),
            ], Response::HTTP_FORBIDDEN);
        });

        $exceptions->render(function (AuthenticationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status_code' => ResponseCode::ERROR,
                    'message' => Arr::get(ResponseCode::MESSAGE, Response::HTTP_UNAUTHORIZED, null),
                ], Response::HTTP_UNAUTHORIZED);
            }

            return redirect('/login');
        });

        $exceptions->render(function (UnauthorizedHttpException $e) {
            return response()->json([
                'status_code' => ResponseCode::ERROR,
                'message' => Arr::get(ResponseCode::MESSAGE, Response::HTTP_UNAUTHORIZED, null),
            ], Response::HTTP_UNAUTHORIZED);
        });
        
        $exceptions->render(function (ValidationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status_code' => ResponseCode::ERROR,
                    'message' => Arr::get(ResponseCode::MESSAGE, Response::HTTP_BAD_REQUEST, null),
                    'errors' => $e->validator->errors(),
                ], Response::HTTP_BAD_REQUEST);
            }

            return redirect()->back()
                ->withInput($request->all())
                ->withErrors($e->validator->errors());
        });

        $exceptions->render(function (BadRequestHttpException $e) {
            return response()->json([
                'status_code' => ResponseCode::ERROR,
                'message' => Arr::get(ResponseCode::MESSAGE, Response::HTTP_BAD_REQUEST, null),
            ], Response::HTTP_BAD_REQUEST);
        });

        $exceptions->render(function (Throwable $e) {
            return response()->json([
                'status_code' => ResponseCode::ERROR,
                'message' => App::hasDebugModeEnabled() ? $e->getMessage() : Arr::get(ResponseCode::MESSAGE, Response::HTTP_INTERNAL_SERVER_ERROR, null),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        });
        
    })->create();
