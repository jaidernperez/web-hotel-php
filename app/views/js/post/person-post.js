$(document).ready(function () {
    $("#btn-submit").on("click", function (e) {
        e.preventDefault();
        const dni = $("#dni").val();
        const names = $("#names").val();
        const lastNames = $("#lastNames").val();
        const email = $("#email").val();
        const phone = $("#phone").val();
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
                }else if(response.status === 402){
                    window.location.href = response.redirect;
                }
                $("head").append(response.alert);
            }
        });
    });
});