$(document).ready(function () {
    $(".finalize").on("click", function (e) {
        e.preventDefault();
        const id = $(this).attr('rs-id');
        const hash = $(this).attr('rs-sh');
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../controllers/put/finalize-controller.php",
            data: {
                id: id,
                hash: hash,
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