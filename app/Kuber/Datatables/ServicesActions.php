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
    public function runActions()
    {
        if ($this->actions != true) {
            return false;
        }

        $this->setActions();
        $this->routeNameAction();
    }

    /**
     * Adicionando actions
     *
     * @return void
     */
    public function setActions()
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
    public function createActions($actions)
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
    public function exceptActions()
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
    protected function routeNameAction()
    {
        if ($this->route == null) {
            $this->route = explode('.', Route::currentRouteName())[0];
        }
    }

    /**
     * Recuperando nome da rota que será usada na ação 
     *
     * @param array $action
     * @return string
     */
    public function routeActionName($action)
    {
        $link = 'home';
        if ($action['route']) {
            $route = $this->route . '.' . $action['route'];

            // administrators.show
            if (Route::has($route)) {
                $link = $route;
            }
        }

        return $link;
    }

    /**
     * Retornando parâmetro que será usado como identificador na rota
     *
     * @param array $data
     * @return string
     */
    public function routeActionParam($data)
    {
        $fun = $this->nameFunIdentifier;

        return $fun == null ? $data[$this->identifier] : $this->$fun($data);
    }

    /**
     * Retornando métodos de requisição para formulário em html
     *
     * @param [type] $action
     * @return string 'get'|'post'
     */
    public function methodFormHtml($action)
    {
        $method = $action['method'] ?? 'get';
        return strtolower($method) == 'get' ? 'get' : 'post';
    }
}