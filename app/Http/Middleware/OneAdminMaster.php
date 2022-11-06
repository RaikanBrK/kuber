<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OneAdminMaster
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
        $countUserAdminMaster = DB::table('model_has_roles')->where('role_id', 1)->count();

        if($countUserAdminMaster < 1) {
            $user = User::all()->sortBy('created_at')->first();
            $user->assignRole('admin-master');
        } else if ($countUserAdminMaster > 1) {
            $usersAdminMaster = DB::select("
                SELECT 
                    u.id, u.name, u.created_at, mr.role_id
                FROM 
                    users as u LEFT JOIN model_has_roles as mr ON(mr.model_id = u.id)
                WHERE
                    mr.role_id = ?
                ORDER BY
                    u.created_at
                LIMIT
                    1, ?
            ", [1, $countUserAdminMaster]);
            
            
            $ids_to_delete = [];
            foreach($usersAdminMaster as $user) {
                array_push($ids_to_delete, $user->id);
            }          

            DB::table('model_has_roles')->where('role_id', 1)->whereIn('model_id', $ids_to_delete)->delete();
        }
        return $next($request);
    }
}
