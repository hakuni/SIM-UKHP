//== Class Initialization
jQuery(document).ready(function () {
    Form.Init();
    Control.Init();
});

var Control = {
    Init: function () {
        Control.Ubah();
    },
    Select2: function (idKategori) {
        $.ajax({
                url: "/api/kategori",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsKategori").html("<option></option>");
                $.each(data, function (i, item) {
                    if (item.idKategori == idKategori) {
                        console.log(idKategori)
                        $("#slsKategori").append("<option value='" + item.idKategori + "' selected>" + item.namaKategori + "</option>");
                    } else {
                        $("#slsKategori").append("<option value='" + item.idKategori + "'>" + item.namaKategori + "</option>");
                    }
                });
                $("#slsKategori").select2({
                    placeholder: "Pilih Kategori"
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Ubah: function () {
        var id = $("#idUbahPenelitian").val();
        $.ajax({
                url: "/api/penelitian/" + id,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                Control.Select2(data.idKategori);
                $("#tbxNamaPeneliti").val(data.namaPeneliti);
                $("#tbxInstansi").val(data.instansiPeneliti);
                $("#tbxNoHP").val(data.telpPeneliti);
                $("#tbxEmail").val(data.emailPeneliti);
                $("#tbxAlamat").val(data.alamatPeneliti);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
};

var Form = {
    Init: function () {
        $("#formUbahPenelitian").validate({
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
    var btn = $("#btnUbah");

    var params = {
        idPenelitian: parseInt($("#idUbahPenelitian").val()),
        idKategori: parseInt($("#slsKategori").val()),
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
            type: "PUT",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(params),
            cache: false
        })
        .done(function (data, textStatus, jqXHR) {
            console.log(data);
            // if (Common.CheckError.Object(data) == true)
            Common.Alert.SuccessRoute("Berhasil mengubah", "/Penelitian");
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
