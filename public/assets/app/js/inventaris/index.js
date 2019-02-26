//== Class Initialization
jQuery(document).ready(function () {
    Control.Init();
    Table.Init();
    Select.AlatBahan();
    Transaction.Init();
});

var Table = {
    Init: function () {
        Table.Stock();
        Table.Pembelian();
        Table.Penggunaan();
    },
    Stock: function () {
        t = $("#divStockList").mDatatable({
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
    Pembelian: function () {
        t = $("#divPembelianList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/inventarisasi/log/1",
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
                }
            ]
        });
    },
    Penggunaan: function () {
        t = $("#divPenggunaanList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/inventarisasi/log/2",
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
                    field: "namaAlatBahan",
                    title: "Alat dan Bahan",
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

var Select = {
    Init: function () {
        // Select.Bulan();
        // Select.Tahun();
        Select.AlatBahan();
    },
    Bulan: function () {
        $.ajax({
            url: "/api/user/list?roleID=4",
            type: "GET",
            dataType: "json",
            contenType: "application/json",
            success: function (data) {
                var html = "<option value=''>All</option>";
                var select = $("#slsBulan");

                $.each(data, function (i, item) {
                    html +=
                        '<option value="' +
                        item.FullName +
                        '">' +
                        item.FullName +
                        "</option>";
                });

                $("#slsBulan").append(html);
                $("#slsBulan").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

        $("#slsBulan").on("change", function () {
            t.search($(this).val(), "ProjectManager");
        });
    },
    Tahun: function () {
        $.ajax({
            url: "/api/user/list?roleID=4",
            type: "GET",
            dataType: "json",
            contenType: "application/json",
            success: function (data) {
                var html = "<option value=''>All</option>";
                var select = $("#slsTahun");

                $.each(data, function (i, item) {
                    html +=
                        '<option value="' +
                        item.FullName +
                        '">' +
                        item.FullName +
                        "</option>";
                });

                $("#slsTahun").append(html);
                $("#slsTahun").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

        $("#slsTahun").on("change", function () {
            t.search($(this).val(), "ProjectManager");
        });
    },
    AlatBahan: function () {
        $.ajax({
                url: "/api/inventarisasi",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $(".m-select2").html("<option></option>");
                $.each(data, function (i, item) {
                    $(".m-select2").append(
                        "<option value='" +
                        item.namaAlatBahan +
                        "'>" +
                        item.namaAlatBahan +
                        "</option>"
                    );
                });
                $("#slsAlatBahan").select2({
                    placeholder: "Alat dan Bahan",
                    tags: true,
                });
                $("#slsAlatBahanGuna").select2({
                    placeholder: "Alat dan Bahan"
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
};

var Control = {
    Init: function () {
        Control.DatePicker();
        Control.Switch();
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
    Switch: function () {
        $("[data-switch=true]").bootstrapSwitch();
    }
};

var Transaction = {
    Init: function () {
        $("#btnTambahPembelian").on("click", function () {
            Transaction.Pembelian();
        });
        $("#btnTambahPenggunaan").on("click", function () {
            Transaction.Penggunaan();
        })
    },
    Pembelian: function () {
        var btn = $("#btnTambahPembelian");
        var params = {
            tipeTrx: 1,
            tipeAlatBahan: $("#btnTipe").prop('checked'),
            namaAlatBahan: $("#slsAlatBahan").val(),
            tglTrx: $("#tbxTanggalPembelian").val(),
            jumlah: $("#tbxJumlahBeli").val(),
            harga: $("#tbxHargaBeli").val()
        };
        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/inventarisasi/log",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divStockList").mDatatable('reload');
                $("#divPembelianList").mDatatable('reload');
                Select.AlatBahan();
                $("#slsAlatBahan").val("");
                $("#tbxTanggalPembelian").val("");
                $("#tbxJumlahBeli").val("");
                $("#tbxHargaBeli").val("")
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
            tglTrx: $("#tbxTanggalPenggunaan").val(),
            jumlah: $("#tbxJumlahPenggunaan").val()
        };
        console.log(params);
        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/inventarisasi/log",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divStockList").mDatatable('reload');
                $("#divPenggunaanList").mDatatable('reload');
                Select.AlatBahan();
                $("#slsAlatBahanGuna").val("");
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
