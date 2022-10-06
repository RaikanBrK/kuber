const table = $('table');
var indexTh = null;

function sortTable(idx, th) {
    let tbody = $(table.find('tbody'));
    let asc = true;

    $(table.find('thead th')).removeClass('kuber-table-sort-asc kuber-table-sort-desc')

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

        if (asc) {
            return tdA.text().localeCompare(tdB.text());
        } else {
            return tdB.text().localeCompare(tdA.text());
        }
    }).each(function(idx, element) {
        tbody.append(element);
    });
}

$(table.find('th')).each(function(idx, th) {
    $(th).on('click', () => {sortTable(idx, th)});
});

jQuery(() => {
    sortTable(0, $(table.find('th')).first());
})