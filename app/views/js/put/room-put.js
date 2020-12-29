const id = $("#id").val();
const sh = $("#sh").val();
const roomType = $("#roomType").val();
const name = $("#name").val();
const price = $("#price").val();
const availability = $("#availability").val();
$.ajax({
    type: "POST",
    dataType: "json",
    url: "../controllers/put/room-controller.php",
    data: {
        id: id,
        sh: sh,
        roomType: roomType,
        name: name,
        price: price,
        availability: availability
    },
    success: function (response) {
        if (response.status === 402) {
            window.location.href = response.redirect;
        }
        $("head").append(response.alert);
    }
});
