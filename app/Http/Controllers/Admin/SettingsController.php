<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\SettingsSite\SettingsSiteRepository;

class SettingsController extends Controller
{
    public function __construct(protected SettingsSiteRepository $repository)
    {}

    public function tags(Request $request)
    {
        return view('admin.settings.tags', [
            "settings" => $request->settings,
        ]);
    }

    public function viewCounter(Request $request)
    {
        return view('admin.settings.viewCounter', [
            'settings' => $request->settings,
        ]);
    }

    public function viewCounterStore(Request $request)
    {
        $viewCounter = $request->toggleViewCounter == 'on';
    
        $this->repository->updateViewCounter($viewCounter);

        return to_route('admin.settings.viewCounter')->withSuccess('Contador de visitas atualizado com sucesso!');
    }
}
