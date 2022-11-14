let popoverAll = $('[data-toggle="popover"]');

$(function() {
    popoverAll.popover();
});

$(window).on('click', e => {
    let element = $(e.target);
    let popover = $(element.closest('[data-toggle="popover"]'));
    let divPopover = element.closest('.popover');

    if (popover.length == 0 && divPopover.length == 0) {
        popoverAll.popover('hide');
    }
});