// var id = $("#idPenelitian").val();
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
        Control.SelectHewan();
    },
    SelectHewan: function () {
        $.ajax({
                url: "/api/inventarisasi?tipe=1",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsHewan").html("<option></option>");
                $.each(data, function (i, item) {
                    $("#slsHewan").append(
                        "<option value='" +
                        item.idAlatBahan +
                        "'>" +
                        item.namaAlatBahan +
                        "</option>"
                    );
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
        $("#formTambahProsedur").validate({
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
                },                
                tbxDurasi4: {
                    required: true
                }
            },
            invalidHandler: function (e, r) {
                var i = $("#msgProsedur");
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
        idPenelitian: $("#idPenelitian").val(),
        idKategori: $("#idKategori").val(),
        judulPenelitian: $("#tbxJudul").val(),
        idAlatBahan: $("#slsHewan").val(),
        keteranganHewan: $("#tbxKeterangan").val(),
        perlakuan: $("#tbxPerlakuan").val(),
        parameterUji: $("#tbxParameter").val(),
        desainPenelitian: $("#tbxDesain").val(),
        etikHewan: $("input[name='etikHewan']:checked").val(),
        laporan: $("input[name='laporan']:checked").val(),
        tahap1: $("#tbxDurasi1").val(),
        tipe1: $("input[name='pemeliharaan']:checked").val(),
        tahap2: $("#tbxDurasi2").val(),
        tipe2: $("input[name='perlakuan']:checked").val(),
        tahap3: $("#tbxDurasi3").val(),
        tipe3: $("input[name='analisis']:checked").val(),
        tahap4: $("#tbxDurasi4").val(),
        tipe4: $("input[name='durasiLaporan']:checked").val(),
    };

    btn.addClass("m-loader m-loader--right m-loader--light").attr(
        "disabled",
        true
    );

    $.ajax({
            url: "/api/prosedur",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(params),
            cache: false
        })
        .done(function (data, textStatus, jqXHR) {
            console.log(data);
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
