var id = $("#idPenelitian").val();
//== Class Initialization
jQuery(document).ready(function () {
    if ($("#statusPenelitian").val() == 1) {
        $("#formRincian").modal({
            backdrop: "static"
        });
    }
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
                    title: "Aksi",
                    sortable: false,
                    textAlign: "center",
                    width: 75,
                    template: function (t) {
                        var strBuilder =
                            '<button onclick="Control.ModalUbah(' + t.idRincianBiaya + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah Rincian"><i class="la la-edit"></i></button>\t\t\t\t\t\t';
                        strBuilder +=
                            '<button onclick="Control.Hapus(' + t.idRincianBiaya + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Rincian"><i class="la la-trash"></i></button>';
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
                        url: "/api/keuanganLog/" + id,
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
        // tab datatable rapih
        $("#tabLog").on("click", function () {
            $("#divLogList").mDatatable('reload');
        });
    },
    Select: function () {
        $.ajax({
                url: "/api/inventarisasi?tipe=0",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsAlatBahan").html("<option></option>");
                $.each(data, function (i, item) {
                    $("#slsAlatBahan").append("<option value='" + item.idAlatBahan + "'>" + item.namaAlatBahan + "</option>");
                });
                $("#slsAlatBahan").select2({
                    placeholder: "Alat dan Bahan",
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    SelectUbah: function (nama) {
        $.ajax({
                url: "/api/inventarisasi?tipe=0",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsAlatBahanUbah").html("<option></option>");
                $.each(data, function (i, item) {
                    if (item.namaAlatBahan == nama) {
                        $("#slsAlatBahanUbah").append("<option value='" + item.idAlatBahan + "' selected>" + item.namaAlatBahan + "</option>");
                    } else {
                        $("#slsAlatBahanUbah").append("<option value='" + item.idAlatBahan + "'>" + item.namaAlatBahan + "</option>");
                    }
                });
                $("#slsAlatBahanUbah").select2();
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
    Tambah: function () {
        var btn = $("#btnTambah");
        var params = {
            idPenelitian: id,
            namaAlatBahan: $("#slsAlatBahan").val(),
            jumlah: $("#tbxJumlah").val(),
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
                $("#tbxJumlah").val("");
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
    },
    Hapus: function (idRincian) {
        $.ajax({
                url: "/api/keuangan/detail/" + idRincian,
                type: "DELETE",
                dataType: "json",
                contentType: "application/json",
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                Common.Alert.Success("Berhasil dihapus")
                $("#divRincianList").mDatatable('reload');
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    ModalUbah: function (idRincian) {
        $.ajax({
                url: "/api/keuangan/detail/" + id + "/" + idRincian,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                Control.SelectUbah(data.namaAlatBahan);
                $("#slsAlatBahanUbah").val(data.namaAlatBahan);
                $("#tbxJumlahUbah").val(data.jumlah);
                $("#formEditRincian").modal({
                    backdrop: "static"
                });
                $("#btnUbah").on("click", function () {
                    Control.Ubah(data.idRincianBiaya);
                })
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Ubah: function (idRincian) {
        var btn = $("#btnUbahKbtnUbahategori");
        var params = {
            idPenelitian: id,
            idRincianBiaya: idRincian,
            namaAlatBahan: $("#slsAlatBahanUbah").val(),
            jumlah: $("#tbxJumlahUbah").val(),
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/keuangan/detail",
                type: "PUT",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divRincianList").mDatatable('reload');
                Control.Select();
                $("#tbxJumlah").val("");
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
    },
};
