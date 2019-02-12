//== Class Initialization
jQuery(document).ready(function () {
    // Control.Init();
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
                        url: "/api/project/list/",
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
                    field: "RincianID",
                    title: "Actions",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        var strBuilder =
                            '<a href="editRincian' +
                            t.RincianID +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Edit Rincian"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                        strBuilder +=
                            '<a href="hapusRincian' +
                            t.RincianID +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Rincian"><i class="la la-trash"></i></a>';
                        return strBuilder;
                    }
                }, {
                    field: "AlatBahan",
                    title: "Alat dan Bahan",
                    textAlign: "center"
                },
                {
                    field: "Jumlah",
                    title: "Jumlah",
                    textAlign: "center"
                },
                {
                    field: "Biaya",
                    title: "Biaya",
                    textAlign: "center"
                },
                {
                    field: "Total",
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
                        url: "/api/project/list/",
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
                    field: "TanggalPembayaran",
                    title: "Tanggal Pembayaran",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        return t.TanggalPembayaran != null ? Common.Format.Date(t.TanggalPembayaran) : "-"
                    }
                },
                {
                    field: "Biaya",
                    title: "Biaya",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Control = {
    Init: function () {
        if ($("#errorMsg").val() != "-") {
            Common.Alert.ErrorRoute($("#errorMsg").val(), document.referrer);
        }

        $.ajax({
            url: "/api/user/list?roleID=4",
            type: "GET",
            dataType: "json",
            contenType: "application/json",
            success: function (data) {
                var html = "<option value=''>All</option>";
                var select = $("#slsProjectManager");

                $.each(data, function (i, item) {
                    html +=
                        '<option value="' +
                        item.FullName +
                        '">' +
                        item.FullName +
                        "</option>";
                });

                $("#slsProjectManager").append(html);
                $("#slsProjectManager").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

        $("#slsProjectManager").on("change", function () {
            t.search($(this).val(), "ProjectManager");
        });
    }
};
