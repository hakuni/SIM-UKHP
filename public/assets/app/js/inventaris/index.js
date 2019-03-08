var bulan = 0;
var tahun = 0;
//== Class Initialization
jQuery(document).ready(function () {
    Data.Init();
    Table.Stock();
    Button.Init();
    Select.Init();
    Transaction.Init();
});

var Data = {
    Init: function(){
        Data.Pembelian("","");
        Data.Penggunaan("","");
    },
    Pembelian: function(bulan, tahun){
        $.ajax({
            url: "/api/inventarisasiLog/1?bulan="+bulan+"&tahun="+tahun,
            type: "GET",
        })
        .done(function (data, textStatus, jqXHR) {
            $("#divPembelianList").mDatatable('destroy');
            Table.Pembelian(data);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            Common.Alert.Error(errorThrown);
        });
    },
    Penggunaan: function(bulan, tahun){
        $.ajax({
            url: "/api/inventarisasiLog/2?bulan="+bulan+"&tahun="+tahun,
            type: "GET",
        })
        .done(function (data, textStatus, jqXHR) {
            $("#divPenggunaanList").mDatatable('destroy');
            Table.Penggunaan(data);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            Common.Alert.Error(errorThrown);
        });
    }
};

var Table = {
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
    Pembelian: function (data) {
        t = $("#divPembelianList").mDatatable({
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
    Penggunaan: function (data) {
        t = $("#divPenggunaanList").mDatatable({
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

var Button = {
    Init: function(){
        Button.FilterBeli();
        Button.FilterGuna();
        Button.DatePicker();
        Button.Switch();
    },
    FilterBeli: function(){
        $("#btnFilterBeli").on("click", function(){
            $(this).addClass("m-loader m-loader--right m-loader--light").attr("disabled",true);
            bulan = $("#slsBulanBeli").val();
            tahun = $("#tbxTahunBeli").val();
            Data.Pembelian(bulan,tahun);
            $(this).removeClass("m-loader m-loader--right m-loader--light").attr("disabled",false);
        })
    },
    FilterGuna: function(){
        $("#btnFilterGuna").on("click", function(){
            $(this).addClass("m-loader m-loader--right m-loader--light").attr("disabled",true);
            bulan = $("#slsBulanGunaBeli").val();
            tahun = $("#tbxTahunGunaBeli").val();
            Data.Penggunaan(bulan,tahun);
            $(this).removeClass("m-loader m-loader--right m-loader--light").attr("disabled",false);
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
    },
    Switch: function () {
        $("[data-switch=true]").bootstrapSwitch();
    }
};

var Select = {
    Init: function () {
        Select.Bulan();
        Select.AlatBahan();
    },
    Bulan: function () {
        $("#slsBulanStock").select2();
        $("#slsBulanPembelian").select2();
        $("#slsBulanPenggunaan").select2();
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
                url: "/api/inventarisasiLog",
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
                url: "/api/inventarisasiLog",
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
