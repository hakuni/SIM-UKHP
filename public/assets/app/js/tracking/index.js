var id = 0;
//== Class Initialization
jQuery(document).ready(function () {
    $("#sidebarHide").hide();
    Page.Init();
});

var Page = {
    Init: function () {
        Get.ListPenelitian();
        $("#listPenelitian").on("click", "div.divShowDetail", function (e) {
            var idPen = this.id;
            console.log(idPen);
            $(this)
                .css({
                    background: "whitesmoke"
                })
                .siblings()
                .css({
                    background: "transparent"
                });
            $(this)
                .addClass("selected")
                .siblings()
                .removeClass("selected");
            Get.DetailPenelitian(idPen);
        });
    }
};

var Get = {
    ListPenelitian: function () {
        var link = "/Tracking/List";
        console.log(link);
        $.ajax({
            url: link,
            type: "GET",
            success: function (data) {
                $("#listPenelitian").html(data);
                id = $("#idPenelitian").val();
                document.getElementById('jumlahPenelitian').innerHTML = $('#inptJmlhPenelitian').val();
                $(this)
                    .css({
                        background: "whitesmoke"
                    })
                    .siblings()
                    .css({
                        background: "transparent"
                    });
                $(this)
                    .addClass("selected")
                    .siblings()
                    .removeClass("selected");
                Get.DetailPenelitian(id);
            },
            error: function () {
                alert("error");
            }
        });
    },
    DetailPenelitian: function (id) {
        var link = "/Tracking/Detail/" + id;
        console.log(link);
        $.ajax({
            url: link,
            type: "GET",
            success: function (data) {
                $("#detailPenelitian").html(data);
                Transaction.Init();
                Control.DatePicker();
                $("#btnMaximize").on("click", function () {
                    $("#sidebarShow").show();
                    $("#detailPenelitian").removeClass("col-lg-11");
                    $("#hideList").addClass("col-lg-4");
                    $("#sidebarHide").removeClass("col-lg-1");
                    $("#sidebarHide").hide();
                });
                $("#btnMinimize").on("click", function () {
                    $("#sidebarShow").hide();
                    $("#detailPenelitian").addClass("col-lg-11");
                    $("#hideList").removeClass("col-lg-4");
                    $("#sidebarHide").addClass("col-lg-1");
                    $("#sidebarHide").show();
                });
            },
            error: function () {
                alert("error");
            }
        });
    }
};

var Transaction = {
    Init: function () {
        Transaction.Hapus();
        Transaction.Alur();
        Transaction.Pembayaran();
    },
    Hapus: function () {
        $("#btnHapus").on("click", function () {
            var btn = $("#btnHapus");
            btn.addClass("m-loader m-loader--right m-loader--light").attr("disabled", true);
            $.ajax({
                    url: "/api/penelitian/" + id,
                    type: "DELETE",
                    cache: false
                })
                .done(function (data, textStatus, jqXHR) {
                    Common.Alert.SuccessRoute("Berhasil menghapus penelitian", "/Penelitian");
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
        })
    },
    Alur: function () {
        $("#btnTambah").on("click", function () {
            var btn = $("#btnTambah");
            var params = {
                idPenelitian: id,
                idMilestone: $("#inptMilestoneID").val(),
                PIC: $("#tbxPJ").val(),
                durasi: $("#tbxDurasi").val(),
                catatan: $("#tbxCatatan").val(),
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            $.ajax({
                    url: "/api/penelitian/activity",
                    type: "POST",
                    dataType: "json",
                    contentType: "application/json",
                    data: JSON.stringify(params),
                    cache: false
                })
                .done(function (data, textStatus, jqXHR) {
                    // if (Common.CheckError.Object(data) == true)
                    Common.Alert.SuccessRoute("Berhasil menambahkan", "/Tracking");
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
        })
    },
    Pembayaran: function () {
        $("#btnTambahBayar").on("click", function () {
            var btn = $("#btnTambahBayar");
            var params = {
                idPenelitian: id,
                tglPembayran: $("#tbxTglPembayaran").val(),
                totalPembayaran: $("#tbxNominal").val(),
            }

            btn.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);

            $.ajax({
                    url: "/api/keuangan/log",
                    type: "POST",
                    dataType: "json",
                    contentType: "application/json",
                    data: JSON.stringify(params),
                    cache: false
                })
                .done(function (data, textStatus, jqXHR) {
                    // if (Common.CheckError.Object(data) == true)
                    Common.Alert.SuccessRoute("Berhasil menambahkan", "/Tracking");
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
        })
    }
};

var Control = {
    DatePicker: function () {
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
};
