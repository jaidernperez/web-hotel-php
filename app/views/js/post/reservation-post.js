const room = $("#room").val();
const person = $("#person").val();
const startDate = $("#startDate").val();
const endDate = $("#endDate").val();
const finalPrice = $("#finalPrice").val();
const state = $("#state").val();
$.ajax({
    type: "POST",
    dataType: "json",
    url: "../controllers/post/reservation-controller.php",
    data: {
        room: room,
        person: person,
        startDate: startDate,
        endDate: endDate,
        finalPrice: finalPrice,
        state: state
    },
    success: function (response) {
        if (response.status === 200) {
            $("#room").val("");
            $("#person").val("");
            $("#startDate").val("");
            $("#endDate").val("");
            $("#finalPrice").val("");
            $("#state").val("");
        } else if (response.status === 402) {
            window.location.href = response.redirect;
        }
        $("head").append(response.alert);
    }
});
