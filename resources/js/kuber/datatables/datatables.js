const table = $('table');
var indexTh = null;

function sortTable(idx, th) {
    let tbody = $(table.find('tbody'));
    let asc = true;

    $(table.find('.kuber-table-th')).removeClass('kuber-table-sort-asc kuber-table-sort-desc')

    if (indexTh == idx) {
        asc = false;
        indexTh = null;
        $(th).addClass('kuber-table-sort-desc');
    } else {
        indexTh = idx;
        $(th).addClass('kuber-table-sort-asc');
    }

    $(tbody.find('tr')).sort(function(a, b) {
        let tdA = $($(a).find('td')[idx]);
        let tdB = $($(b).find('td')[idx]);

        if (Number(tdA.text()) && Number(tdB.text())) {
            if (asc) {
                return Number(tdA.text()) < Number(tdB.text()) ? -1 : 0;
            } else {
                return Number(tdA.text()) < Number(tdB.text()) ? 0 : -1
            }
        } else {
            if (asc) {
                return tdA.text().localeCompare(tdB.text());
            } else {
                return tdB.text().localeCompare(tdA.text());
            }
        }
    }).each(function(idx, element) {
        if (idx < 10) {
            element.style.display = "";
        } else {
            element.style.display = "none";
        }
        tbody.append(element);
    });
}

$(table.find('.kuber-table-th')).each(function(idx, th) {
    $(th).on('click', () => {sortTable(idx, th)});
});

jQuery(() => {
    sortTable(0, $(table.find('.kuber-table-th')).first());
})

function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.querySelector('.buscaInput');
    filter = input.value.toUpperCase();
    table = document.querySelector('.kuber-table-datatables');
    tr = $(table).find("tr.kuber-table-tr");
    var trNone = [];
    
    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        let addTrNone = true;
        td = $(tr[i]).find("td.kuber-table-td");
        td.each((idx, element) => {
            let txtValue = element.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                addTrNone = false;
                return false;
            }
        })

        if (addTrNone) {
            trNone.push(tr[i]);
        }
    }

    trNone.forEach(element => {
        element.style.display = "none";
    });
}

$("#busca").on('keyup', myFunction);

$('#inputState').on('change', pagination);


function pagination() {
    let registrosPaginas = $('#inputState').val();
    let date = $('.kuber-table-datatables tbody tr');
    let numPaging = Math.ceil(date.length / Number(registrosPaginas));
    $('.nav-pagination ul.pagination').html('');
    
    date.each((idx, element) => idx >= registrosPaginas ? element.style.display = "none" : element.style.display = "");    
    
    $('.nav-pagination ul.pagination').append(`
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
        </li>
    `);

    for (let index = 1; index <= numPaging; index++) {
        let active = index == 1 ? 'active' : '';
        $('.nav-pagination ul.pagination').append(`
            <li class="page-item ${active}"><a class="page-link" href="#">${index}</a></li>
        `);       
    }

    $('.nav-pagination ul.pagination').append(`
        <li class="page-item">
            <a class="page-link" href="#">Próximo</a>
        </li>
    `);
}

pagination();