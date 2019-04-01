var id = 0;
//== Class Initialization
jQuery(document).ready(function () {
    $.ajax({
        url: '/api/cekToken',
        type: 'GET',
        success: function () {
            $("#sidebarHide").hide();
            Page.Init();
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

var Page = {
    Init: function () {
        Get.Minimize();
        Get.List(2);
        //filter
        $(".TaskOrderBy").on("click", function () {
            var order = this.id;
            if (order == 1) {
                $("#order").html("Terbaru");
            } else {
                $("#order").html("Saya");
            }
            Get.List(order);
        });

        $("#listPenelitian").on("click", "div.divShowDetail", function (e) {
            var idPen = this.id;
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
    DetailPenelitian: function (id) {
        $("#detailPenelitian").addClass("m-loader m-loader--lg m-loader--primary").attr(
            "disabled",
            true
        );
        var link = "/Tracking/Detail/" + id;
        $.ajax({
            url: link,
            type: "GET",
            success: function (data) {
                $("#detailPenelitian").removeClass("m-loader m-loader--lg m-loader--primary").attr(
                    "disabled",
                    false
                );
                $("#detailPenelitian").html(data);
                if ($("#inptMilestoneID").val() == 5) {
                    $("#btnTrx").hide();
                }
                Transaction.Init(id);
                Control.Init();
                Table.History(id);
            },
            error: function () {
                alert("error");
            }
        });
    },
    List: function (order) {
        $(".m-scrollable").addClass("m-loader m-loader--lg m-loader--primary").attr(
            "disabled",
            true
        );
        var link = "/Tracking/List?orderBy=" + order;
        $.ajax({
            url: link,
            type: "GET",
            success: function (data) {
                $(".m-scrollable").removeClass("m-loader m-loader--lg m-loader--primary").attr(
                    "disabled",
                    false
                );
                $("#listPenelitian").html(data);
                var test = document.getElementsByClassName("divShowDetail")[0];
                if (test) {
                    test.style.backgroundColor = "whitesmoke";
                    id = $("#idPenelitian").val();
                    Get.DetailPenelitian(id);
                    $("#jumlahPenelitian").html($("#inptJmlhPenelitian").val());
                }
            },
            error: function () {
                alert("error");
            }
        });
    },
    Minimize: function () {
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
    }
};

var Transaction = {
    Init: function (id) {
        $("#btnHapus").on("click", function () {
            Transaction.Konfirmasi(id)
        })
        $("#btnTambah").on("click", function () {
            if ($("#slsPIC").val() == 0) {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Transaction.Alur(id);
        })
        $("#btnTambahBayar").on("click", function () {
            if ($.trim($("#tbxTglPembayaran").val()) == "" || $.trim($("#tbxNominal").val()) == "") {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Transaction.Pembayaran(id);
        })
    },
    Konfirmasi: function (id) {
        swal({
            title: "Anda yakin?",
            text: "Membatalkan penelitian ini",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "Yakin, batalkan!",
        }).then(function (e) {
            if (e.value) {
                Button.Hapus(id);
            }
        })
    },
    Batal: function (id) {
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
            .done(function (data, textStatus, jqXHR) {
                Common.Alert.SuccessRoute(
                    "Berhasil membatalkan penelitian",
                    "/Tracking"
                );
                btn.removeClass(
                    "m-loader m-loader--right m-loader--light"
                ).attr("disabled", false);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
                btn.removeClass(
                    "m-loader m-loader--right m-loader--light"
                ).attr("disabled", false);
            });
    },
    Alur: function (id) {
        var btn = $("#btnTambah");

        var model = new FormData();
        model.append("idPenelitian", id);
        model.append("idMilestone", $.trim($("#inptMilestoneID").val()));
        model.append("PIC", $.trim($("#slsPIC").val()));
        model.append("catatan", $.trim($("#tbxCatatan").val()));
        if ($("#inptMilestoneID").val() == 3 || $("#inptMilestoneID").val() == 4) {
            if ($("#inptKategoriID").val() != 1) {
                var fileInput = document.getElementById("inptFile");
                var uploadedFile = fileInput.files[0];
                var FileSize = uploadedFile.size / 1024 / 1024;
                if (FileSize > 5) {
                    Common.Alert.Warning("Ukuran file tidak boleh lebih dari 5 MB");
                    return false;
                }
                if (uploadedFile == null) {
                    Common.Alert.Warning("Silahkan unggah file");
                    return false;
                }
                model.append("doc", uploadedFile);
            }
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
            .done(function (data, textStatus, jqXHR) {
                // if (Common.CheckError.Object(data) == true)
                Common.Alert.SuccessRoute(
                    "Berhasil menambahkan",
                    "/Tracking"
                );
                btn.removeClass(
                    "m-loader m-loader--right m-loader--light"
                ).attr("disabled", false);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
                btn.removeClass(
                    "m-loader m-loader--right m-loader--light"
                ).attr("disabled", false);
            });
    },
    Pembayaran: function (id) {
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
                url: "/api/keuanganLog",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                // if (Common.CheckError.Object(data) == true)
                Common.Alert.SuccessRoute(
                    "Berhasil menambahkan",
                    "/Tracking"
                );
                btn.removeClass(
                    "m-loader m-loader--right m-loader--light"
                ).attr("disabled", false);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
                btn.removeClass(
                    "m-loader m-loader--right m-loader--light"
                ).attr("disabled", false);
            });

    }
};

var Table = {
    History: function (id) {
        t = $("#divHistory").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/activity/log/" + id,
                        method: "GET",
                        map: function (r) {
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
            columns: [{
                    field: "idPenelitian",
                    title: "Aksi",
                    sortable: false,
                    textAlign: "center",
                    width: 50,
                    template: function (t) {
                        var strBuilder = "-"
                        if (t.filePath != null) {
                            if (t.idMilestone == 3) {
                                strBuilder =
                                    '<a href="/DataPenelitian/ ' +
                                    t.idPenelitian +
                                    '" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Data Penelitian"><i class="la la-download"></i></a>\t\t\t\t\t\t';
                            } else if (t.idMilestone == 4) {
                                strBuilder =
                                    '<a href="/AnalisisPenelitian/ ' +
                                    t.idPenelitian +
                                    '" class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" title="Hasil Penelitian"><i class="la la-download"></i></a>\t\t\t\t\t\t';
                            }
                        }
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
                    textAlign: "center",
                    template: function (t) {
                        durasi = "-"
                        if (t.idMilestone != 1 && t.idMilestone != 5 && t.durasi != null)
                            durasi = t.durasi < 0 ? 'Terlambat ' + t.durasi + ' hari' :
                            'Cepat ' + t.durasi + ' hari';
                        return durasi;
                    }
                },
                {
                    field: "status",
                    title: "Status",
                    textAlign: "center",
                    template: function (t) {
                        var status = "";
                        if (t.idMilestone == 1 || t.idMilestone == 5) {
                            status = "Selesai";
                        } else {
                            if (t.durasi == null)
                                status = "Sedang dikerjakan"
                            else
                                status = t.durasi < 0 ? "Selesai Terlambat" : "Selesai Tepat Waktu";
                        }
                        return status;
                    }
                },
                {
                    field: "catatan",
                    className: "dt-head-center",
                    title: "Catatan",
                    textAlign: "center",
                    width: 500,
                    template: function (t) {
                        catatan = t.catatan == null ? "-" : t.catatan;
                        return catatan;
                    }
                }
            ]
        });
    }
};

var Control = {
    Init: function () {
        Control.DatePicker();
        Control.SelectPIC();
    },
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
    SelectPIC: function () {
        $.ajax({
                url: "/api/user",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsPIC").html("<option></option>");
                $.each(data, function (i, item) {
                    $("#slsPIC").append(
                        "<option value='" +
                        item.email +
                        "'>" +
                        item.namaUser +
                        "</option>"
                    );
                });
                $("#slsPIC").select2({
                    placeholder: "Pegawai UKHP",
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
        // $("#slsPIC").select2();
    }
};
