$("#checkBoxChangePassword").on("change",s=>{let a=$(s.target),e=$("#changePassword"),o=$("#password"),n=$("#password_confirmation");a.prop("checked")?(o.val(""),n.val(""),e.removeClass("d-none")):e.addClass("d-none")});