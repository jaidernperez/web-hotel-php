$(document).ready(function () {
    $("#btn-submit-account").on("click", function (e) {
        e.preventDefault();
        const id = $("#id-user").val();
        const sh = $("#sh-user").val();
        const user = $("#user").val();
        const currentPassword = $("#currentPassword").val();
        const newPassword = $("#newPassword").val();
        const confirmPassword = $("#confirmPassword").val();
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "../controllers/put/user-controller.php",
            data: {
                id: id,
                sh: sh,
                user: user,
                currentPassword: currentPassword,
                newPassword: newPassword,
                confirmPassword: confirmPassword
            },
            success: function (response) {
                if (response.status === 200) {
                    $("#currentPassword").val("");
                    $("#newPassword").val("");
                    $("#confirmPassword").val("");
                }else if(response.status === 402){
                    window.location.href = response.redirect;
                }
                $("head").append(response.alert);
            }
        });
    });
});