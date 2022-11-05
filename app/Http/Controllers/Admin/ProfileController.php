<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gender;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;

class ProfileController extends Controller
{
    public function __construct(protected UserRepository $repository)
    {}

    public function index()
    {
        return view('admin.profile', ['user' => Auth::user(), 'genders' => Gender::all()]);
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
