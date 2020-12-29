$(function () {
    $("#form-create").validate({
        rules: {
            room: {
                required: true
            },
            person: {
                required: true
            },
            finalPrice: {
                number: true,
                min: 10000,
                max: 1000000
            },
            state: {
                required: true
            }
        },

        messages: {
            room: {
                required: "* Por favor seleccione una habitación"
            },
            person: {
                required: "* Por favor seleccione una persona"
            },
            finalPrice: {
                minlength: "Debe ser mayor a 10.000",
                maxlength: "Debe ser menor 10.000.000",
                number: "Debe ser un número"
            },
            state: {
                required: "* Por favor seleccione un estado"
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
            $.getScript('./js/post/reservation-post.js');
        }

    });
});


