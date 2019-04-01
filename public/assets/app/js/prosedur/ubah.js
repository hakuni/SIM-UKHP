var id = $("#idPenelitian").val();
var idPro = $("#idProsedur").val();
//== Class Initialization
jQuery(document).ready(function () {
    $.ajax({
        url: '/api/cekToken',
        type: 'GET',
        success: function () {
            Control.Init();
            Form.Init();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 401) {
                location.href = "/Logout"
                localStorage.removeItem("token")
                localStorage.removeItem("idUser")
                localStorage.removeItem("namaUser")
                localStorage.removeItem("role")
                localStorage.removeItem("namaRole")
            }
        }
    })
});

var Control = {
    Init: function () {
        Control.SelectKategori();
        Control.SelectHewan();
    },
    SelectKategori: function () {
        $.ajax({
                url: "/api/kategori/" + $("#idKategori").val(),
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#tbxKategori").val(data.namaKategori)
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    SelectHewan: function () {
        $.ajax({
                url: "/api/inventarisasi?tipe=1",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsHewan").html("<option></option>");
                $.each(data, function (i, item) {
                    if (item.idAlatBahan == $("#idAlatBahan").val()) {
                        $("#slsHewan").append("<option value='" + item.idAlatBahan + "' selected>" + item.namaAlatBahan + "</option>");
                    } else {
                        $("#slsHewan").append("<option value='" + item.idAlatBahan + "'>" + item.namaAlatBahan + "</option>");
                    }
                });
                $("#slsHewan").select2({
                    placeholder: "Pilih Hewan"
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
};

var Form = {
    Init: function () {
        $("#formUbahProsedur").validate({
            rules: {
                slsHewan: {
                    required: true
                },
                tbxKeterangan: {
                    required: true
                },
                tbxPerlakuan: {
                    required: true
                },
                tbxParameter: {
                    required: true
                },
                tbxDesain: {
                    required: true
                },
                tbxDurasi1: {
                    required: true
                },
                tbxDurasi2: {
                    required: true
                },
                tbxDurasi3: {
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
        idPenelitian: id,
        idProsedur: idPro,
        idKategori: $("#idKategori").val(),
        judulPenelitian: $("#tbxJudul").val(),
        idAlatBahan: $("#slsHewan").val(),
        keteranganHewan: $("#tbxKeterangan").val(),
        perlakuan: $("#tbxPerlakuan").val(),
        parameterUji: $("#tbxParameter").val(),
        desainPenelitian: $("#tbxDesain").val(),
        tahap1: $("#tbxDurasi1").val(),
        tahap2: $("#tbxDurasi2").val(),
        tahap3: $("#tbxDurasi3").val()
    };

    btn.addClass("m-loader m-loader--right m-loader--light").attr(
        "disabled",
        true
    );

    $.ajax({
            url: "/api/prosedur",
            type: "PUT",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(params),
            cache: false
        })
        .done(function (data, textStatus, jqXHR) {
            console.log(data);
            // if (Common.CheckError.Object(data) == true)
            Common.Alert.SuccessRoute("Berhasil mengubah", "/Penelitian/Prosedur/" + id + '/' + idPro);
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
