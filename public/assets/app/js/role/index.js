var idRole = 0;
//== Class Initialization
jQuery(document).ready(function () {
    $.ajax({
        url: '/api/cekToken',
        type: 'GET',
        success: function () {
            Form.Init();
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
        t = $("#divRoleList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/role",
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
                    field: "idRole",
                    title: "Aksi",
                    sortable: false,
                    textAlign: "center",
                    template: function (t, a) {
                        if (t.idRole != 1) {
                            var strBuilder =
                                '<button onclick="Button.ModalUbah(' +
                                t.idRole +
                                ')" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah Kategori"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                            strBuilder +=
                                '<button onclick="Button.Konfirmasi(' +
                                t.idRole +
                                ')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Kategori"><i class="la la-trash"></i></a>';
                            return strBuilder;
                        }
                    }
                },
                {
                    field: "namaRole",
                    title: "Nama Jabatan",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Form = {
    Init: function () {
        $("#formTambah").validate({
            rules: {
                tbxRole: {
                    required: true
                },
                tbxRoleUbah: {
                    required: true
                }
            }
        });
    }
};

var Button = {
    Init: function () {
        $("#btnTambahRole").on("click", function () {
            if ($.trim($("#tbxRole").val()) == "") {
                Common.Alert.Warning("Nama role tidak boleh kosong");
            } else
                Button.Tambah();
        });
        $("#btnUbahRole").on("click", function () {
            if ($.trim($("#tbxRoleUbah").val()) == "") {
                Common.Alert.Warning("Nama role tidak boleh kosong");
            } else
                Button.Ubah();
        });
    },
    Tambah: function () {
        var btn = $("#btnTambahRole");
        var params = {
            namaRole: $("#tbxRole").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/role",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divRoleList").mDatatable("reload");
                $("#tbxRole").val("");
                $("#formTambah").modal("toggle");
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
    Konfirmasi: function (id) {
        swal({
            title: "Anda yakin?",
            text: "Jabatan ini akan dihapus",
            type: "question",
            showCancelButton: true,
            confirmButtonText: "Yakin, hapus ini!"
        }).then(function (e) {
            if (e.value) {
                Button.Hapus(id);
            }
        });
    },
    Hapus: function (id) {
        $.ajax({
                url: "/api/role/" + id,
                type: "DELETE",
                dataType: "json",
                contentType: "application/json",
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divRoleList").mDatatable("reload");
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Ubah: function () {
        var btn = $("#btnUbahRole");
        var params = {
            idRole: idRole,
            namaRole: $("#tbxRoleUbah").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/role",
                type: "PUT",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divRoleList").mDatatable("reload");
                $("#tbxRoleUbah").val("");
                btn.removeClass(
                    "m-loader m-loader--right m-loader--light"
                ).attr("disabled", false);
                if (Common.CheckError.Object(data))
                    Common.Alert.Success("Berhasil diubah");
                $("#formUbah").modal("toggle");
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
                btn.removeClass(
                    "m-loader m-loader--right m-loader--light"
                ).attr("disabled", false);
            });
    },
    ModalUbah: function (id) {
        $.ajax({
                url: "/api/role/" + id,
                type: "GET",
                dataType: "json"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#tbxRoleUbah").val(data.namaRole);
                $("#formUbah").modal({
                    backdrop: "static"
                });
                window.idRole = data.idRole
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
};
