<?php

namespace Kuber\Datatables;

trait ServicesStyle {
    /**
     * Classes que serão atribuídas na tabela
     *
     * @var string
     */
    public $tableClass = '';

    /**
     * Classes que serão atribuídas no cabeçalho da tabela
     *
     * @var string
     */
    public $theadClass = '';

    /**
     * Classes permitidas na tabela
     *
     * @var array
     */
    protected $tableClassPermission = [
        'tableDark',
        'tableStriped',
        'tableBordered',
        'tableBorderless',
        'tableHover',
    ];

    /**
     * Classes permitidas no cabeçalho da tabela
     *
     * @var array
     */
    protected $theadClassPermission = [
        'theadDark',
        'theadLight',
    ];

    /**
     * Iniciando configurações de estilos
     *
     * @return void
     */
    public function runStyles()
    {
        $this->addClass();
    }

    /**
     * Adicionando classes
     *
     * @return void
     */
    public function addClass()
    {
        $this->addItemClass('tableClass', 'tableClassPermission');
        $this->addItemClass('theadClass', 'theadClassPermission');
    }

    /**
     * Verificando lista de classes permitidas com as propriedades passadas pelo componente
     * 
     * E adicionando em suas respectivas string de classe
     *
     * @param string $propriety Nome da propriedade que terá as classes
     * @param string $listPermission Nome da propriedade com todas as classes permitidas
     * @return void
     */
    public function addItemClass(string $propriety, string $listPermission) 
    {
        $listPermissionKebabCase = $this->convertStringToKebabCase($this->$listPermission);

        foreach ($listPermissionKebabCase as $index => $class) {
            $this->$propriety .= $this->$index == true ? $class . ' ' : '';
        }
    }

    /**
     * Convertendo os valores do array para Kebab case
     *
     * @param array $array
     * @return Array
     */
    public function convertStringToKebabCase(Array $array)
    {
        $arrayNewValues = [];
        foreach($array as $item) {
            $value = '';

            $chars = str_split($item);
            for ($x = 0; $x < count($chars); $x++) {
                $char = $chars[$x];

                if (ctype_upper($char)) {
                    $value .= '-' . strtolower($char);
                } else {
                    $value .= $char;
                }
            }

            $arrayNewValues[$item] = $value;
        }

        return $arrayNewValues;
    }
}