//== Class Initialization
jQuery(document).ready(function () {
    // Control.Init();
    Table.Init();
});

var Table = {
    Init: function () {
        t = $("#divKategoriList").mDatatable({
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
                    field: "KategoriID",
                    title: "Actions",
                    sortable: false,
                    textAlign: "center",
                    template: function (t) {
                        var strBuilder =
                            '<a href="/UbahKategori' +
                            t.KategoriID +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only m-btn--pill" title="Ubah Kategori"><i class="la la-edit"></i></a>\t\t\t\t\t\t';
                        strBuilder +=
                            '<a href="/HapusKategori' +
                            t.KategoriID +
                            '" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Hapus Kategori"><i class="la la-trash"></i></a>';
                        return strBuilder;
                    }
                },
                {
                    field: "Kategori",
                    title: "Kategori Peneltian",
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

                $("#slsStatusPen").append(html);
                $("#slsStatusPen").selectpicker("refresh");
                $("#slsKategori").append(html);
                $("#slsKategori").selectpicker("refresh");
            },
            error: function (xhr) {
                alert(xhr.responseText);
            }
        });

        $("#slsStatusPen").on("change", function () {
            t.search($(this).val(), "Status");
        });
        $("#slsKategori").on("change", function () {
            t.search($(this).val(), "Kategori");
        });
    }
};
