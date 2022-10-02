<?php

namespace App\Http\Livewire\kuber\datatables;

use Livewire\Component;

use Kuber\Datatables\ServicesActions;
use Kuber\Datatables\ServicesData;
use Kuber\Datatables\ServicesSettings;
use Kuber\Datatables\ServicesStyle;

abstract class ComponentDatatables extends Component
{
    use ServicesSettings, ServicesStyle, ServicesData, ServicesActions;

    public $data = null;

    public $header = null;

    public $keys = null;

    public $actions = false;

    public $actionsList = null;

    public $actionsExcept = null;

    public $route = null;

    public $identifier = 'id';

    public $nameFunIdentifier = null;

    public $noAssets = false;

    public $tableDark = false;

    public $tableStriped = false;

    public $tableBordered = false;

    public $tableBorderless = false;

    public $tableHover = false;

    public $theadDark = false;

    public $theadLight = false;
    
    /**
     * Construindo o datatables
     *
     * @return void
     */
    public function mount()
    {
        $this->bootstrap();
        $this->init();
    }

     /**
     * Método executado com o mount para continuar construindo o datatables
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
        $this->runStyles();
        $this->runData();
        $this->runActions();
    }
}
