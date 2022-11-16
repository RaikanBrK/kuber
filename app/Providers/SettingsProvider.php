<?php

namespace App\Providers;

use App\Repositories\Settings\SettingsRepository;
use App\Repositories\Settings\EloquentSettingsRepository;
use Illuminate\Support\ServiceProvider;

class SettingsProvider extends ServiceProvider
{
    public array $bindings = [
        SettingsRepository::class => EloquentSettingsRepository::class,
    ];
}
