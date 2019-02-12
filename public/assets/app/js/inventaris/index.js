//== Class Initialization
jQuery(document).ready(function () {
    Control.Init();
    Table.Init();
    // Select.Init();
});

var Table = {
    Init: function () {
        Table.Stock();
        Table.Pembelian();
        Table.Penggunaan();
    },
    Stock: function () {
        t = $("#divStockList").mDatatable({
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
                    field: "AlatBahan",
                    title: "Alat dan Bahan",
                    textAlign: "center"
                },
                {
                    field: "Jumlah",
                    title: "Jumlah",
                    textAlign: "center"
                }
            ]
        });
    },
    Pembelian: function () {
        t = $("#divPembelianList").mDatatable({
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
                    field: "AlatBahan",
                    title: "Alat dan Bahan",
                    textAlign: "center"
                },
                {
                    field: "TanggalPembelian",
                    title: "Tanggal Pembelian",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        return t.TanggalPembayaran != null ? Common.Format.Date(t.TanggalPembayaran) : "-"
                    }
                },
                {
                    field: "Jumlah",
                    title: "Jumlah",
                    textAlign: "center"
                },
                {
                    field: "Harga",
                    title: "Harga",
                    textAlign: "center"
                }
            ]
        });
    },
    Penggunaan: function () {
        t = $("#divPenggunaanList").mDatatable({
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
                    field: "AlatBahan",
                    title: "Alat dan Bahan",
                    textAlign: "center"
                },
                {
                    field: "TanggalPenggunaan",
                    title: "Tanggal Penggunaan",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        return t.TanggalPenggunaan != null ? Common.Format.Date(t.TanggalPenggunaan) : "-"
                    }
                },
                {
                    field: "Jumlah",
                    title: "Jumlah",
                    textAlign: "center"
                }
            ]
        });
    }
};

var Select = {
    Init: function () {
        Select.Bulan();
        Select.Tahun();
    },
    Bulan: function () {
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
                var select = $("#slsBulan");

                $.each(data, function (i, item) {
                    html +=
                        '<option value="' +
                        item.FullName +
                        '">' +
                        item.FullName +
                        "</option>";
                });

                $("#slsBulan").append(html);
                $("#slsBulan").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

        $("#slsBulan").on("change", function () {
            t.search($(this).val(), "ProjectManager");
        });
    },
    Tahun: function () {
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
                var select = $("#slsTahun");

                $.each(data, function (i, item) {
                    html +=
                        '<option value="' +
                        item.FullName +
                        '">' +
                        item.FullName +
                        "</option>";
                });

                $("#slsTahun").append(html);
                $("#slsTahun").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

        $("#slsTahun").on("change", function () {
            t.search($(this).val(), "ProjectManager");
        });
    }
};

var Control = {
    Init: function () {
        Control.DatePicker();
    },
    DatePicker: function () {
        console.log('.datepicker');
        $(".datepicker").datepicker({
            format: "dd-M-yyyy",
            todayBtn: "linked",
            clearBtn: !0,
            todayHighlight: !0,
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
    }
};
