$(document).ready(function () {
    let dni = $("#dni").val();
    let names = $("#names").val();
    let lastNames = $("#lastNames").val();
    let email = $("#email").val();
    let phone = $("#phone").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controllers/post/person-controller.php",
        data: {
            dni: dni,
            names: names,
            lastNames: lastNames,
            email: email,
            phone: phone
        },
        success: function (response) {
            if (response.status === 200) {
                $("#dni").val("");
                $("#names").val("");
                $("#lastNames").val("");
                $("#email").val("");
                $("#phone").val("");
            } else if (response.status === 402) {
                window.location.href = response.redirect;
            }
            $("head").append(response.alert);
        }
    });
});
