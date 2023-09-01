<?php

namespace App\Exceptions;

use App\Helpers\JsonHelper;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
        // DEFAULT API ERROR RESPONSE
        $this->renderable(function (Exception $e, $request) {
            // if ($request->is('api/*')) {
            //     return JsonHelper::error($e);
            // }
            if ($request->wantsJson()) {
                return JsonHelper::error($e);
            }
        });
    }
}
