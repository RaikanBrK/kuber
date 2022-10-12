class Search {
    search(selectorInput) {
        this.input = $(selectorInput)
        this.initSearch();
    }

    initSearch() {
        this.addEventChangeSearch();
    }

    addEventChangeSearch() {
        $(this.input).on('keyup', this.updateSearchInput.bind(this));
    }

    updateSearchInput() {
        this.text = this.input.val().toUpperCase();
        this.createDateTableSearch();
    }
}

class Pagination extends Search {
    constructor() {
        super();
    }

    pagination(seletorRegistrosPorPagina, selectorContainerPagination, paginationAtivaAoIniciar = 1) {
        this.seletorRegistrosPorPagina = seletorRegistrosPorPagina;
        this.containerPagination = $(selectorContainerPagination);
        this.qtdRegistrosPorPaginas = 10;
        this.qtdPaginas = null;
        this.linkPagination = null;
        this.paginationAtivaAoIniciar = paginationAtivaAoIniciar;
        this.IniciandoCriacaoDaPaginacao();
    }

    /**
     * Setando o link da página atual
     * 
     * @param {integer} linkPagination 
     */
    setLinkPagination(linkPagination) {
        this.linkPagination = linkPagination;
    }

    /**
     * Setando quantidade de paginação de 
     * Acordo com o números de registros e a quantidade de registros por páginas
     */
    setQtdPaginas() {
        this.qtdPaginas = Math.ceil(this.date.length / this.qtdRegistrosPorPaginas);
    }

    /**
     * Setando quantidade de registros por página
     */
      setQtdRegistrosPorPaginas() {
        this.qtdRegistrosPorPaginas = Number($(this.seletorRegistrosPorPagina).val());
    }

    /**
     * Recriando paginação
     */
    resetPagination() {
        this.setLinkPagination(1);
        this.setQtdRegistrosPorPaginas();
        this.createPagination();
    }

    /**
     * Iniciando a criação da paginação
     */
    IniciandoCriacaoDaPaginacao() {
        this.addEventChangeRegistrosPorPagina();
        this.setQtdRegistrosPorPaginas();
        this.createPagination();
    }

    /**
     * Adicionando evento para alterar a quantidade de registros por páginas
     */
    addEventChangeRegistrosPorPagina() {
        $(this.seletorRegistrosPorPagina).on('change', this.resetPagination.bind(this));
    }

    /**
     * Criar paginação
     */
    createPagination() {
        this.createViewerPagination();

        this.alterarPaginationAtiva();
    }

    /**
     * Criar Visualização da paginação
     */
    createViewerPagination() {
        this.setQtdPaginas();

        this.containerPagination.html('');
        
        this.containerPagination.append(`
            <li class="page-item kuber-link-prev">
                <a class="page-link" href="#" data-link="prev">Anterior</a>
            </li>
        `);

        for (let index = 1; index <= this.qtdPaginas; index++) {
            this.containerPagination.append(`
                <li class="page-item">
                    <a class="page-link" href="#" data-link="${index}">${index}</a>
                </li>
            `);
        }
    
        this.containerPagination.append(`
            <li class="page-item kuber-link-next">
                <a class="page-link" href="#" data-link="next">Próximo</a>
            </li>
        `);

        this.addEventClickItemPagination();
    }

    /**
     * Adicionando evento de click nos item de paginação
     */
    addEventClickItemPagination() {
        $(this.containerPagination.find('.page-link')).on('click', this.changeClickItemPagination.bind(this));
    }

    /**
     * Alterando paginação com evento
     * 
     * @param {event} e 
     * @returns {false} Falos em caso de erro
     */
    changeClickItemPagination(e) {
        const element = $(e.target);

        if (element.closest('.page-item').hasClass('active')) {
            return false;
        }

        this.setLinkPagination(element.attr('data-link'));

        this.alterarPaginationAtiva();
    }

