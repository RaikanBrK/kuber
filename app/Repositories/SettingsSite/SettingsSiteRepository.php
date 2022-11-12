<?php

namespace App\Repositories\SettingsSite;

interface SettingsSiteRepository
{
    public function updateHead($head);

    public function updateBody($body);
}
