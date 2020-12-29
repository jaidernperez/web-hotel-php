$(document).ready(function () {
    $(".btn-delete").on("click", function (e) {
        e.preventDefault();
        const id = $(this).attr('data-id');
        const hash = $(this).attr('data-sh');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../controllers/delete/user-controller.php",
            data: {
                id: id,
                hash: hash
            },
            success: function (response) {
                if (response.status === 200) {
                    $("#tr-" + hash + id).remove();
                } else if (response.status === 402) {
                    window.location.href = response.redirect;
                }
                $("head").append(response.alert);
            }
        });
    });
});