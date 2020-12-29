$(document).ready(function () {
    let id = $("#id").val();
    let sh = $("#sh").val();
    let roomType = $("#roomType").val();
    let name = $("#name").val();
    let price = $("#price").val();
    let availability = $("#availability").val();
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
});
