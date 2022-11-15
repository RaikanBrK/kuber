<?php

namespace App\Http\Livewire\Admin\Datatables;

use App\Models\CountForPage;
use App\Repositories\EloquentUserRepository;
use Illuminate\Support\Facades\Auth;
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

    public $countForPage = 1;

    public $countForPageAll;

    /**
     * Construindo o datatables
     *
     * @return void
     */
    public function mount()
    {
        $this->bootstrap();
        $this->init();
        $this->initCountForPage();
    }

    public function initCountForPage()
    {
        $this->countForPageAll = CountForPage::all();
        $this->countForPage = Auth::user()->countForPage->number;
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

    public function updatedCountForPage()
    {
        $idCountForPage = $this->countForPageAll->where('number', $this->countForPage)->first()->id;

        $repository = new EloquentUserRepository();
        $repository->updateCountForPage($idCountForPage);

    }

    protected function resetDateRemoveItem($id)
    {
        foreach ($this->data as $key => $value) {
            if ($this->data[$key]->id == $id) {
                $this->data->forget($key);
            }
        }

        $this->updateData($this->data);
        $this->bootstrap();
    }
}
