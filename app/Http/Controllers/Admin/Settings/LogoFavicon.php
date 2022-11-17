<?php

namespace App\Http\Controllers\Admin\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\LogoFaviconRequest;

class LogoFavicon extends Controller
{
    public function logoFavicon()
    {
        return view('admin.settings.logoFavicon');
    }

    public function logoFaviconStore(LogoFaviconRequest $request)
    {
        
        if ($request->file('logo')) {
            $this->updateLogo($request->file('logo'));
        }

        if ($request->file('favicon')) {
            $this->updateFavicon($request->file('favicon'));
        }

        return to_route('admin.settings.logoFavicon')->withSuccess('Alterações feita com sucesso');
    }

    protected function imageMake($image)
    {
        return Image::make($image)->encode('webp', 80);
    }

    protected function updateLogo($image)
    {
        $img = $this->imageMake($image);

        Storage::disk('web')->put('images/logo.webp', $img);
    }

    protected function updateFavicon($image)
    {
        $img = $this->imageMake($image);

        Storage::disk('web')->put('images/favicon.webp', $img);
    }
}
