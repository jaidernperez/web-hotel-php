$(document).ready(function () {
    let id = $("#id").val();
    let dni = $("#dni").val();
    let names = $("#names").val();
    let lastNames = $("#lastNames").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    let sh = $("#sh").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controllers/put/person-controller.php",
        data: {
            id: id,
            sh: sh,
            dni: dni,
            names: names,
            lastNames: lastNames,
            email: email,
            phone: phone
        },
        success: function (response) {
            if (response.status === 402) {
                window.location.href = response.redirect;
            }
            $("head").append(response.alert);
        }
    });
});