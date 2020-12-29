$(function () {
    $("#form-create").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 50
            },
            price: {
                required: true,
                number: true,
                minlength: 5,
                maxlength: 7,
            },
            availability: {
                required: true
            },
            roomType: {
                required: true
            }
        },

        messages: {
            name: {
                required: "* Por favor digita el nombre de la habitación",
                minlength: "* Minimo 3 caracteres",
                maxlength: "* Demasiados caracteres"
            },
            price: {
                required: "* Por favor digite el precio",
                minlength: "Debe ser mayor a 10.000",
                maxlength: "Debe ser menor 10.000.000",
                number: "Debe ser un número"
            },
            availability: {
                required: "* Por favor seleccione la disponibilidad"
            },
            roomType: {
                required: "* Por favor seleccione el tipo de habitación"
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
            $.getScript('./js/post/room-post.js');
        }

    });
});


