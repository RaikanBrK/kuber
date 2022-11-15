<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Settings as SettingsModel;
use Illuminate\Http\Request;

class Settings
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
        $request->settings = SettingsModel::find(1);
        return $next($request);
    }
}
