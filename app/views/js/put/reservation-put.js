$(document).ready(function () {
    let id = $("#id").val();
    let sh = $("#sh").val();
    let room = $("#room").val();
    let person = $("#person").val();
    let startDate = $("#startDate").val();
    let endDate = $("#endDate").val();
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
            endDate: endDate
        },
        success: function (response) {
            if (response.status === 402) {
                window.location.href = response.redirect;
            }
            $("head").append(response.alert);
        }
    });
});