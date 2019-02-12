//== Class Initialization
jQuery(document).ready(function () {
    Form.Init();
    Control.Init();
});

var Control = {
    Init: function () {
        Control.BootstrapDatepicker();
        // Control.Select2();
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
                url: "/api/user/list?roleID=4",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsKategori").html("<option></option>");
                $.each(data, function (i, item) {
                    $("#slsKategori").append(
                        "<option value='" +
                        item.UserID +
                        "'>" +
                        item.FullName +
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
        $("#formTambahPembayaran").validate({
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
        Kategori: $("#slsKategori").val(),
        TanggalPembayaran: $("#tbxTanggalPembayaran").val(),
        Bayar: $("#tbxBayar").val(),
        Sisa: $("#tbxSisa").val()
    };

    btn.addClass("m-loader m-loader--right m-loader--light").attr(
        "disabled",
        true
    );

    // $.ajax({
    //     url: "/api/project/create",
    //     type: "POST",
    //     dataType: "json",
    //     contentType: "application/json",
    //     data: JSON.stringify(params),
    //     cache: false
    // })
    //     .done(function(data, textStatus, jqXHR) {
    //         console.log(data);
    //         if (Common.CheckError.Object(data) == true)
    //             Common.Alert.SuccessRoute("Berhasil menambahkan", "/Project");
    //         btn.removeClass("m-loader m-loader--right m-loader--light").attr(
    //             "disabled",
    //             false
    //         );
    //     })
    //     .fail(function(jqXHR, textStatus, errorThrown) {
    //         Common.Alert.Error(errorThrown);
    //         btn.removeClass("m-loader m-loader--right m-loader--light").attr(
    //             "disabled",
    //             false
    //         );
    //     });
};
