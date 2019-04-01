// get tahun sekarang
var kalender = new Date;
var tahunIni = kalender.getFullYear();
// set tahun dan bulan 0 utk dapat semua list
var bulan = 0;
var tahun = 0;
//== Class Initialization
jQuery(document).ready(function () {
    $.ajax({
        url: '/api/cekToken',
        type: 'GET',
        success: function () {
            Data.Init();
            Table.Stock();
            Button.Init();
            Select.Init();
            Transaction.Init();
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

var Data = {
    Init: function () {
        Data.Pembelian("", "");
        Data.Penggunaan("", "");
    },
    Pembelian: function (bulan, tahun) {
        $.ajax({
                url: "/api/inventarisasiLog/1?bulan=" + bulan + "&tahun=" + tahun,
                type: "GET",
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divPembelianList").mDatatable('destroy');
                Table.Pembelian(data);
                $("#btnFilterBeli").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", false);

            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Penggunaan: function (bulan, tahun) {
        $.ajax({
                url: "/api/inventarisasiLog/2?bulan=" + bulan + "&tahun=" + tahun,
                type: "GET",
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divPenggunaanList").mDatatable('destroy');
                Select.SelectStatus();
                Table.Penggunaan(data);
                $("#btnFilterGuna").removeClass("m-loader m-loader--right m-loader--light").attr("disabled", false);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
};

var Table = {
    Stock: function () {
        s = $("#divStockList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/inventarisasi",
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
                footer: false,
                spinner: {
                    message: 'Mohon Bersabar . . . '
                },
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
                    field: "namaAlatBahan",
                    title: "Alat dan Bahan",
                    textAlign: "center"
                },
                {
                    template: function (i) {
                        return i.jumlahBeli - i.jumlahPakai;
                    },
                    field: "stokAlatBahan",
                    title: "Jumlah",
                    textAlign: "center"
                }
            ]
        });
    },
    Pembelian: function (data) {
        b = $("#divPembelianList").mDatatable({
            data: {
                type: "local",
                source: data,
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
                footer: false,
                spinner: {
                    message: 'Mohon Bersabar . . . '
                },
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
                    field: "namaAlatBahan",
                    title: "Alat dan Bahan",
                    textAlign: "center"
                },
                {
                    field: "tglTrx",
                    title: "Tanggal Pembelian",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        return t.tglTrx != null ? Common.Format.Date(t.tglTrx) : "-"
                    }
                },
                {
                    field: "jumlah",
                    title: "Jumlah",
                    textAlign: "center"
                },
                {
                    field: "harga",
                    title: "Harga",
                    textAlign: "center"
                },
                {
                    field: "total",
                    title: "Total",
                    textAlign: "center",
                }
            ]
        });
    },
    Penggunaan: function (data) {
        g = $("#divPenggunaanList").mDatatable({
            data: {
                type: "local",
                source: data,
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
                footer: false,
                spinner: {
                    message: 'Mohon Bersabar . . . '
                },
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
                    field: "namaAlatBahan",
                    title: "Alat dan Bahan",
                    textAlign: "center"
                },
                {
                    field: "namaStatusPenggunaan",
                    title: "Status",
                    textAlign: "center"
                },
                {
                    field: "tglTrx",
                    title: "Tanggal Penggunaan",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        return t.tglTrx != null ? Common.Format.Date(t.tglTrx) : "-"
                    }
                },
                {
                    field: "jumlah",
                    title: "Jumlah",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Button = {
    Init: function () {
        Button.TabRefresh();
        Button.FilterBeli();
        Button.FilterGuna();
        Button.DatePicker();
    },
    TabRefresh: function () {
        $("#tabStock").on("click", function () {
            $("#divStockList").mDatatable('reload');
        });
        $("#tabBeli").on("click", function () {
            $("#divPembelianList").mDatatable('reload');
        });
        $("#tabGuna").on("click", function () {
            $("#divPenggunaanList").mDatatable('reload');
        });
    },
    FilterBeli: function () {
        $("#btnFilterBeli").on("click", function () {
            $("#btnFilterBeli").addClass("m-loader m-loader--right m-loader--light").attr("disabled", true);
            bulan = $("#slsBulanBeli").val();
            tahun = $("#tbxTahunBeli").val();
            Data.Pembelian(bulan, tahun);
        })
    },
    FilterGuna: function () {
        $("#btnFilterGuna").on("click", function () {
            $("#btnFilterGuna").addClass("m-loader m-loader--right m-loader--light").attr("disabled", true);
            bulan = $("#slsBulanGunaBeli").val();
            tahun = $("#tbxTahunGunaBeli").val();
            Data.Penggunaan(bulan, tahun);
        })
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
    }
};

var Select = {
    Init: function () {
        Select.Bulan();
        Select.AlatBahan();
        Select.Status();
    },
    Bulan: function () {
        $("#slsBulanStock").select2();
        $("#slsBulanPembelian").select2();
        $("#slsBulanPenggunaan").select2();
        document.getElementById("tbxTahunBeli").value = tahunIni;
        document.getElementById("tbxTahunGuna").value = tahunIni;

    },
    AlatBahan: function () {
        $.ajax({
                url: "/api/inventarisasi?tipe=-1",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $(".alatBahan").html("<option></option>");
                $.each(data, function (i, item) {
                    $(".alatBahan").append(
                        "<option value='" +
                        item.idAlatBahan +
                        "'>" +
                        item.namaAlatBahan +
                        "</option>"
                    );
                });
                $("#slsAlatBahan").select2({
                    placeholder: "Alat dan Bahan"
                });
                $("#slsAlatBahanGuna").select2({
                    placeholder: "Alat dan Bahan"
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Status: function () {
        $.ajax({
                url: "/api/statusPenggunaan",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsStatusGuna").html("<option></option>");
                $.each(data, function (i, item) {
                    $("#slsStatusGuna").append(
                        "<option value='" +
                        item.idStatusPenggunaan +
                        "'>" +
                        item.namaStatusPenggunaan +
                        "</option>"
                    );
                });
                $("#slsStatusGuna").select2({
                    placeholder: "Status Penggunaan",
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    SelectStatus: function () {
        $.ajax({
            url: "/api/statusPenggunaan",
            type: "GET",
            dataType: "json",
            contenType: "application/json",
            success: function (data) {
                var html = "<option value=''>Semua</option>";
                $.each(data, function (i, item) {
                    html +=
                        '<option value="' +
                        item.namaStatusPenggunaan +
                        '">' +
                        item.namaStatusPenggunaan +
                        "</option>";
                });
                $("#slsStatus").append(html);
                $("#slsStatus").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
        $("#slsStatus").on("change", function () {
            g.search($(this).val(), "namaStatusPenggunaan");
        });
    },
};

var Transaction = {
    Init: function () {
        $("#btnTambahPembelian").on("click", function () {
            if ($("#slsAlatBahan").val() == 0 || $.trim($("#tbxTanggalPembelian").val()) == "" || $.trim($("#tbxJumlahBeli").val()) == "") {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Transaction.Pembelian();
        });
        $("#btnTambahPenggunaan").on("click", function () {
            if ($("#slsAlatBahanGuna").val() == 0 || $.trim($("#tbxTanggalPenggunaan").val()) == "" || $.trim($("#tbxJumlahPenggunaan").val()) == "") {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Transaction.Penggunaan();
        })
    },
    Pembelian: function () {
        var btn = $("#btnTambahPembelian");
        var params = {
            tipeTrx: 1,
            // tipeAlatBahan: $("#btnTipe").prop('checked'),
            namaAlatBahan: $("#slsAlatBahan").val(),
            tglTrx: $("#tbxTanggalPembelian").val(),
            jumlah: $("#tbxJumlahBeli").val(),
        };
        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/inventarisasiLog",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                Data.Pembelian("", "");
                $("#divPembelianList").mDatatable('reload');
                Select.AlatBahan();
                $("#slsAlatBahan").val("");
                $("#tbxTanggalPembelian").val("");
                $("#tbxJumlahBeli").val("");
                $("#formPembelian").modal("toggle");
                btn.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", false);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
                btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                    "disabled",
                    false
                );
            });
    },
    Penggunaan: function () {
        var btn = $("#btnTambahPenggunaan");
        var params = {
            tipeTrx: 2,
            namaAlatBahan: $("#slsAlatBahanGuna").val(),
            idStatusPenggunaan: $("#slsStatusGuna").val(),
            tglTrx: $("#tbxTanggalPenggunaan").val(),
            jumlah: $("#tbxJumlahPenggunaan").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/inventarisasiLog",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                Data.Penggunaan("", "");
                $("#divPenggunaanList").mDatatable('reload');
                Select.AlatBahan();
                Select.Status();
                $("#tbxTanggalPenggunaan").val("");
                $("#tbxJumlahPenggunaan").val("");
                $("#formPenggunaan").modal("toggle");
                btn.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", false);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
                btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                    "disabled",
                    false
                );
            });
    }
}
