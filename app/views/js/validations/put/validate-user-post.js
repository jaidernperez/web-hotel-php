$(function () {
    $("#form-create").validate({
        rules: {
            person: {
                required: true
            },
            role: {
                required: true
            },
            userName: {
                required: true,
                minlength: 4,
                maxlength: 20
            },
            password: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirmPassword: {
                equalTo : "#password"
            },
        },

        messages: {
            person: {
                required: "* Por favor seleccione la persona"
            },
            role: {
                required: "* Por favor seleccione el rol"
            },
            userName: {
                required: "* Por favor digita el usuario",
                minlength: "* Minimo 4 caracteres",
                maxlength: "* Demasiados caracteres"
            },
            password: {
                required: "* Por favor digite la contraseña",
                minlength: "* Minimo 6 caracteres",
                maxlength: "* Demasiados caracteres"
            },
            confirmPassword: {
                equalTo: "Las contraseñas no coinciden"
            }
        },
        errorClass: "text-danger",
        errorPlacement: function (error, element) {
            error.insertAfter(element.parent());
        },
        highlight: function (element) {
            $(element).addClass("alert-danger text-danger");
        },
        unhighlight: function (element) {
            $(element).removeClass("alert-danger text-danger");
        },

        submitHandler: function (form, e) {
            e.preventDefault();
            $.getScript('./js/post/user-post.js');
        }

    });
});


