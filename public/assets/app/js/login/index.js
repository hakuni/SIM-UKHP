//== Class Initialization
jQuery(document).ready(function () {
    Transaction.Init();
});

var Transaction = {
    Init: function () {
        $("#btnLogin").on("click", function () {
            if(
                $.trim($("#tbxEmail").val()) == "" ||
                $.trim($("#tbxPass").val()) == ""
            ){
                swal({
                    title: "Warning!",
                    text: "Periksa kembali masukan anda",
                    type: "warning",
                })
                return false;
            }
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
                    // document.cookie = "token=" + data.token + "; path=/;"
                    localStorage.setItem("token", data.token)
                    localStorage.setItem("idUser", data.idUser)
                    localStorage.setItem("namaUser", data.namaUser)
                    localStorage.setItem("role", data.role)
                    localStorage.setItem("namaRole", data.namaRole)
                    location.href = "/Dashboard";
                    btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                        "disabled",
                        false
                    );
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    swal({
                        title: "Perhatian!",
                        text: jqXHR.responseJSON.message,
                        type: "warning",
                    })
                    btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                        "disabled",
                        false
                    );
                });
        })
    }
}
