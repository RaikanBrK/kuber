class Sort {
    sort(selectorHeadTh) {
        this.ths = $(selectorHeadTh);
        this.lastIdxThSort = null;
        this.th = null;
        this.indexTh = null;

        this.initSort();
    }

    setSettingsTh(th) {
        this.th = th;
        this.indexTh = this.th.attr('data-kuberId');
    }

    initSort() {
        this.addEventClickSort();

        this.setSettingsTh($(this.ths).first());
        this.controllerSort();
    }

    addEventClickSort() {
        this.ths.on('click', this.clickControllerSort.bind(this));
    }

    clickControllerSort(e) {
        this.setSettingsTh($(e.target));
        this.controllerSort();
    }

    controllerSortInit() {
        this.clearClassItens();

        return this.indexTh == this.lastIdxThSort ?
            this.sortDesc() :
            this.sortAsc();
    }

    controllerSort() {
        const newDate = this.controllerSortInit();
        this.updateSort(newDate);
    }

    sortAsc() {
        this.lastIdxThSort = this.indexTh;
        this.th.addClass('kuber-table-sort-asc');

        return this.date.registers.sort((a, b) => {
            let tdA = $($(a.element).find('td')[this.indexTh]).text();
            let tdB = $($(b.element).find('td')[this.indexTh]).text();
            
            if (Number(tdA) && Number(tdB)) {
                return Number(tdA) < Number(tdB) ? -1 : 0;
            } else {
                return tdA.localeCompare(tdB);
            }
        });
    }

    sortDesc() {
        this.lastIdxThSort = null;
        this.th.addClass('kuber-table-sort-desc');

        return this.date.registers.sort((a, b) => {
            let tdA = $($(a.element).find('td')[this.indexTh]).text();
            let tdB = $($(b.element).find('td')[this.indexTh]).text();
            
            if (Number(tdA) && Number(tdB)) {
                return Number(tdA) < Number(tdB) ? 0 : -1;
            } else {
                return tdB.localeCompare(tdA);
            }
        });
    }

    clearClassItens() {
        this.ths.removeClass('kuber-table-sort-asc kuber-table-sort-desc');
    }
}

class Search extends Sort {
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
        this.qtdPaginas = Math.ceil(this.date.registers.length / this.qtdRegistrosPorPaginas);
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
    updatePagination(linkPagination = null) {
        let link = linkPagination == null ? 1 : linkPagination;

        this.setQtdPaginas();
        this.setQtdRegistrosPorPaginas();

        if (link > this.qtdPaginas) {
            link = this.qtdPaginas;
        } else if (link < 1) {
            link = 1;
        }

        this.setLinkPagination(link);
        this.createPagination();
    }

    /**
     * Iniciando a criação da paginação
     */
    IniciandoCriacaoDaPaginacao() {
        this.addEventChangeRegistrosPorPagina();
        this.setQtdRegistrosPorPaginas();
    }

    deleteRegistro(retorno, id) {
        if (retorno == 'success-delete-user') {
            $(this.body).find(`.kuber-table-tr[data-kuberIdItem=${id}]`).remove();

            this.dateAll = this.dateAll.filter(item => {
                return item.id != id;
            });
            
            let date = this.date.registers.filter(item => {
                return item.id != id;
            });

            this.updateDateViewer(date);
            
        }
    }

    /**
     * Adicionando evento para alterar a quantidade de registros por páginas
     */
    addEventChangeRegistrosPorPagina() {
        Livewire.hook('message.processed', (message, component) => {
            let link = null;
            let effects = message.response.effects;
            let payload = message.updateQueue[0].payload;
            let retorno = effects.returns ? Object.values(effects.returns)[0] : false;
            
            if (payload.event == 'delete') {
                let id = payload.params[0];
                link = this.linkPagination;
                this.deleteRegistro(retorno, id);
            }

            this.updatePagination(link);
        })
    }

    /**
     * Criar paginação
     */
    createPagination() {
        this.createViewerPagination();

        this.alterarPaginationAtiva();
    }

    /**
     * Criar item na paginação
     * 
     * @param {number|null} link Identificador do item
     * @param {string|null} text Texto de exibição do item
     * @param {string|null} itemClass Classe css do item
     */
    createAppendItemPagination(link = null, text = null, itemClass = '') {
        let linkHtml = '';
        let textHtml = '...';

        if (link != null) {
            linkHtml = `href="#" data-link="${link}"`;

            textHtml = text == null ? link : text;
        }

        this.containerPagination.append(`
            <li class="page-item ${itemClass}">
                <a class="page-link" ${linkHtml}>${textHtml}</a>
            </li>
        `);
    }

