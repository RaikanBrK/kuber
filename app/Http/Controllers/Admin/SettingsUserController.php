<?php

namespace App\Http\Controllers\Admin;

use App\Models\CountForPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            'countForPageAll' => CountForPage::all(),
            'idCountForPageUserCurrent' => $user->countForPage->id,
        ]);
    }

    public function store(Request $request)
    {
        $this->repository->updateCountForPage($request->countForPage);

        return to_route('admin.profile.settings')->withSuccess('Preferências do usuário atualizadas com sucesso');
    }
}
