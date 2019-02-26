var id = $("#idPenelitian").val();
//== Class Initialization
jQuery(document).ready(function () {
    $("#formRincian").modal({
        backdrop: "static"
    });
    Control.Init();
    Table.Init();
});

var Table = {
    Init: function () {
        Table.Rincian();
        Table.Log();
    },
    Rincian: function () {
        t = $("#divRincianList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/keuangan/detail/" + id,
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
                    field: "idRincianBiaya",
                    title: "Actions",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        var strBuilder =
                            '<a href="editRincian' +
                            t.idRincianBiaya +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit Rincian"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                        strBuilder +=
                            '<a href="hapusRincian' +
                            t.idRincianBiaya +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Rincian"><i class="la la-trash"></i></a>';
                        return strBuilder;
                    }
                }, {
                    field: "namaAlatBahan",
                    title: "Alat dan Bahan",
                    textAlign: "center"
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
                    textAlign: "center"
                }
            ]
        });
    },
    Log: function () {
        t = $("#divLogList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/keuangan/log/" + id,
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
                    field: "tglPembayaran",
                    title: "Tanggal Pembayaran",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        return t.tglPembayaran != null ? Common.Format.Date(t.tglPembayaran) : "-"
                    }
                },
                {
                    field: "totalPembayaran",
                    title: "Biaya",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Control = {
    Init: function () {
        Control.Biodata();
        $("#btnTambah").on("click", function () {
            Control.Tambah();
        });
        Control.Select();
        Control.Switch();
    },
    Select: function () {
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
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Biodata: function () {
        $.ajax({
                url: "/api/penelitian/" + id,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                $("#biodata").text(data.namaPeneliti + ", " + data.instansiPeneliti)
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Switch: function () {
        $("[data-switch=true]").bootstrapSwitch();
    },
    Tambah: function () {
        var btn = $("#btnTambah");
        var params = {
            idPenelitian: id,
            // idAlatBahan:
            tipeAlatBahan: $("#btnTipe").prop('checked'),
            namaAlatBahan: $("#slsAlatBahan").val(),
            jumlah: $("#tbxJumlah").val(),
            harga: $("#tbxHarga").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/keuangan/detail",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divRincianList").mDatatable('reload');
                Control.Select();
                $("#tbxAlatBahan").val("");
                $("#tbxJumlah").val("");
                $("#tbxHarga").val("");
                $("#formRincian").modal("toggle");
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
};
