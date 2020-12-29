$(document).ready(function () {
    let roomType = $("#roomType").val();
    let name = $("#name").val();
    let price = $("#price").val();
    let availability = $("#availability").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "../controllers/post/room-controller.php",
        data: {
            roomType: roomType,
            name: name,
            price: price,
            availability: availability
        },
        success: function (response) {
            if (response.status === 200) {
                $("#roomType").val("");
                $("#name").val("");
                $("#price").val("");
                $("#availability").val("");
            } else if (response.status === 402) {
                window.location.href = response.redirect;
            }
            $("head").append(response.alert);
        }
    });
});