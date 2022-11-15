<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsSiteRequest;
use App\Repositories\Settings\SettingsRepository;


class SettingsController extends Controller
{
    public function __construct(protected SettingsRepository $repository)
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

    public function viewCounterStore(SettingsSiteRequest $request)
    {
        $this->repository->updateViewCounter($request);

        return to_route('admin.settings.viewCounter')->withSuccess('Contador de visitas atualizado com sucesso!');
    }
}
