<?php

namespace App\Repositories\Settings;

use App\Models\SettingsSite;

class EloquentSettingsRepository implements SettingsRepository
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

    public function updateViewCounter($request)
    {
        $viewCounter = $request->toggleViewCounter == 'on';

        SettingsSite::where('id', $this->id)->update([
            'view_counter' => $viewCounter,
            'periodCountVisits' => $request->periodCountVisits,
        ]);
    }
}
