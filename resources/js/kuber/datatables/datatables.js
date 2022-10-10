class Pagination {
    pagination(selectorCountForPage, selectorContainerPagination, activeItemPaginationInit = 1) {
        this.selectorCountForPage = selectorCountForPage;
        this.containerPagination = $(selectorContainerPagination);
        this.countForPage = 10;
        this.countPagination = null;
        this.linkPagination = null;
        this.activeItemPaginationInit = activeItemPaginationInit;
        this.initCountForPage();
    }

    setLinkPagination(linkPagination) {
        this.linkPagination = linkPagination;
    }

    initCountForPage() {
        this.addEventChangeCountPage();
        this.setCountPage();
    }

    resetPagination() {
        this.setLinkPagination(1);
        this.setCountPage();
    }

    addEventChangeCountPage() {
        $(this.selectorCountForPage).on('change', this.resetPagination.bind(this));
    }

    setCountPage() {
        this.countForPage = Number($(this.selectorCountForPage).val());
        this.createPagination();
    }

    createPagination() {
        this.updateDate();

        this.createViewerPagination();

        if (this.linkPagination == null) {
            this.setLinkPagination(this.activeItemPaginationInit);
        }
        this.changeActivePagination();
    }

    setCountPagination() {
        this.countPagination = Math.ceil(this.date.length / this.countForPage);
    }

    createViewerPagination() {
        this.setCountPagination();

        this.containerPagination.html('');
        
        this.containerPagination.append(`
            <li class="page-item kuber-link-prev">
                <a class="page-link" href="#" data-link="prev">Anterior</a>
            </li>
        `);

        for (let index = 1; index <= this.countPagination; index++) {
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

    addEventClickItemPagination() {
        $(this.containerPagination.find('.page-link')).on('click', this.clickItemPagination.bind(this));
    }

    clickItemPagination(e) {
        const element = $(e.target);

        if (element.closest('.page-item').hasClass('active')) {
            return false;
        }

        this.setLinkPagination(element.attr('data-link'));

        this.changeActivePagination();
    }

    changeActivePagination() {
        this.linkItemPagination();

        this.changeViewerDateFromPagination();
    }

    changeViewerDateFromPagination() {
        this.updateViewerDateTable();
    }

    linkItemPagination() {
        let linkPaginationActive = Number($(this.containerPagination.find('.page-item.active .page-link')).attr('data-link'));

        this.linkPagination = 
            this.linkPagination == 'next' ? ++linkPaginationActive :
            this.linkPagination == 'prev' ? --linkPaginationActive :
            Number(this.linkPagination);

        this.activeLinkItemPagination();
    }

    activeLinkItemPagination() {
        let next = $(this.containerPagination.find('.kuber-link-next'));
        let prev = $(this.containerPagination.find('.kuber-link-prev'));

        if (this.countPagination == 1) {
            next.addClass('disabled');
            prev.addClass('disabled');
        } else if (this.linkPagination >= this.countPagination) {
            this.linkPagination = this.countPagination;
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
        this.date = $(this.table.find('tbody tr'));
    }

    updateDate() {
        this.date = $(this.table.find('tbody tr'));
    }

    updateViewerDateTable() {
        $(this.table.find('tbody .kuber-table-tr')).each((idx, element) => {
            let initRegistros = (this.countForPage * (this.linkPagination - 1)) - 1;

            if (idx > initRegistros && idx < (Number(initRegistros) + Number(this.countForPage) + 1)) {
                element.style.display = "";
            } else {
                element.style.display = "none";
            }
        });
    }
}

const table = new DataTable('.kuber-table-datatables');
table.pagination('#countForPage', '#paginationDatatables');
