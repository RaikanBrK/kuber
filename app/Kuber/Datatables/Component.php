<?php

namespace Kuber\Datatables;

use Illuminate\View\Component as ComponentIlluminate;

abstract class Component extends ComponentIlluminate {
    use ServicesSettings, ServicesStyle, ServicesData;

    /**
     * Iniciando o datatables
     *
     * @param null|collection $data Registros
     * @param null|array $header Lista de itens do cabeçalho
     * @param null|array $keys Itens que serão buscado nos registros
     * @param boolean $noAssets Não Adicionar o script de inicialização
     * @param boolean $tableDark Tabela dark
     * @param boolean $tableStriped Tabela Striped
     * @param boolean $tableBordered Tabela Bordered
     * @param boolean $tableBorderless Tabela Borderless
     * @param boolean $tableHover Tabela Hover
     * @param boolean $theadDark Cabeçalho da tabela dark
     * @param boolean $theadLight Cabeçalho da tabela light
     * 
     */
    public function __construct(
        public $data = null,
        public $header = null,
        public $keys = null,
        public $noAssets = false,
        public $tableDark = false,
        public $tableStriped = false,
        public $tableBordered = false,
        public $tableBorderless = false,
        public $tableHover = false,
        public $theadDark = false,
        public $theadLight = false,
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
        $this->runStyles();
        $this->runData();
    }
}