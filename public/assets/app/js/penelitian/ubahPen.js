//== Class Initialization
jQuery(document).ready(function () {
    Form.Init();
    Control.Init();
});

var Control = {
    Init: function () {
        // Control.BootstrapDatepicker();
        Control.Select2();
        Control.Ubah();
    },
    BootstrapDatepicker: function () {
        $(".datepicker").datepicker({
            format: "dd-M-yyyy",
            todayBtn: "linked",
            clearBtn: !0,
            todayHighlight: !0,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
    },
    Select2: function () {
        $.ajax({
                url: "/api/kategori",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsKategori").html("<option></option>");
                $.each(data.data, function (i, item) {
                    $("#slsKategori").append(
                        "<option value='" +
                        item.idKategori +
                        "'>" +
                        item.namaKategori +
                        "</option>"
                    );
                });
                $("#slsKategori").select2({
                    placeholder: "Pilih Kategori"
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Ubah: function(){
        var id = $("#idUbahPenelitian").val();
        $.ajax({
            url: "/api/penelitian/"+id,
            type: "GET",
            dataType: "json",
        })
            .done(function(data, textStatus, jqXHR) {
                $("#slsKategori").val(data.data.idKategori);
                $("#tbxNamaPeneliti").val(data.data.namaPeneliti);
                $("#tbxInstansi").val(data.data.instansiPeneliti);
                $("#tbxNoHP").val(data.data.telpPeneliti);
                $("#tbxEmail").val(data.data.emailPeneliti);
                $("#tbxAlamat").val(data.data.alamatPeneliti);
                Transaction.Ubah();
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
};

// var format = new Vue({
//     el: "#formTambahPenelitian",
//     data: {
//         nama: ""
//     },
//     watch: {
//         nama: function(val) {
//             this.nama = val;
//             return val;
//         }
//     }
// });

var Form = {
    Init: function () {
        $("#formUbahPenelitian").validate({
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
        idKategori: $("#slsKategori").val(),
        namaPeneliti: $("#tbxNamaPeneliti").val(),
        instansi: $("#tbxInstansi").val(),
        telpPeneliti: $("#tbxNoHP").val(),
        emailPeneliti: $("#tbxEmail").val(),
        alamatPeneliti: $("#tbxAlamat").val(),
        statusPeneliti: 1
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
        .done(function(data, textStatus, jqXHR) {
            console.log(data);
            // if (Common.CheckError.Object(data) == true)
                Common.Alert.SuccessRoute("Berhasil mengubah", "/Penelitian");
            btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                false
            );
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            Common.Alert.Error(errorThrown);
            btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                false
            );
        });
};
