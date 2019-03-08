var id = 0;
//== Class Initialization
jQuery(document).ready(function() {
    $("#sidebarHide").hide();
    Page.Init();
});

var Page = {
    Init: function() {
        Get.Filter(1);
        //filter
        $(".TaskOrderBy").on("click", function() {
            var order = this.id;
            if (order == 1) {
                $("#order").html("Terbaru");
            } else {
                $("#order").html("Saya");
            }
            Get.Filter(order);
        });

        $("#listPenelitian").on("click", "div.divShowDetail", function(e) {
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
    DetailPenelitian: function(id) {
        var link = "/Tracking/Detail/" + id;
        console.log(link);
        $.ajax({
            url: link,
            type: "GET",
            success: function(data) {
                $("#detailPenelitian").html(data);
                if ($("#inptMilestoneID").val() == 5) {
                    $("#btnTrx").hide();
                }
                Transaction.Init(id);
                Control.DatePicker();
                // Table.History(id);
                $("#btnMaximize").on("click", function() {
                    $("#sidebarShow").show();
                    $("#detailPenelitian").removeClass("col-lg-11");
                    $("#hideList").addClass("col-lg-4");
                    $("#sidebarHide").removeClass("col-lg-1");
                    $("#sidebarHide").hide();
                });
                $("#btnMinimize").on("click", function() {
                    $("#sidebarShow").hide();
                    $("#detailPenelitian").addClass("col-lg-11");
                    $("#hideList").removeClass("col-lg-4");
                    $("#sidebarHide").addClass("col-lg-1");
                    $("#sidebarHide").show();
                });
            },
            error: function() {
                alert("error");
            }
        });
    },
    Filter: function(order) {
        var link = "/Tracking/List?orderBy=" + order;
        console.log(link);
        $.ajax({
            url: link,
            type: "GET",
            success: function(data) {
                $("#listPenelitian").html(data);
                id = $("#idPenelitian").val();
                Get.DetailPenelitian(id);
                $("#jumlahPenelitian").html($("#inptJmlhPenelitian").val());
            },
            error: function() {
                alert("error");
            }
        });
    }
};

var Transaction = {
    Init: function(id) {
        Transaction.Batal(id);
        Transaction.Alur(id);
        Transaction.Pembayaran(id);
    },
    Batal: function(id) {
        $("#btnHapus").on("click", function() {
            var btn = $("#btnHapus");
            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );
            $.ajax({
                url: "/api/penelitian/activity",
                type: "PUT",
                data: {
                    idPenelitian: id
                },
                dataType: "json",
                cache: false
            })
                .done(function(data, textStatus, jqXHR) {
                    Common.Alert.SuccessRoute(
                        "Berhasil membatalkan penelitian",
                        "/Tracking"
                    );
                    btn.removeClass(
                        "m-loader m-loader--right m-loader--light"
                    ).attr("disabled", false);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    Common.Alert.Error(errorThrown);
                    btn.removeClass(
                        "m-loader m-loader--right m-loader--light"
                    ).attr("disabled", false);
                });
        });
    },
    Alur: function(id) {
        $("#btnTambah").on("click", function() {
            var btn = $("#btnTambah");

            var model = new FormData();
            model.append("idPenelitian", id);
            model.append("idMilestone", $.trim($("#inptMilestoneID").val()));
            model.append("catatan", $.trim($("#tbxCatatan").val()));
            if ($("#inptMilestoneID").val() == 4) {
                var fileInput = document.getElementById("inptFile");
                var uploadedFile = fileInput.files[0];
                model.append("doc", uploadedFile);
            }

            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );

            $.ajax({
                url: "/api/penelitian/activity",
                type: "POST",
                dataType: "json",
                contentType: false,
                data: model,
                processData: false
            })
                .done(function(data, textStatus, jqXHR) {
                    // if (Common.CheckError.Object(data) == true)
                    Common.Alert.SuccessRoute(
                        "Berhasil menambahkan",
                        "/Tracking"
                    );
                    btn.removeClass(
                        "m-loader m-loader--right m-loader--light"
                    ).attr("disabled", false);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    Common.Alert.Error(errorThrown);
                    btn.removeClass(
                        "m-loader m-loader--right m-loader--light"
                    ).attr("disabled", false);
                });
        });
    },
    Pembayaran: function(id) {
        $("#btnTambahBayar").on("click", function() {
            var btn = $("#btnTambahBayar");
            var params = {
                idPenelitian: id,
                tglPembayaran: $("#tbxTglPembayaran").val(),
                totalPembayaran: $("#tbxNominal").val()
            };

            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );

            $.ajax({
                url: "/api/keuangan/log",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
                .done(function(data, textStatus, jqXHR) {
                    // if (Common.CheckError.Object(data) == true)
                    Common.Alert.SuccessRoute(
                        "Berhasil menambahkan",
                        "/Tracking"
                    );
                    btn.removeClass(
                        "m-loader m-loader--right m-loader--light"
                    ).attr("disabled", false);
                })
                .fail(function(jqXHR, textStatus, errorThrown) {
                    Common.Alert.Error(errorThrown);
                    btn.removeClass(
                        "m-loader m-loader--right m-loader--light"
                    ).attr("disabled", false);
                });
        });
    }
};

var Table = {
    History: function(id) {
        t = $("#divHistory").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/task/ListTransactionTask/" + id,
                        method: "GET",
                        map: function(r) {
                            var e = r;
                            return void 0 !== r.data && (e = r.data), e;
                        }
                    }
                },
                pageSize: 10,
                saveState: {
                    cookie: true,
                    webstorage: true
                },
                serverPaging: false,
                serverFiltering: false,
                serverSorting: false
            },
            layout: {
                scroll: false,
                footer: false
            },
            sortable: true,
            pagination: true,
            toolbar: {
                items: {
                    pagination: {
                        pageSizeSelect: [10, 20, 30, 50, 100]
                    }
                }
            },
            columns: [
                {
                    field: "idPenelitian",
                    title: "Actions",
                    sortable: false,
                    textAlign: "center",
                    width: 100,
                    template: function(t) {
                        if (t.Attachment != null)
                            var strBuilder =
                                '<a href="/PinnedProject/Download/ ' +
                                t.trxTaskID +
                                '" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Download Data Penelitian"><i class="la la-download"></i></a>\t\t\t\t\t\t';
                        strBuilder +=
                            '<a href="/PinnedProject/Download/ ' +
                            t.trxTaskID +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" title="Download Hasil Penelitian"><i class="la la-download"></i></a>';
                        return strBuilder;
                    }
                },
                {
                    field: "namaMilestone",
                    title: "Tahapan",
                    textAlign: "center"
                },
                {
                    field: "PIC",
                    title: "Penanggung Jawab",
                    textAlign: "center"
                },
                {
                    field: "durasi",
                    title: "Durasi",
                    textAlign: "center"
                },
                {
                    field: "catatan",
                    className: "dt-head-center",
                    title: "Catatan",
                    textAlign: "center",
                    width: 500
                }
            ]
        });
    }
};

var Control = {
    DatePicker: function() {
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
    }
};
