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
                    document.cookie = "token=" + data.token + "; path=/;"
                    localStorage.setItem("namaUser", data.namaUser)
                    location.href = "/Dashboard";
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
