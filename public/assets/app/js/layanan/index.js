var idAlatBahan = 0;
//== Class Initialization
jQuery(document).ready(function () {
    $.ajax({
        url: '/api/cekToken',
        type: 'GET',
        success: function () {
            Button.Init();
            Table.Init();
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

var Table = {
    Init: function () {
        t = $("#divLayananList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/inventarisasi?tipe=0",
                        method: "GET",
                        map: function (r) {
                            var e = r;
                            return void 0 !== r.data && (e = r.data), e;
                        }
                    }
                },
                pageSize: 10,
                saveState: {
                    cookie: false,
                    webstorage: false
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
                    field: "idAlatBahan",
                    title: "Aksi",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        var strBuilder =
                            '<button onclick="Button.ModalUbah(' + t.idAlatBahan + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah Kategori"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                        strBuilder +=
                            '<button onclick="Button.ConfirmDelete(' + t.idAlatBahan + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Kategori"><i class="la la-trash"></i></a>';
                        return strBuilder;
                    }
                },
                {
                    field: "namaAlatBahan",
                    title: "Item",
                    textAlign: "center"
                },
                {
                    field: "harga",
                    title: "Harga",
                    textAlign: "center"
                },
                {
                    field: "satuan",
                    title: "Satuan",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Button = {
    Init: function () {
        $("#btnTambahLayanan").on("click", function () {
            if ($.trim($("#tbxItem").val()) == "" || $.trim($("#tbxHarga").val()) == "" || $.trim($("#tbxSatuan").val()) == "") {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Button.Tambah();
        });
        $("#btnUbahLayanan").on("click", function () {
            if ($.trim($("#tbxItemUbah").val()) == "" || $.trim($("#tbxHargaUbah").val()) == "" || $.trim($("#tbxSatuanUbah").val()) == "") {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Button.Ubah();
        })
    },
    Tambah: function () {
        var btn = $("#btnTambahLayanan");
        var params = {
            tipeAlatBahan: $("input[name='tipe']:checked").val(),
            namaAlatBahan: $("#tbxItem").val(),
            harga: $("#tbxHarga").val(),
            satuan: $("#tbxSatuan").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/inventarisasi",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divLayananList").mDatatable('reload');
                $("input[name='tipe']").prop('checked', false);
                $("#tbxItem").val("");
                $("#tbxHarga").val("");
                $("#tbxSatuan").val("");
                $("#formTambah").modal("toggle");
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
    ConfirmDelete: function (id) {
        swal({
            title: "Anda yakin?",
            text: "Layanan ini akan dihapus",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "Yakin, hapus ini!",
        }).then(function (e) {
            if (e.value) {
                Button.Hapus(id);
            }
        })
    },
    Hapus: function (id) {
        $.ajax({
                url: "/api/inventarisasi/" + id,
                type: "DELETE",
                dataType: "json",
                contentType: "application/json",
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                Common.Alert.Success("Berhasil dihapus")
                $("#divLayananList").mDatatable('reload');
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Ubah: function () {
        var btn = $("#btnUbahLayanan");
        var params = {
            idAlatBahan: idAlatBahan,
            tipeAlatBahan: $("input[name='tipeUbah']:checked").val(),
            namaAlatBahan: $("#tbxItemUbah").val(),
            harga: $("#tbxHargaUbah").val(),
            satuan: $("#tbxSatuanUbah").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/inventarisasi",
                type: "PUT",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divLayananList").mDatatable('reload');
                $("input[name='tipe']").prop('checked', false);
                $("#tbxItemUbah").val("");
                $("#tbxHargaUbah").val("");
                $("#tbxSatuanUbah").val("");
                btn.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", false);
                // if (Common.CheckError.Object(data))
                Common.Alert.Success("Berhasil diubah");
                $("#formUbah").modal("toggle");
                $("#divLayananList").mDatatable('reload');
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
                btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                    "disabled",
                    false
                );
            });
    },
    ModalUbah: function (id) {
        $.ajax({
                url: "/api/inventarisasi/" + id,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                if (data.tipeAlatBahan == 1) {
                    $("#hewan").prop("checked", true);
                } else if (data.tipeAlatBahan == 2) {
                    $("#alatBahan").prop("checked", true);
                } else if (data.tipeAlatBahan == 3) {
                    $("#jasa").prop("checked", true);
                } else if (data.tipeAlatBahan == 4) {
                    $("#serum").prop("checked", true);
                }
                $("#tbxItemUbah").val(data.namaAlatBahan);
                $("#tbxHargaUbah").val(data.harga);
                $("#tbxSatuanUbah").val(data.satuan);
                $("#formUbah").modal({
                    backdrop: "static"
                });
                window.idAlatBahan = data.idAlatBahan
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
}
