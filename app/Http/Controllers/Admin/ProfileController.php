<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserEditRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct(protected UserRepository $repository)
    {}

    public function index()
    {
        return view('admin.profile', ['user' => Auth::user()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request, $id)
    {
        if ($id != auth()->user()->id) {
            return false;
        }

        $this->repository->update($id, $request);

        return to_route('admin.profile', $id)->withSuccess("Usuário editado com sucesso");
    }
}
