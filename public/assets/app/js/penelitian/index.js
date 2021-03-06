//== Class Initialization
jQuery(document).ready(function () {
    $.ajax({
        url: '/api/cekToken',
        type: 'GET',
        success: function () {
            Control.Init();
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
        t = $("#divPenelitianList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/penelitian",
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
                    field: "idPenelitian",
                    title: "Aksi",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        var strBuilder =
                            '<a href="/Penelitian/UbahPenelitian/' +
                            t.idPenelitian +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah Penelitian"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                        
                        var routeView = "/Penelitian/Prosedur/" + t.idPenelitian + "/" + t.idProsedur;
                        if (t.idProsedur == 0) {
                            routeView = "/Penelitian/TambahProsedur/" + t.idPenelitian;
                        }
                        if (t.idKategori != 1){
                            strBuilder +=
                            '<a href=' + routeView + ' class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" title="Prosedur Penelitian"><i class="la la-file-text"></i></a>\t\t\t\t\t\t';
                        }
                            strBuilder +=
                            '<a href="/Keuangan/Rincian/' +
                            t.idPenelitian +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Rincian Biaya"><i class="la la-dollar"></i></a>';
                            return strBuilder;
                    }
                },
                {
                    field: "namaKategori",
                    title: "Kategori Peneltian",
                    textAlign: "center"
                },
                {
                    field: "namaPeneliti",
                    title: "Nama Peneliti",
                    textAlign: "center"
                },
                {
                    field: "instansiPeneliti",
                    title: "Instansi",
                    textAlign: "center",
                    template: function(t){
                        return t.instansiPeneliti == null ? "-" : t.instansiPeneliti;
                    }
                },
                {
                    field: "telpPeneliti",
                    title: "No. HP",
                    textAlign: "center"
                },
                {
                    field: "emailPeneliti",
                    title: "Email",
                    textAlign: "center"
                },
                {
                    field: "alamatPeneliti",
                    title: "Alamat",
                    textAlign: "center",
                    template: function(t){
                        return t.alamatPeneliti == null ? "-": t.alamatPeneliti;
                    }
                },
                {
                    field: "namaStatus",
                    title: "Status",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Control = {
    Init: function () {
        Control.Kategori();
        Control.Status();
    },
    Kategori: function () {
        $.ajax({
            url: "/api/kategori",
            type: "GET",
            dataType: "json",
            contenType: "application/json",
            success: function (data) {
                var html = "<option value=''>Semua</option>";
                var select = $("#slsKategori");

                $.each(data, function (i, item) {
                    html +=
                        '<option value="' +
                        item.namaKategori +
                        '">' +
                        item.namaKategori +
                        "</option>";
                });
                $("#slsKategori").append(html);
                $("#slsKategori").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
        $("#slsKategori").on("change", function () {
            t.search($(this).val(), "namaKategori");
        });
    },
    Status: function () {
        $.ajax({
            url: "/api/status",
            type: "GET",
            dataType: "json",
            contenType: "application/json",
            success: function (data) {
                var html = "<option value=''>Semua</option>";
                var select = $("#slsStatusPen");

                $.each(data, function (i, item) {
                    html +=
                        '<option value="' +
                        item.namaStatus +
                        '">' +
                        item.namaStatus +
                        "</option>";
                });
                $("#slsStatusPen").append(html);
                $("#slsStatusPen").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });
        $("#slsStatusPen").on("change", function () {
            t.search($(this).val(), "namaStatus");
        });
    }
};
