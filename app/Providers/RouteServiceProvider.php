<?php


namespace App\Providers;


use Illuminate\Cache\RateLimiting\Limit;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\RateLimiter;

use Illuminate\Support\Facades\Route;


class RouteServiceProvider extends ServiceProvider

{

    /** The path to your application's "home" route. */

    public const HOME = '/home';


    /** Define your route model bindings, pattern filters, and other route configuration. */

    public function boot(): void

    {

        // Default API limiter (60/min po user-u ili IP-u)

        RateLimiter::for('api', function (Request $request) {

            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());

        });


        // Naš AI limiter (10/min po user-u ili IP-u) — BEZ decayMinutes!

        RateLimiter::for('ai-lite', function (Request $request) {

            $key = $request->user()?->id ? ('u:' . $request->user()->id) : ('ip:' . $request->ip());

            return Limit::perMinute(10)->by($key);

        });


        $this->routes(function () {

            Route::middleware('api')

                ->prefix('api')

                ->group(base_path('routes/api.php'));


            Route::middleware('web')

                ->group(base_path('routes/web.php'));

        });

    }

}
