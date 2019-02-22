//== Class Initialization
jQuery(document).ready(function () {
    Button.Init();
    Table.Init();
});

var Table = {
    Init: function () {
        t = $("#divKategoriList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/kategori",
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
                    field: "idKategori",
                    title: "Actions",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        var strBuilder =
                            '<button onclick="Button.ModalUbah(' + t.idKategori + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah Kategori"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                        strBuilder +=
                            '<button onclick="Button.Hapus(' + t.idKategori + ')" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Kategori"><i class="la la-trash"></i></a>';
                        return strBuilder;
                    }
                },
                {
                    field: "namaKategori",
                    title: "Kategori Peneltian",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Button = {
    Init: function () {
        $("#btnTambahKategori").on("click", function () {
            Button.Tambah();
        });
    },
    Tambah: function () {
        var btn = $("#btnTambahKategori");
        var params = {
            namaKategori: $("#tbxKategori").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/kategori",
                type: "POST",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divKategoriList").mDatatable('reload');
                $("#tbxKategori").val("");
                $("#formTambah").modal("toggle");
                console.log(data);
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
    Hapus: function (id) {
        $.ajax({
                url: "/api/kategori/" + id,
                type: "DELETE",
                dataType: "json",
                contentType: "application/json",
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                Common.Alert.Success("Berhasil dihapus")
                $("#divKategoriList").mDatatable('reload');
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    Ubah: function (id) {
        var btn = $("#btnUbahKategori");
        console.log(id);
        var params = {
            idKategori: id,
            namaKategori: $("#tbxKategoriUbah").val()
        };

        btn.addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );

        $.ajax({
                url: "/api/kategori",
                type: "PUT",
                dataType: "json",
                contentType: "application/json",
                data: JSON.stringify(params),
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                $("#divKategoriList").mDatatable('reload');
                $("#tbxKategoriUbah").val("");
                btn.removeClass("m-loader m-loader--right m-loader--light").attr("disabled", false);
                if (Common.CheckError.Object(data))
                    Common.Alert.Success("Berhasil diubah");
                $("#formUbah").modal("toggle");
                $("#divKategoriList").mDatatable('reload');
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
                url: "/api/kategori/" + id,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                $("#tbxKategoriUbah").val(data.namaKategori);
                $("#formUbah").modal({
                    backdrop: "static"
                });
                $("#btnUbahKategori").on("click", function () {
                    Button.Ubah(data.idKategori);
                })
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
}
