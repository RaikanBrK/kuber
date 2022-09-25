let fun = () => {
    initDatatables(() => {
        let width = $(window).width();
        let numbers_length = 7;

        json.pagingType = "simple_numbers"

        if (width <= 575.98) {
            json.pagingType = "numbers"
        } else if (width >= 992) {
            numbers_length = 8;
        }

        $.fn.DataTable.ext.pager.numbers_length = numbers_length;
    })
};

jQuery(fun);
$(window).on('resizeEnd', fun);