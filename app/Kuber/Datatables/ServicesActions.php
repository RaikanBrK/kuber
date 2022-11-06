<?php

namespace Kuber\Datatables;

use Illuminate\Support\Facades\Route;

trait ServicesActions {
    /**
     * Texto exibido no cabeçalho da tabela para ações
     *
     * @var string
     */
    public $labelAction = 'Ações';

    /**
     * Todas as ações
     *
     * @var array
     */
    public $listAllActions = [
        'viewer' => [
            'action' => 'viewer',
            'title' => 'Visualizar',
            'icon' => 'fa-info',
            'route' => 'show',
        ],
        'edit' => [
            'action' => 'edit',
            'title' => 'Editar',
            'icon' => 'fa-edit',
            'route' => 'edit'
        ],
        'delete' => [
            'action' => 'delete',
            'title' => 'Remover',
            'icon' => 'fa-trash-alt',
            'route' => 'destroy',
            'method' => 'delete',
        ],
        'transfer' => [
            'action' => 'transfer',
            'title' => 'Transferir',
            'icon' => 'fa-exchange-alt',
            'route' => 'store',
            'method' => 'post',
            'livewire' => 'modal',
        ],
    ];
    
    /**
     * Ações ativa por default
     *
     * @var array
     */
    public $listActionsDefault = ['viewer', 'edit', 'delete'];

    /**
     * Ações que serão visualizadas
     *
     * @var array
     */
    public $listActionsViewer = [];

    /**
     * Iniciando configurações das actions
     *
     * @return void
     */
    private function runActions()
    {
        if ($this->actions != true) {
            return false;
        }

        $this->setActions();
        $this->setAttributesDefault();
    }

    /**
     * Adicionando actions
     *
     * @return void
     */
    private function setActions()
    {
        $list = $this->actionsList != null ? $list = $this->actionsList : $this->listActionsDefault;

        $this->createActions($list);
        $this->exceptActions();
    }

    /**
     * Adicionando actions na lista de actions de visualização
     *
     * @param array $actions
     * @return void
     */
    private function createActions($actions)
    {
        foreach($actions as $nameAction) {
            $this->listActionsViewer[$nameAction] = $this->listAllActions[$nameAction];
        }
    }

    /**
     * Lista de actions que não devem ser incluídas
     *
     * @return void
     */
    private function exceptActions()
    {
        if ($this->actionsExcept == null) {
            return false;
        }

        foreach($this->actionsExcept as $action) {
            unset($this->listActionsViewer[$action]);
        }        
    }

    /**
     * Setando rota principal da action
     * 
     * Exemplo {administrators}.show
     *
     * @return void
     */
    private function routeNameAction()
    {
        if ($this->route == null) {
            $this->route = explode('.', Route::currentRouteName())[0];
        }
    }

    /**
     * Adicionando atributos adicionais por padrão para a tabela
     *
     * @return void
     */
    private function setAttributesDefault()
    {
        $this->setMethodsActions();
        $this->setRouteActions();
        $this->setIdentifierData();
        $this->setLivewire();
    }

    /**
     * Adicionando atributo com os métodos de envio de formulário conhecidos pelo HTML5
     *
     * @return void
     */
    private function setMethodsActions()
    {
        foreach($this->listActionsViewer as $action) {
            $this->listActionsViewer[$action['action']]['methodFormHtml'] = isset($action['method']) && $action['method'] != 'get'
                ? 'post'
                : 'get';
        }
    }

    /**
     * Adicionando atributo com o nome principal da rota
     * 
     * Exemplo de nome de rota
     * administrators.show
     * 
     * administrators é o nome principal da rota
     *
     * @return void
     */
    private function setRouteActions()
    {
        $this->routeNameAction();

        foreach($this->listActionsViewer as $action) {
            $link = 'home';

            if ($action['route']) {
                $route = $this->route . '.' . $action['route'];

                if (Route::has($route)) {
                    $link = $route;
                }
            }

            $this->listActionsViewer[$action['action']]['link'] = $link;
        }
    }

    /**
     * Adicionando identificador no registro com base na função ou o atributo para pesquisar no registro
     *
     * @return void
     */
    private function setIdentifierData()
    {
        $fun = $this->nameFunIdentifier;

        foreach($this->dataArray as $key => $value) {
            $this->dataArray[$key]['identifier'] = $fun == null ? $value[$this->identifier] : $this->$fun($value);
        }
    }

    private function setLivewire()
    {
        foreach($this->listActionsViewer as $action) {
            $livewire = isset($action['livewire']) ? $action['livewire'] : false;


            $this->listActionsViewer[$action['action']]['livewire'] = $livewire;
        }
    }
}