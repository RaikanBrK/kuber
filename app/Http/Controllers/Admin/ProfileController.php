<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gender;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Storage;

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

        $request->validate([
            'image' => ['image', 'nullable', 'mimes:png,jpg,jpeg', 'max:2048'],
        ]);

        $image = $request->file('image') != null 
            ? $this->newImgProfile($request->file('image'))
            : false;

        $this->repository->update($id, $request, $image);

        return to_route('admin.profile', $id)->withSuccess("Usuário editado com sucesso");
    }

    protected function newImgProfile($image)
    {
        $img = Image::make($image)
        ->fit(205)
        ->encode('png',80);

        $filename = uniqid() . Str::random(20) . '.png';
        $path = "users/avatar/";

        $nameImg = $path . $filename;
        $validation = Storage::disk('public')->put($nameImg, $img);

        if (Auth::user()->image) {
            Storage::disk('public')->delete(Auth::user()->image);
        }

        return $validation ? $nameImg : $validation;
    }
}
