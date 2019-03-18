//== Class Initialization
jQuery(document).ready(function () {
    Button.Init();
    Table.Init();
});

var Table = {
    Init: function () {
        t = $("#divUserList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/user",
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
                    field: "id",
                    title: "Aksi",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        var strBuilder =
                            '<button onclick="Button.ModalUbah(' + t.id + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah Pengguna"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                        strBuilder +=
                            '<button onclick="Button.ConfirmDelete(' + t.id + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Pengguna"><i class="la la-trash"></i></a>';
                        return strBuilder;
                    }
                },
                {
                    field: "namaUser",
                    title: "Nama",
                    textAlign: "center"
                },
                {
                    field: "email",
                    title: "Email",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Button = {
    Init: function () {
        $("#btnTambahUser").on("click", function () {
            if ($.trim($("#tbxEmail").val()) == "" || $.trim($("#tbxNama").val()) == "" || $.trim($("#tbxPass").val()) == "") {
                Common.Alert.Warning("Periksa kembali data masukan anda");
            } else
                Button.Tambah();
        });
    },
    Tambah: function () {
        var btn = $("#btnTambahUser");
        var params = {
            email: $("#tbxEmail").val(),
            namaUser: $("#tbxNama").val(),
            password: $("#tbxPass").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/user",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divUserList").mDatatable('reload');
                $("#tbxEmail").val("");
                $("#tbxNama").val("");
                $("#tbxPass").val("");
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
            text: "Pengguna ini akan dihapus",
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
                url: "/api/user/" + id,
                type: "DELETE",
                dataType: "json",
                contentType: "application/json",
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                Common.Alert.Success("Berhasil dihapus")
                $("#divUserList").mDatatable('reload');
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Ubah: function (id) {
        var btn = $("#btnUbahUser");
        var params = {
            id: id,
            namaUser: $("#tbxNamaUbah").val(),
            email: $("#tbxEmailUbah").val(),
            password: $("#tbxPassUbah").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/user",
                type: "PUT",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divUserList").mDatatable('reload');
                $("#tbxNamaUbah").val("");
                $("#tbxEmailUbah").val("");
                $("#tbxPassUbah").val("");
                btn.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", false);
                // if (Common.CheckError.Object(data))
                Common.Alert.Success("Berhasil diubah");
                $("#formUbah").modal("toggle");
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
                url: "/api/user/" + id,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                $("#tbxNamaUbah").val(data.namaUser);
                $("#tbxEmailUbah").val(data.email);
                $("#tbxPassUbah").val(data.password);
                $("#formUbah").modal({
                    backdrop: "static"
                });
                $("#btnUbahUser").on("click", function () {
                    if ($.trim($("#tbxNamaUbah").val()) != "" || $.trim($("#tbxEmailUbah").val()) != "") {
                        Button.Ubah(data.id);
                    } else
                        Common.Alert.Warning("Periksa kembali data masukan anda");
                })
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
}
