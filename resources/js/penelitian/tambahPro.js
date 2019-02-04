//== Class Initialization
jQuery(document).ready(function() {
    Form.Init();
    // Control.Init();
});

var Control = {
    Init: function() {
        Control.SelectKategori();
        Control.SelectHewan();
    },
    SelectKategori: function() {
        $.ajax({
            url: "/api/user/list?roleID=4",
            type: "GET"
        })
            .done(function(data, textStatus, jqXHR) {
                $("#slsKategori").html("<option></option>");
                $.each(data, function(i, item) {
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
    Init: function() {
        $("#formTambahProsedur").validate({
            invalidHandler: function(e, r) {
                var i = $("#msgFail");
                i.removeClass("m--hide").show(), mApp.scrollTo(i, -200);
            },
            submitHandler: function(e) {
                Transaction();
            }
        });
    }
};

var Transaction = function() {
    var btn = $("#btnTambah");

    var params = {
        Kategori: $("#slsKategori").val(),
        JudulPen: $("#tbxJudul").val(),
        Hewan: $("#slsHewan").val(),
        Jumlah: $("#tbxJumlah").val(),
        Perlakuan: $("#tbxPerlakuan").val(),
        ParameterUji: $("#tbxParameter").val(),
        DesainPen: $("#tbxDesain").val()
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
