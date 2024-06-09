<?php

namespace App\Exceptions;

use App\Http\Responses\ApiResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
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
     */
    public function register(): void
    {
        // Process API exceptions independently
        if (\App::get('request')->is('api/*')) {
            $this->renderable(function (Throwable $e) {
                if ($e instanceof ValidationException) {
                    \Log::error(sprintf('Submission validation fails: %s, original request: %s',
                        $e->getMessage(),
                        json_encode(\App::get('request')->all())
                    ));
                }
                return new ApiResponse(max($e->status, $e->getCode()), [], $e->getMessage());
            });
        }
    }
}
