<?php

namespace App\Repositories\Settings;

use App\Models\Settings;

class EloquentSettingsRepository implements SettingsRepository
{
    protected $id = 1;

    public function updateHead($head)
    {
        Settings::where('id', $this->id)->update([
            'head' => $head,
        ]);
    }

    public function updateBody($body)
    {
        Settings::where('id', $this->id)->update([
            'body' => $body,
        ]);
    }

    public function updateViewCounter($request)
    {
        $viewCounter = $request->toggleViewCounter == 'on';

        Settings::where('id', $this->id)->update([
            'view_counter' => $viewCounter,
            'period_count_visits' => $request->period_count_visits,
        ]);
    }

    public function addSettingsFrontEnd($request)
    {
        Settings::where('id', $this->id)->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
    }
}
