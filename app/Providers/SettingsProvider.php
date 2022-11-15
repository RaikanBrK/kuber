<?php

namespace App\Providers;

use App\Repositories\SettingsSite\EloquentSettingsSiteRepository;
use App\Repositories\SettingsSite\SettingsSiteRepository;
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    public array $bindings = [
        SettingsRepository::class => EloquentSettingsRepository::class,
    ];
}
