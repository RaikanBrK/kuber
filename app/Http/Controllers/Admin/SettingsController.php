<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsFrontEndRequest;
use App\Http\Requests\SettingsRequest;
use App\Repositories\Settings\SettingsRepository;


class SettingsController extends Controller
{
    public function __construct(protected SettingsRepository $repository)
    {}

    public function index(Request $request)
    {
        return view('admin.settings.index', ['settings' => $request->settings]);
    }

    public function store(SettingsFrontEndRequest $request)
    {
        $this->repository->addSettingsFrontEnd($request);

        return to_route('admin.settings.index')->withSuccess('Configurações atualizadas com sucesso!');
    }

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

    public function viewCounterStore(SettingsRequest $request)
    {
        $this->repository->updateViewCounter($request);

        return to_route('admin.settings.viewCounter')->withSuccess('Contador de visitas atualizado com sucesso!');
    }
}
