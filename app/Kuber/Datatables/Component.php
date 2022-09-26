<?php

namespace Kuber\Datatables;

use Illuminate\View\Component as ComponentIlluminate;

abstract class Component extends ComponentIlluminate {
    use ServicesSettings, ServicesStyle;

    /**
     * Iniciando o datatables
     *
     * @param boolean $noAssets
     */
    public function __construct(
        public $noAssets = false,
    )
    {
        $this->init();
        $this->bootstrap();
    }

    /**
     * Método substituto do __construct para não sobrescrever as propriedades padrões
     *
     * @return void
     */
    public function init() {}

    /**
     * Iniciando dependências do datatables
     *
     * @return void
     */
    public function bootstrap()
    {
        $this->runSettings();
    }
}