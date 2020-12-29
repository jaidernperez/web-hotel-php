$(document).ready(function () {
let person = $("#person").val();
let role = $("#role").val();
let userName = $("#userName").val();
let password = $("#password").val();
let confirmPassword = $("#confirmPassword").val();
$.ajax({
    type: "POST",
    dataType: "json",
    url: "../controllers/post/user-controller.php",
    data: {
        person: person,
        role: role,
        userName: userName,
        password: password,
        confirmPassword: confirmPassword
    },
    success: function (response) {
        if (response.status === 200) {
            $("#role").val("");
            $("#person").val("");
            $("#userName").val("");
            $("#password").val("");
            $("#confirmPassword").val("");
        } else if (response.status === 402) {
            window.location.href = response.redirect;
        }
        $("head").append(response.alert);
    }
});
});
