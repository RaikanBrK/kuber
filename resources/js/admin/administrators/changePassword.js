$('#checkBoxChangePassword').on('change', e => {
    let checkbox = $(e.target)
    let changePassword = $('#changePassword');
    let passwordInput = $('#password');
    let passwordConfirmInput = $('#password_confirmation');

    if (checkbox.prop("checked")) {
        passwordInput.val('');
        passwordConfirmInput.val('');
        changePassword.removeClass('d-none');
    } else {
        changePassword.addClass('d-none');
    }
});