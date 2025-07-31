<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\HttpsProtocol::class,
            \App\Http\Middleware\Redirection301::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
       'auth' => \App\Http\Middleware\Authenticate::class,
       'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
       'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
       'can' => \Illuminate\Auth\Middleware\Authorize::class,
       'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
       'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
       'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
       'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
       'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
       'role1' => \App\Http\Middleware\Admin\Role1::class,
       'role2' => \App\Http\Middleware\Admin\Role2::class,
       'role3' => \App\Http\Middleware\Admin\Role3::class,
       'role4' => \App\Http\Middleware\Admin\Role4::class,
       'role5' => \App\Http\Middleware\Admin\Role5::class,
       'role6' => \App\Http\Middleware\Admin\Role6::class,
       'role7' => \App\Http\Middleware\Admin\Role7::class,
       'role8' => \App\Http\Middleware\Admin\Role8::class,
       'role9' => \App\Http\Middleware\Admin\Role9::class,
       'role10' => \App\Http\Middleware\Admin\Role10::class,
       'role11' => \App\Http\Middleware\Admin\Role11::class,
       'role12' => \App\Http\Middleware\Admin\Role12::class,
       'role13' => \App\Http\Middleware\Admin\Role13::class,
       'role14' => \App\Http\Middleware\Admin\Role14::class,
       'role15' => \App\Http\Middleware\Admin\Role15::class,
       'role16' => \App\Http\Middleware\Admin\Role16::class,
       'role17' => \App\Http\Middleware\Admin\Role17::class,
       'role18' => \App\Http\Middleware\Admin\Role18::class,
       'role19' => \App\Http\Middleware\Admin\Role19::class,
       'role20' => \App\Http\Middleware\Admin\Role20::class,
       'role21' => \App\Http\Middleware\Admin\Role21::class,
       'role22' => \App\Http\Middleware\Admin\Role22::class,
       'role23' => \App\Http\Middleware\Admin\Role23::class,
       'role24' => \App\Http\Middleware\Admin\Role24::class,
       'role25' => \App\Http\Middleware\Admin\Role25::class,
       'role26' => \App\Http\Middleware\Admin\Role26::class,
       'role27' => \App\Http\Middleware\Admin\Role27::class,
       'role28' => \App\Http\Middleware\Admin\Role28::class,
       'role29' => \App\Http\Middleware\Admin\Role29::class,
       'role30' => \App\Http\Middleware\Admin\Role30::class,
       'role31' => \App\Http\Middleware\Admin\Role31::class,
       'role32' => \App\Http\Middleware\Admin\Role32::class,
       'regSessionExist' => \App\Http\Middleware\ifRegSessionExist::class,
    ];
}