    /**
     * Criar loop para criar item na paginação
     * 
     * @param {number} init Valor inicial do loop
     * @param {number} finish Valor final do loop
     */
    createLoopAppendItemPagination(init, finish) {
        for (let index = init; index <= finish; index++) {
            this.createAppendItemPagination(index);
        }
    }

    /**
     * Criar Visualização da paginação
     */
    createViewerPagination() {
        this.setQtdPaginas();

        this.containerPagination.html('');

        this.createAppendItemPagination('prev', 'Anterior', 'kuber-link-prev');
        
        this.qtdPaginas > 7 ? this.paginationResponsive() : this.paginationDefault();
    
        this.createAppendItemPagination('next', 'Próximo', 'kuber-link-next');

        this.addEventClickItemPagination();
    }

    /**
     * Criar paginação responsiva
     */
    paginationResponsive() {
        let numReduce = 3;
        let qtdReduce = this.qtdPaginas - numReduce;

        // Primeiro
        this.createAppendItemPagination('1', '1');

        if (this.linkPagination > numReduce) {
            if (this.linkPagination < qtdReduce) {
                this.createAppendItemPagination();

                this.createLoopAppendItemPagination(this.linkPagination - 1, this.linkPagination + 1);
            }
        } else {
            this.createLoopAppendItemPagination(2, 5);
        }

        if (this.linkPagination >= qtdReduce) {
            this.createAppendItemPagination();

            this.createLoopAppendItemPagination(this.qtdPaginas - 4, this.qtdPaginas - 1);
        } else {
            this.createAppendItemPagination();
        }

        // Último
        this.createAppendItemPagination(this.qtdPaginas);
    }

    /**
     * Criar paginação sem responsividade
     */
    paginationDefault() {
        this.createLoopAppendItemPagination(1, this.qtdPaginas);
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

        this.createPagination();
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
        this.body = null;
        this.lines = null;
        this.dateAll = [];
        this.date = [];
        this.text = null;

        this.createDateAll();
    }

    getBody() {
        this.body = $(this.table.find('tbody'));
        return this.body;
    }

    getLines() {
        this.lines = $($(this.getBody()).find('tr.kuber-table-tr'));
        return this.lines;
    }

    createDateAll() {
        this.getLines().each((idx, element) => {
            let id = idx + 1;
            this.dateAll.push({
                viewer: false,
                id: Number($(element).attr('data-kuberIdItem')),
                element: $(element),
            });
        });

        this.getLines().remove();
        this.updateDateViewer(this.dateAll);
    }

    updateDateViewer(date = []) {
        this.date.registers = date;
    }

    updateViewerDateTable() {
        let qtdRegistrosViewer = 0;
        let initRegistros = (this.qtdRegistrosPorPaginas * (this.linkPagination - 1));
        let countLoop = 0;

        let tbody = this.getBody();
        tbody.html('');

        for (const [idx, item] of Object.entries(this.date.registers)) {
            if (item) {
                if (countLoop >= initRegistros && qtdRegistrosViewer < this.qtdRegistrosPorPaginas) {
                    item.viewer = true;
                    qtdRegistrosViewer++;
                    tbody.append(item.element);
                } else {
                    item.viewer = false;
                    item.element.remove();
                }
            }

            countLoop++
        }

        this.addEventClickDelete();
    }

    addEventClickDelete() {
        this.table.find('tbody tr.kuber-table-tr .kuber-datatables-action-delete').on('click', e => {
            let button = $(e.target);
            let element = button.closest('tr.kuber-table-tr');
            let id = element.attr('data-kuberIdItem');

            window.livewire.emit('delete', id);

            e.preventDefault();
        })
    }

    createDateTableSearch() {
        var filter = this.text.toUpperCase();
        var newDate = [];

        for (const [idx, item] of Object.entries(this.dateAll)) {
            var td = $(item.element).find("td.kuber-table-td");
            td.each((idx, element) => {
                let txtValue = element.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    newDate.push(item);
                    return false;
                }
            });
        }

        this.updateDateViewer(newDate);

        this.updatePagination();
    }

    updateSort(newDate) {
        this.updateDateViewer(newDate);
        this.updatePagination();
    }

    create() {
        this.updatePagination();
    }
}

jQuery(() => {
    const table = new DataTable('.kuber-table-datatables');
    table.pagination('#countForPage', '#paginationDatatables');
    table.search('#search');
    table.sort('.kuber-table-th');
    table.create();
});
