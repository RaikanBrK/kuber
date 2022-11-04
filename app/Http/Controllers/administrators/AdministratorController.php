<?php

namespace App\Http\Controllers\administrators;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function __construct(private UserRepository $repository)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->role(['admin-master', 'admin'])->get();

        $header = ['id' => 'Id', 'name' => 'Nome', 'email' => 'E-mail'];

        return view('admin.administrators.index', ['users' => $users, 'header' => $header]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.administrators.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $this->repository->add($request);

        return to_route('admin.administrators.create')->withSuccess('Usuário criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.administrators.edit', ['user' => $user]);
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
        $this->repository->update($id, $request);

        return to_route('admin.administrators.edit', $id)->withSuccess("Usuário editado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return to_route('admin.administrators.index')->withSuccess("Usuário deletado com sucesso");
    }

    public function transferMaster()
    {
        $users = User::with('roles')->role(['admin-master', 'admin'])->get();

        $header = ['id' => 'Id', 'name' => 'Nome', 'email' => 'E-mail'];

        return view('admin.administrators.transferMaster', ['users' => $users, 'header' => $header]);
    }
}
