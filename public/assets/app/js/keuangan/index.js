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
        t = $("#divKeuanganList").mDatatable({
            data: {
                type: "remote",
                source: {
                    read: {
                        url: "/api/keuangan",
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
            search: {},
            columns: [{
                    field: "idPenelitian",
                    title: "Aksi",
                    sortable: false,
                    textAlign: "center",
                    width: 50,
                    template: function (t) {
                        var strBuilder =
                            '<a href="/Keuangan/Rincian/' + t.idPenelitian + '" class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill" title="Rincian Keuangan"><i class="la la-info-circle"></i></a>';
                        return strBuilder;
                    }
                },
                {
                    field: "namaPeneliti",
                    title: "Nama",
                    textAlign: "center"
                },
                {
                    field: "namaKategori",
                    title: "Kategori",
                    textAlign: "center"
                },
                {
                    field: "tgl",
                    title: "Tanggal Pembayaran",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        return t.tgl != null ? Common.Format.Date(t.tgl) : "-"
                    }
                },
                {
                    field: "biaya",
                    title: "Biaya",
                    textAlign: "center",
                    template: function (k) {
                        return Common.Format.CommaSeparation(k.biaya);
                    }
                },
                {
                    field: "statusPembayaran",
                    title: "Status",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Control = {
    Init: function () {
        Control.Select();
    },
    Select: function () {
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
                $("#slsStatusPen").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

        $("#slsKategori").on("change", function () {
            t.search($(this).val(), "namaKategori");
        });
        $("#slsStatusPen").on("change", function () {
            t.search($(this).val(), "statusPembayaran");
        });
    }
};
