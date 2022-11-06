<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\countForPage;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;

class SettingsUserController extends Controller
{
    public function __construct(protected UserRepository $repository)
    {}

    public function index()
    {
        $user = auth()->user();

        return view('admin.settings-user', [
            'countForPageAll' => countForPage::all(),
            'idCountForPageUserCurrent' => $user->countForPage->id,
        ]);
    }

    public function store(Request $request)
    {
        $this->repository->updateCountForPage($request->countForPage);

        return to_route('admin.profile.settings')->withSuccess('Preferências do usuário atualizadas com sucesso');
    }
}
