<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SettingsSite as SettingsSiteModel;
use Illuminate\Http\Request;

class SettingsSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->settings = SettingsSiteModel::find(1);
        return $next($request);
    }
}
