<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CounterViewerUser;

class HomeController extends Controller
{
    protected $labels = [];
    protected $date = null;
    protected $data = [];

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $qtdUser = User::with('roles')->role(['admin-master', 'admin'])->count();

        $viewsMonth = CounterViewerUser::whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y'))->count();

        $this->runData();

        return view('home', [
            'settings' => $request->settings,
            'qtdUser' => $qtdUser,
            'viewsMonth' => $viewsMonth,
            'labels' => $this->labels,
            'data' => array_values($this->data),
        ]);
    }

    public function runData()
    {
        $this->date = new DateTime('-11 month');
        
        $this->setData();
        
        for($i = 0; $i < 12; $i++) {
            $this->setLabel();
            $this->date->modify('+1 month');
        }
    }

    public function setLabel()
    {
        $labelMonth = str_replace('home.', '', __('home.' . $this->date->format('M')));
        array_push($this->labels, $labelMonth);
    }

    public function setData()
    {
        $views = CounterViewerUser::where('updated_at', '>', $this->date->modify('-2 days'))->orderBy('updated_at')->get();

        $views->filter(function($value) {
            $monthId = strval($value->updated_at->format('m'));

            $this->data[$monthId] = ($this->data[$monthId] ?? 0) + 1;
        });
    }
}
