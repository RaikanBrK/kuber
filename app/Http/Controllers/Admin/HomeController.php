<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CounterViewerUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $labels = [];
    protected $date = null;
    protected $data = [];
    protected $dateInit = null;

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
        $role = $user->getRoleNames()[0];

        $viewsMonth = CounterViewerUser::whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->count();

        $this->runData();

        return view('home', [
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

    public function runData()
    {
        $this->date = new DateTime('-11 month');
        $this->dateInit = clone $this->date;
        
        for($i = 0; $i < 12; $i++) {
            $this->setLabel();
            $this->date->modify('+1 month');
        }

        $this->setData();
    }

    public function setLabel()
    {
        $this->data[$this->date->format('m')] = 0;

        $labelMonth = str_replace('home.', '', __('home.' . $this->date->format('M')));
        array_push($this->labels, $labelMonth);
    }

    public function setData()
    {
        $views = CounterViewerUser::where('updated_at', '>', $this->dateInit)->orderBy('updated_at')->get();

        $views->filter(function($value) {
            $monthId = strval($value->updated_at->format('m'));

            $this->data[$monthId] = ($this->data[$monthId] ?? 0) + 1;
        });
    }
}
