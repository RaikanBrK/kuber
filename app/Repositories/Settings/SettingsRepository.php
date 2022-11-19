<?php

namespace App\Repositories\Settings;

interface SettingsRepository
{
    public function updateHead($head);

    public function updateBody($body);

    public function updateViewCounter($request);

    public function addSettingsFrontEnd($request);
}
