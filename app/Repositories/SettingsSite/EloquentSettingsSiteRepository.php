<?php

namespace App\Repositories\SettingsSite;

use App\Models\SettingsSite;

class EloquentSettingsSiteRepository implements SettingsSiteRepository
{
    protected $id = 1;

    public function updateHead($head)
    {
        SettingsSite::where('id', $this->id)->update([
            'tagsHead' => $head,
        ]);
    }

    public function updateBody($body)
    {
        SettingsSite::where('id', $this->id)->update([
            'tagsBody' => $body,
        ]);
    }

    public function updateViewCounter($viewCounter)
    {
        SettingsSite::where('id', $this->id)->update([
            'view_counter' => $viewCounter,
        ]);
    }
}
