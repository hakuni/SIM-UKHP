var id = $("#idPenelitian").val();
var idRincianBiaya = 0;
//== Class Initialization
jQuery(document).ready(function () {
    if ($("#statusPenelitian").val() == 1) {
        $("#formRincian").modal({
            backdrop: "static"
        });
    }
    Button.Init();
    Control.Init();
    Table.Init();
    Select.Milestone();
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
                            '<button onclick="Control.Konfirmasi(' + t.idRincianBiaya + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Rincian"><i class="la la-trash"></i></button>';
                        return strBuilder;
                    }
                },
                {
                    field: "namaMilestone",
                    title: "Milestone",
                    textAlign: "center"
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
        Control.Repeat();
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
        var result = [];
        var params = {};
        var done = 0;
        $(".divRepeat").each(function (index, item) {
            params = {
                idPenelitian: id,
                namaMilestone: $("#slsMilestone").val(),
                namaAlatBahan: "",
                jumlah: "",
                keterangan: "",
            };
            $(this).find(".infinityInput").each(function (index, item) {
                if (index == 1) {
                    if ($(this).val() == "") {
                        done = -1;
                    }
                    params.namaAlatBahan = $(this).val();
                }
                if (index == 2) {
                    if ($(this).val() == "") {
                        done = -1;
                    }
                    params.jumlah = $(this).val();
                }
                if (index == 3) {
                    params.keterangan = $(this).val();
                }
            });
            result.push(params);
        });
        console.log(result)
        if (done == -1) {
            Common.Alert.Warning("Periksa kembali data masukan anda");
            return false;
        }

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );
        $.ajax({
                url: "/api/keuangan/detail",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(result),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divRincianList").mDatatable('reload');
                Select.Milestone();
                Select.Fill();
                $(".slsAlatBahan").val("");
                $(".tbxJumlah").val("");
                $(".tbxKeterangan").val("");
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
    Konfirmasi: function (id) {
        swal({
            title: "Anda yakin?",
            text: "Alat dan Bahan ini akan dihapus",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "Yakin, hapus ini!",
        }).then(function (e) {
            if (e.value) {
                Control.Hapus(id);
            }
        })
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
                $("#txtMilestone").html(data.namaMilestone);
                $("#slsAlatBahanUbah").val(data.namaAlatBahan);
                $("#tbxJumlahUbah").val(data.jumlah);
                $("#formEditRincian").modal({
                    backdrop: "static"
                });
                window.idRincianBiaya = data.idRincianBiaya
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Ubah: function () {
        var btn = $("#btnUbah");
        var params = {
            idPenelitian: id,
            idRincianBiaya: idRincianBiaya,
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
                Control.SelectUbah();
                $("#tbxJumlah").val("");
                $("#formEditRincian").modal("toggle");
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
    Repeat: function () {
        Select.Init();
        $("#formRepeat").repeater({
            initEmpty: !1,
            defaultValues: {
                "text-input": "foo"
            },
            show: function () {
                $(this).slideDown();
                $(this).addClass("divRepeat");
                Select.Init();
            },
            hide: function (e) {
                $(this).slideUp(e)
            }
        })
    }
};

var Button = {
    Init: function(){
        $("#btnTambah").on("click", function () {
            // Control.Tambah();
            if ($("#slsMilestone").val() == 0) {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Control.Tambah();
        });
        // tab datatable rapih
        $("#tabLog").on("click", function () {
            $("#divLogList").mDatatable('reload');
        });
        
        $("#btnUbah").on("click", function () {
            if ($.trim($("#tbxJumlahUbah").val()) == "" || $("#slsAlatBahanUbah").val() == 0) {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Control.Ubah();
        })
    }
}

var Select = {
    Init: function () {
        var select = $(".slsAlatBahan");
        select.each(function (index, item) {
            var ths = $(this);
            //autofill severity from db
            if (ths.hasClass("notInit")) {
                Select.Fill(ths);
            }
        })
    },
    Fill: function (ths) {
        $.ajax({
                url: "/api/inventarisasi?tipe=0",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                ths.html("<option value='' selected style='display:none'>Pilih Layanan</option>");
                $.each(data, function (i, item) {
                    ths.append("<option value='" + item.idAlatBahan + "'>" + item.namaAlatBahan + "</option>");
                });
                ths.removeClass("notInit")
                ths.selectpicker('refresh');
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Milestone: function () {
        $.ajax({
                url: "/api/milestone",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsMilestone").html("<option></option>");
                $.each(data, function (i, item) {
                    if (item.idMilestone == 2 || item.idMilestone == 3 || item.idMilestone == 4) {
                        $("#slsMilestone").append("<option value='" + item.idMilestone + "'>" + item.namaMilestone + "</option>");
                    }
                });
                $("#slsMilestone").select2({
                    placeholder: "Milestone",
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
};
