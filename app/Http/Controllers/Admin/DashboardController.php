<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CounterViewerUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Kuber\Dashboard\DataViewCounter;

class DashboardController extends Controller
{
    use DataViewCounter;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $qtdUser = User::with('roles')->role(['admin'])->count();
        $settings = $request->settings;
        $user = Auth::user();
        $role = $user->getRoleNames()->first();

        $viewsMonth = CounterViewerUser::whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->count();

        $this->runData();

        return view('dashboard', [
            'settings' => $settings,
            'qtdUser' => $qtdUser,
            'viewsMonth' => $viewsMonth,
            'labels' => $this->labels,
            'data' => array_values($this->data),
            'labelViewCounter' => $settings->view_counter ? 'Ativo' : 'Desativado',
            'user' => $user,
            'roleName' => $role == 'admin-master' ? 'Super Admin' : $role,
        ]);
    }
}
