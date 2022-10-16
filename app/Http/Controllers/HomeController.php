<?php

namespace App\Http\Controllers;

use App\Http\Controllers\administrators\AdministratorController;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $users = User::factory()->count(5)->create();
        $users = User::all();

        return view('home', ["users" => $users]);
    }
}
