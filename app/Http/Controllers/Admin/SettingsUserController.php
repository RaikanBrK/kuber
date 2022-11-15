<?php

namespace App\Http\Controllers\Admin;

use App\Models\CountForPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;

class SettingsUserController extends Controller
{
    public function __construct(protected UserRepository $repository)
    {}

    public function index()
    {
        $user = auth()->user();

        $countForPageAll = CountForPage::all();

        return view('admin.settings-user', [
            'countForPageAll' => $countForPageAll,
            'idCountForPageUserCurrent' => $countForPageAll->find($user->count_for_page_id)->id,
        ]);
    }

    public function store(Request $request)
    {
        $this->repository->updateCountForPage($request->countForPage);

        return to_route('admin.profile.settings')->withSuccess('Preferências do usuário atualizadas com sucesso');
    }
}
