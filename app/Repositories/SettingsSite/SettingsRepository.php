<?php

namespace App\Repositories\SettingsSite;

interface SettingsRepository
{
    public function updateHead($head);

    public function updateBody($body);

    public function updateViewCounter($request);
}
