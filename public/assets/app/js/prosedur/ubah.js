var id = $("#idPenelitian").val();
var idPro = $("#idProsedur").val();
//== Class Initialization
jQuery(document).ready(function () {
    Form.Init();
    Control.Init();
});

var Control = {
    Init: function () {
        Control.Ubah();
    },
    Ubah: function () {
        $.ajax({
                url: "/api/prosedur/" + idPro,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                Control.SelectKategori(data.data.idKategori);
                Control.SelectHewan(data.data.idAlatBahan);
                $("#tbxJudul").val(data.data.judulPenelitian);
                $("#tbxJumlah").val(data.data.jumlahHewan);
                $("#tbxPerlakuan").val(data.data.perlakuan);
                $("#tbxParameter").val(data.data.parameterUji);
                $("#tbxDesain").val(data.data.desainPenelitian);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    SelectKategori: function (idKategori) {
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
    SelectHewan: function (idAlatBahan) {
        $.ajax({
                url: "/api/inventarisasi/1",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsHewan").html("<option></option>");
                $.each(data, function (i, item) {
                    if (item.idAlatBahan == idAlatBahan) {
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
        idKategori: $("#slsKategori").val(),
        judulPenelitian: $("#tbxJudul").val(),
        idAlatBahan: $("#slsHewan").val(),
        jumlahHewan: $("#tbxJumlah").val(),
        perlakuan: $("#tbxPerlakuan").val(),
        parameterUji: $("#tbxParameter").val(),
        desainPenelitian: $("#tbxDesain").val()
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
            Common.Alert.SuccessRoute("Berhasil menambahkan", "/Prosedur/" + id);
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
