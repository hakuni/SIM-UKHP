//== Class Initialization
jQuery(document).ready(function () {
    Transaction.Init();
});

var Transaction = {
    Init: function () {
        $("#btnLogin").on("click", function () {
            var btn = $("#btnLogin")

            var params = {
                email: $("#tbxEmail").val(),
                password: $("#tbxPass").val(),
            };

            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );

            $.ajax({
                    url: "/api/login",
                    type: "POST",
                    dataType: "json",
                    contentType: "application/json",
                    data: JSON.stringify(params),
                    cache: false
                })
                .done(function (data, textStatus, jqXHR) {
                    console.log(data.token)
                    localStorage.setItem("token", data.token);
                    localStorage.setItem("idUser", data.idUser);
                    location.href = "/Dashboard";
                    // localStorage.setItem("role") = data.role;
                    // Common.Alert.SuccessRoute("Berhasil masuk", "/Dashboard");
                    btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                        "disabled",
                        false
                    );
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    // Common.Alert.Error(errorThrown);
                    btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                        "disabled",
                        false
                    );
                });
        })
    }
}
