<?php

namespace App\Providers;

use App\Repositories\EloquentSettingsSiteRepository;
use App\Repositories\SettingsSiteRepository;
use Illuminate\Support\ServiceProvider;

class SettingsSiteProvider extends ServiceProvider
{
    public array $bindings = [
        SettingsSiteRepository::class => EloquentSettingsSiteRepository::class,
    ];
}
