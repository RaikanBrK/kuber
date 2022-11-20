<?php

namespace Kuber\Dashboard;

use App\Models\CounterViewerUser;
use DateTime;

trait DataViewCounter {
    protected $labels = [];
    protected $date = null;
    protected $data = [];
    protected $dateInit = null;

    protected function runData()
    {
        $this->date = new DateTime('-11 month');
        $this->dateInit = clone $this->date;
        
        for($i = 0; $i < 12; $i++) {
            $this->setLabel();
            $this->date->modify('+1 month');
        }

        $this->setData();
    }

    protected function setLabel()
    {
        $this->data[$this->date->format('m')] = 0;

        $labelMonth = str_replace('home.', '', __('home.' . $this->date->format('M')));
        array_push($this->labels, $labelMonth);
    }

    protected function setData()
    {
        $views = CounterViewerUser::where('updated_at', '>', $this->dateInit)->orderBy('updated_at')->get();

        $views->filter(function($value) {
            $monthId = strval($value->updated_at->format('m'));

            $this->data[$monthId] = ($this->data[$monthId] ?? 0) + 1;
        });
    }
}