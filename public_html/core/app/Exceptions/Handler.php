<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
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
        //
    }

    protected function unauthenticated($request, AuthenticationException $exception)
        {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }
            if ($request->is('admin') || $request->is('admin/*')) {
                return redirect()->guest('/admin/login');
            }
            return redirect()->guest(route('login'));
        }

    public function render($request, Throwable $exception){
     if ($exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
        return back()->with('message','error|You are sending too many requests. Please wait and try again later.'); 
     }
     return parent::render($request, $exception);
    }

}
