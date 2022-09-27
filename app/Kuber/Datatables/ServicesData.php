<?php

namespace Kuber\Datatables;

trait ServicesData {
    /**
     * Array com os registros
     *
     * @var array
     */
    public $dataArray = [];

    /**
     * Itens que serão renderizados no cabeçalho da tabela
     *
     * @var array
     */
    public $itemsHeader = [];

    /**
     * Valores que serão buscado dos registros
     *
     * @var array
     */
    public $itemsKeys = [];

    /**
     * Iniciando configuração automática com os registros
     *
     * @return void
     */
    public function runData()
    {
        if ($this->data == null) {
            return false;
        }

        $this->createDataArray();
        $this->createDatasTable();
    }

    /**
     * Criando valores para a tabela
     *
     * @return void
     */
    public function createDatasTable()
    {
        $this->createHeader();
        $this->createKeys();
    }

     /**
     * Transformando registros em array
     *
     * @return void
     */
    public function createDataArray()
    {
        $this->dataArray = $this->data->toArray();
    }

    /**
     * Criando cabeçalho da tabela
     *
     * @return void
     */
    public function createHeader()
    {
        $header = $this->header == null ? array_keys($this->dataArray[0]) : $this->header;

        if (array_is_list($header) == false) {
            $this->keys = array_keys($header);
        }

        $this->itemsHeader = $header;
    }

    /**
     * Criando valores que serão buscados na tabela
     *
     * @return void
     */
    public function createKeys()
    {
        $keys = $this->keys == null ? array_keys($this->dataArray[0]) : $this->keys;

        if (array_is_list($keys) == false) {
            $this->itemsHeader = array_values($keys);
            $keys = array_keys($keys);
        }

        $this->itemsKeys = $keys;
    }
}