<?php

namespace App\Providers;

use App\Repositories\SettingsSite\EloquentSettingsSiteRepository;
use App\Repositories\SettingsSite\SettingsSiteRepository;
use Illuminate\Support\ServiceProvider;

class SettingsSiteProvider extends ServiceProvider
{
    public array $bindings = [
        SettingsSiteRepository::class => EloquentSettingsSiteRepository::class,
    ];
}
