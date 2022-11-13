<?php

namespace App\Http\Controllers;

use App\Models\CounterViewerUser;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $qtdUser = User::with('roles')->role(['admin-master', 'admin'])->count();

        $viewsMonth = CounterViewerUser::whereMonth('updated_at', date('m'))->count();

        return view('home', [
            'qtdUser' => $qtdUser,
            'viewsMonth' => $viewsMonth,
        ]);
    }
}
