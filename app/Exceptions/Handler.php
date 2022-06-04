<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                "error" => [
                    "code" => '404',
                    "message" => "your query is not in DB.",
                    "type" => "ModelNotFoundException",
                    "detail" => 'Ensure your query id is in your database'
                ],
            ], 404);
        }

        if($e instanceof ValidationException){
            return response()->json([
                "errors" => [
                    "type" => "ValidationException",
                    "detail" => $e->errors(),
                    "code" => 422,
                    "message" => $e->getMessage(),
                ],
            ], 422);
        }

        if ($e instanceof \Exception) {
            return response()->json([
                "errors" => [
                    "type" => "ConstraintException",
                    "code" => $e->getCode(),
                    "message" => $e->getMessage(),
                    "detail" => 'Business constraints is violated!'
                ],
            ], 422);
        }



            return parent::render($request, $e);
    }
}
