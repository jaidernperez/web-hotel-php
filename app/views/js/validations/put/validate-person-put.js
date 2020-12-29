$(function () {
    $("#form-update").validate({
        rules: {
            dni: {
                required: true,
                minlength: 7,
                maxlength: 20
            },
            names: {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            lastNames: {
                required: true,
                minlength: 3,
                maxlength: 30
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                minlength: 7,
                maxlength: 20
            },
        },

        messages: {
            dni: {
                required: "* Por favor digita el documento",
                minlength: "* Minimo 7 caracteres",
                maxlength: "* Demasiados caracteres"
            },
            names: {
                required: "* Por favor digita el nombre",
                minlength: "* Minimo 3 caracteres",
                maxlength: "* Demasiados caracteres"
            },
            lastNames: {
                required: "* Por favor digita los apellidos",
                minlength: "* Minimo 3 caracteres",
                maxlength: "* Demasiados caracteres"
            },
            email: {
                required: "* Por favor digite el correo",
                email: "Debe ser un correo válido"
            },
            phone: {
                required: "* Por favor digita el telefono",
                minlength: "* Minimo 7 caracteres",
                maxlength: "* Demasiados caracteres"
            },
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
            $.getScript('./js/put/person-put.js');
        }

    });
});


