<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CounterViewerUser as ModelsCounterViewerUser;

class CounterViewerUser
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
        if ($request->settings->view_counter) {
            $this->removeViewsLastYear();

            $auth = Auth::guard('admin')->check();
            if ($auth == false || ($auth == true && $request->user('admin')->hasRole('admin') == false)) {
                $this->saveCounterViewer($request);
            }
        }
        
        return $next($request);
    }

    public function saveCounterViewer($request)
    {
        $ip = $request->ip();

        $hours = '-'.$request->settings->periodCountVisits.' hours';

        $timePastHours = date('H:i:s', strtotime($hours));
        
        $time = ModelsCounterViewerUser::where('ip', $ip)->whereDate('updated_at', date('Y-m-d'))->whereTime('updated_at', '>', $timePastHours)->count();

        if ($time > 0) {
            return false;
        }

        ModelsCounterViewerUser::create([
            'ip' => $ip,
        ]);
    }

    public function removeViewsLastYear()
    {
        ModelsCounterViewerUser::where('updated_at', '<', date('Y-m-d H:i:s', strtotime('-12 month')))->delete();
    }
}
