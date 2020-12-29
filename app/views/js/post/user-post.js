const person = $("#person").val();
const role = $("#role").val();
const userName = $("#userName").val();
const password = $("#password").val();
const confirmPassword = $("#confirmPassword").val();
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