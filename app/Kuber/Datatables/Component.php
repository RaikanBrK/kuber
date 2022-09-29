<?php

namespace Kuber\Datatables;

use Illuminate\View\Component as ComponentIlluminate;

abstract class Component extends ComponentIlluminate {
    use ServicesSettings, ServicesStyle, ServicesData, ServicesActions;

    /**
     * Iniciando o datatables
     *
     * @param null|collection $data Registros
     * @param null|array $header Lista de itens do cabeçalho
     * @param null|array $keys Itens que serão buscado nos registros
     * @param boolean $actions Ações para os registros
     * @param null|array $actionsList Ações que serão exibidas na tabela
     * @param null|array $actionsExcept Ações que não serão exibidas na tabela
     * @param null|string $route Nome principal da rota Ex: {administrators}.show
     * @param string $identifier Atributo que será pesquisado no loop do registros para usar como parâmetro de rota das actions
     * @param null|string $nameFunIdentifier Name da função com o registro como parâmetro e seu retorno será usado como identificador do registro
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
        public $actions = false,
        public $actionsList = null,
        public $actionsExcept = null,
        public $route = null,
        public $identifier = 'id',
        public $nameFunIdentifier = null,
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
        $this->runActions();
    }
}