<?php

namespace Kuber\Datatables;

trait ServicesSettings {
    /**
     * Nome da tabela
     *
     * @var string
     */
    public string $table = 'kuber-table-datatables';

    /**
     * Configurações do datatables
     * 
     * Texto com json
     *
     * @var string
     */
    public string $settings = "";

    /**
     * Método Herdado
     * 
     * Executar configurações personalizadas
     *
     * @return void
     */
    public function settingsCustom() {}

    /**
     * Iniciando configurações do datatables
     *
     * @return void
     */
    private function runSettings()
    {
        
        $this->createJson();

        $this->settingsActions();

        $this->runJsonToString();
    }

    /**
     * Criar json com base em Kuber\Datatables\Settings
     *
     * @return void
     */
    private function createJson()
    {
        $this->json = new Settings;
    }

    /**
     * Executando ações de configurações
     *
     * @return void
     */
    private function settingsActions()
    {
        $this->settingsCustom();
    }

    /**
     * Transformando json em string
     *
     * @return void
     */
    private function runJsonToString()
    {
        $this->settings = json_encode($this->json);
    }

    /**
     * Adicionando lista de itens no json
     *
     * @param Array $array array associativo com itens adicionais para o json
     * @return void
     */
    public function addJsonItems(Array $array)
    {
        foreach($array as $property => $value) {
            $this->addJson($property, $value);
        }
    }

    /**
     * Adicionar item no json
     *
     * @param string $property Nome da propriedade
     * @param string|array $value Valor da propriedade
     * @return void
     */
    public function addJson(string $property, string|array $value)
    {
        $this->json->$property = $value;
    }
}