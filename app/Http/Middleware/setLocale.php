<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class setLocale
{

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = null;

        if (auth()->guard('web')->check()) {
            $language = auth()->guard('web')->user()->language;
        } else {
            // Retrieve the user's language preference from the session or any other storage
            $language = session('language');
        }

        if ($language) {
            App::setLocale($language); // Update this line
        }

//        dd('SetLocale middleware executed');

        return $next($request);
    }
}
