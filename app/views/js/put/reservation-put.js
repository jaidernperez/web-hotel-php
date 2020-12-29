const id = $("#id").val();
const sh = $("#sh").val();
const room = $("#room").val();
const person = $("#person").val();
const startDate = $("#startDate").val();
const endDate = $("#endDate").val();
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
