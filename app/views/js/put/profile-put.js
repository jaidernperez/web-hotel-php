$(document).ready(function () {
    $("#btn-submit-profile").on("click", function (e) {
        e.preventDefault();
        const id = $("#id-person").val();
        const sh = $("#sh-person").val();
        const dni = $("#dni").val();
        const names = $("#names").val();
        const lastNames = $("#lastNames").val();
        const email = $("#email").val();
        const phone = $("#phone").val();
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
                if(response.status === 402){
                    window.location.href = response.redirect;
                }
                $("head").append(response.alert);
            }
        });
    });
});