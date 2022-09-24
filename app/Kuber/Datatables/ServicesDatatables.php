<?php

namespace Kuber\Datatables;

use Illuminate\View\Component;

abstract class ServicesDatatables extends Component {
    use ServicesSettings;

    public function __construct()
    {
        $this->bootstrap();
    }

    /**
     * Iniciando configurações
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->runSettings();
    }
}