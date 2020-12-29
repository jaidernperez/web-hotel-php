$(document).ready(function () {
    $("#btn-submit").on("click", function (e) {
        e.preventDefault();
        const id = $("#id").val();
        const sh = $("#sh").val();
        const room = $("#room").val();
        const person = $("#person").val();
        const startDate = $("#startDate").val();
        const endDate = $("#endDate").val();
        const finalPrice = $("#finalPrice").val();
        const state = $("#state").val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../controllers/put/reservation-controller.php",
            data: {
                id: id,
                sh: sh,
                room: room,
                person: person,
                startDate: startDate,
                endDate: endDate,
                finalPrice: finalPrice,
                state: state
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