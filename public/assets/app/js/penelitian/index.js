//== Class Initialization
jQuery(document).ready(function() {
    Control.Init();
    Table.Init();
});

var Table = {
    Init: function() {
        t = $("#divPenelitianList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/penelitian",
                        method: "GET",
                        map: function(r) {
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
            columns: [
                {
                    field: "idPenelitian",
                    title: "Actions",
                    sortable: false,
                    textAlign: "center",
                    template: function(t) {
                        var strBuilder =
                            '<a href="/UbahPenelitian/' +
                            t.idPenelitian +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit Penelitian"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                        strBuilder +=
                            '<a href="/Rincian/' +
                            t.idPenelitian +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill" title="Tambah Rincian"><i class="la la-dollar"></i></a>\t\t\t\t\t\t';
                        var routeView = "";
                        if (t.idProsedur != 0) {
                            routeView =
                                "/Prosedur/" +
                                t.idPenelitian +
                                "/" +
                                t.idProsedur +
                                "";
                        } else {
                            routeView =
                                "/TambahProsedur/" + t.idPenelitian + "";
                        }
                        strBuilder +=
                            "<a href=" +
                            routeView +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" title="Tambah Prosedur"><i class="la la-file-text"></i></a>';
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
                    title: "Nama",
                    textAlign: "center"
                },
                {
                    field: "instansiPeneliti",
                    title: "Instansi",
                    textAlign: "center"
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
                    textAlign: "center"
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
    Init: function() {
        Control.Kategori();
        Control.Status();
    },
    Kategori: function() {
        $.ajax({
            url: "/api/kategori",
            type: "GET",
            dataType: "json",
            contenType: "application/json",
            success: function(data) {
                var html = "<option value=''>All</option>";
                var select = $("#slsKategori");

                $.each(data, function(i, item) {
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
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
        $("#slsKategori").on("change", function() {
            t.search($(this).val(), "namaKategori");
        });
    },
    Status: function() {
        $.ajax({
            url: "/api/status",
            type: "GET",
            dataType: "json",
            contenType: "application/json",
            success: function(data) {
                var html = "<option value=''>All</option>";
                var select = $("#slsStatusPen");

                $.each(data, function(i, item) {
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
            error: function(xhr) {
                alert(xhr.responseText);
            }
        });
        $("#slsStatusPen").on("change", function() {
            t.search($(this).val(), "namaStatus");
        });
    }
};
