var id = localStorage.getItem("idUser");
$.ajax({
        url: "/api/user/" + id,
        type: "GET",
        cache: false
    })
    .done(function (data, textStatus, jqXHR) {
        $("#nama").html(data.namaUser);
        // localStorage.setItem("role") = data.role;
        // Common.Alert.SuccessRoute("Berhasil masuk", "/Dashboard");
    })
    .fail(function (jqXHR, textStatus, errorThrown) {
        // Common.Alert.Error(errorThrown);
        btn.removeClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            false
        );
    });
