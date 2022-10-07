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