    /**
     * Alterar item da paginação ativo
     */
    alterarPaginationAtiva() {
        this.setandoLinkPaginationInterativo();

        this.changeViewerDateFromPagination();
    }

    /**
     * Atualizar dados de visualização da tabela
     */
    changeViewerDateFromPagination() {
        this.updateViewerDateTable();
    }

    /**
     * Setando link pagination com a partir da interação do usuário com a paginação
     */
    setandoLinkPaginationInterativo() {
        if (this.linkPagination == null) {
            this.setLinkPagination(this.paginationAtivaAoIniciar);
        }

        let linkPaginationActive = Number($(this.containerPagination.find('.page-item.active .page-link')).attr('data-link'));

        this.linkPagination = 
            this.linkPagination == 'next' ? ++linkPaginationActive :
            this.linkPagination == 'prev' ? --linkPaginationActive :
            Number(this.linkPagination);

        this.alterandoClassesItemPagination();
    }

    /**
     * Alterando classes dos itens da paginação
     */
    alterandoClassesItemPagination() {
        let next = $(this.containerPagination.find('.kuber-link-next'));
        let prev = $(this.containerPagination.find('.kuber-link-prev'));

        if (this.qtdPaginas == 1) {
            next.addClass('disabled');
            prev.addClass('disabled');
        } else if (this.linkPagination >= this.qtdPaginas) {
            this.linkPagination = this.qtdPaginas;
            next.addClass('disabled');
            prev.removeClass('disabled');
        } else if(this.linkPagination <= 1) {
            next.removeClass('disabled');
            prev.addClass('disabled');
        } else {
            next.removeClass('disabled');
            prev.removeClass('disabled');
        }

        let elementItem = $(this.containerPagination.find(`.page-item .page-link[data-link=${this.linkPagination}]`));

        $(this.containerPagination.find('.page-item')).removeClass('active');
        elementItem.closest('.page-item').addClass('active');
    }
}

class DataTable extends Pagination {
    constructor(table) {
        super();
        this.table = $(table);
        this.dateAll = {};
        this.date = {};
        this.text = null;

        this.createDateAll();
    }

    createDateAll() {
        $(this.table.find('tbody tr')).each((idx, element) => {
            let id = idx + 1;
            $(element).attr('data-kuberId', id);
            this.dateAll[idx] = {
                viewer: false,
                id: id,
                element: $(element),
            };
        });

        this.updateDateViewer(this.dateAll);
    }

    updateDateViewer(date = {}) {
        $('.kuber-d-auto').removeClass('kuber-d-auto');
        
        this.date.registers = date;
        this.date.length = Object.keys(this.date.registers).length;
    }

    updateViewerDateTable() {
        let qtdRegistrosViewer = 0;
        let initRegistros = (this.qtdRegistrosPorPaginas * (this.linkPagination - 1));
        let countLoop = 0;

        for (const [idx, item] of Object.entries(this.date.registers)) {
            if (item) {
                if (countLoop >= initRegistros && qtdRegistrosViewer < this.qtdRegistrosPorPaginas) {
                    item.viewer = true;
                    qtdRegistrosViewer++;
                    item.element.addClass('kuber-d-auto');
                } else {
                    item.viewer = false;
                    item.element.removeClass('kuber-d-auto');
                }
            }
            countLoop++
        }
    }

    createDateTableSearch() {
        var filter = this.text.toUpperCase();
        var newDate = {};

        let countLoop = 0;
        for (const [idx, item] of Object.entries(this.dateAll)) {
            var td = $(item.element).find("td.kuber-table-td");
            td.each((idx, element) => {
                let txtValue = element.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    newDate[countLoop] = item;
                    return false;
                }
            });

            countLoop++;
        }

        this.updateDateViewer(newDate);

        this.resetPagination();
    }
}

const table = new DataTable('.kuber-table-datatables');
table.pagination('#countForPage', '#paginationDatatables');
table.search('#search');
