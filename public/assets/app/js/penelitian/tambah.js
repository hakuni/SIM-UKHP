//== Class Initialization
jQuery(document).ready(function () {
    Form.Init();
    Control.Init();
});

var Control = {
    Init: function () {
        Control.Select2();
    },
    Select2: function () {
        $.ajax({
                url: "/api/kategori",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsKategori").html("<option></option>");
                $.each(data, function (i, item) {
                    $("#slsKategori").append(
                        "<option value='" +
                        item.idKategori +
                        "'>" +
                        item.namaKategori +
                        "</option>"
                    );
                });
                $("#slsKategori").select2({
                    placeholder: "Kategori"
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
};

var Form = {
    Init: function () {
        $("#formTambahPenelitian").validate({
            rules: {
                slsKategori: {
                    required: true
                },
                tbxNamaPeneliti: {
                    required: true
                },
                tbxInstansi: {
                    required: true
                },
                tbxNoHP: {
                    required: true,
                    maxlength: 14
                },
                tbxEmail: {
                    required: true,
                    email: true
                },
                tbxAlamat: {
                    required: true
                }
            },
            invalidHandler: function (e, r) {
                var i = $("#msgFail");
                i.removeClass("m--hide").show(), mApp.scrollTo(i, -200);
            },
            submitHandler: function (e) {
                Transaction();
            }
        });
    }
};

var Transaction = function () {
    var btn = $("#btnTambah");

    var params = {
        idKategori: $("#slsKategori").val(),
        namaPeneliti: $("#tbxNamaPeneliti").val(),
        instansiPeneliti: $("#tbxInstansi").val(),
        telpPeneliti: $("#tbxNoHP").val(),
        emailPeneliti: $("#tbxEmail").val(),
        alamatPeneliti: $("#tbxAlamat").val(),
        statusPenelitian: 1
    };

    btn.addClass("m-loader m-loader--right m-loader--light").attr(
        "disabled",
        true
    );

    $.ajax({
            url: "/api/penelitian",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(params),
            cache: false
        })
        .done(function (data, textStatus, jqXHR) {
            // if (Common.CheckError.Object(data) == true)
            Common.Alert.SuccessRoute("Berhasil menambahkan", "/Penelitian");
            btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                false
            );
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            Common.Alert.Error(errorThrown);
            btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                false
            );
        });
};
