// var date = new Date();
// $("tbxTahunHewan").val(date.getYear());
jQuery(document).ready(function () {
    GetData.Init();
    Grafik.Init();
    Control.Init();
});

var GetData = {
    Init: function () {
        GetData.Kategori();
        GetData.Penggunaan();
        GetData.Keuangan();
        GetData.Hewan();
    },
    Kategori: function () {
        $.ajax({
            url: "/api/dashboard/kategori?tahun=" + $("#tbxTahunKategori").val(),
            type: 'GET',
            success: function (data) {
                Grafik.Kategori(data);
            },
            error: function () {
                alert("error");
                console.log("eror");
            }
        });
    },
    Penggunaan: function () {
        $.ajax({
            url: "/api/dashboard/penggunaan?tahun=" + $("#tbxTahunGuna").val(),
            type: 'GET',
            success: function (data) {
                Grafik.Penggunaan(data);
            },
            error: function () {
                alert("error");
                console.log("eror");
            }
        });
    },
    Keuangan: function () {
        $.ajax({
            url: "/api/dashboard/pemasukan?tahun=" + $("#tbxTahunKeu").val(),
            type: 'GET',
            success: function (data) {
                Grafik.Keuangan(data);
                // console.log(data[0].pemasukan);
            },
            error: function () {
                alert("error");
                console.log("eror");
            }
        });
    },
    Hewan: function () {
        $.ajax({
            url: "/api/dashboard/banyakHewan?periode=6&tahun=" + $("#tbxTahunHewan").val(),
            type: 'GET',
            success: function (data) {
                Grafik.HewanPeriode(data);
                console.log(data);
            },
            error: function () {
                alert("error");
                console.log("eror");
            }
        });
    }
};

var Grafik = {
    Init: function () {
        // Grafik.Hewan();
    },
    Kategori: function (data) {
        // Themes begin
        am4core.useTheme(am4themes_frozen);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("kategori", am4charts.PieChart);

        // Add data
        chart.data = []
        //loop
        $.each(data, function (index, item) {
            var params = {
                kategoriPen: item.namaKategori,
                jumlah: item.banyakPenelitian
            }
            chart.data.push(params);
        })

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "jumlah";
        pieSeries.dataFields.category = "kategoriPen";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.labels.template.disabled = true;
        pieSeries.ticks.template.disabled = true;

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

        chart.legend = new am4charts.Legend();
    },
    Penggunaan: function (data) {
        var chart = am4core.create("penggunaan", am4charts.PieChart);

        // Add data
        chart.data = []
        //loop
        $.each(data, function (index, item) {
            var params = {
                hewan: item.namaAlatBahan,
                jumlah: item.banyakPenelitian
            }
            chart.data.push(params);
        })

        // Add and configure Series
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "jumlah";
        pieSeries.dataFields.category = "hewan";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.labels.template.disabled = true;
        pieSeries.ticks.template.disabled = true;

        // This creates initial animation
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;

        chart.legend = new am4charts.Legend();
    },
    Keuangan: function (data) {
        // Themes begin
        am4core.useTheme(am4themes_frozen);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("keuangan", am4charts.XYChart);

        var pemasukan = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]

        $.each(data, function (index, item) {
            pemasukan[item.bulan - 1] = item.pemasukan;
        })

        // Add data
        chart.data = [{
            "bulan": "Jan",
            "pemasukan": pemasukan[0]
        }, {
            "bulan": "Feb",
            "pemasukan": pemasukan[1]
        }, {
            "bulan": "Mar",
            "pemasukan": pemasukan[2]
        }, {
            "bulan": "Apr",
            "pemasukan": pemasukan[3]
        }, {
            "bulan": "Mei",
            "pemasukan": pemasukan[4]
        }, {
            "bulan": "Jun",
            "pemasukan": pemasukan[5]
        }, {
            "bulan": "Jul",
            "pemasukan": pemasukan[6]
        }, {
            "bulan": "Aug",
            "pemasukan": pemasukan[7]
        }, {
            "bulan": "Sep",
            "pemasukan": pemasukan[8]
        }, {
            "bulan": "Okt",
            "pemasukan": pemasukan[9]
        }, {
            "bulan": "Nov",
            "pemasukan": pemasukan[10]
        }, {
            "bulan": "Des",
            "pemasukan": pemasukan[11]
        }, ];

        // Create category axis
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.title.text = "Bulan";
        categoryAxis.dataFields.category = "bulan";

        // Create value axis
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Uang";
        valueAxis.renderer.minLabelPosition = 0.1;

        // Create dot / bullet
        var pemasukan = chart.series.push(new am4charts.LineSeries());
        pemasukan.dataFields.valueY = "pemasukan";
        pemasukan.dataFields.categoryX = "bulan";
        pemasukan.name = 'Pemasukan';
        pemasukan.strokeWidth = 3;
        pemasukan.bullets.push(new am4charts.CircleBullet());
        pemasukan.tooltipText = "{name} bulan {categoryX}: {valueY}";
        pemasukan.legendSettings.valueText = "{valueY}";

        // Add chart cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "zoomX";

        // Add legend
        chart.legend = new am4charts.Legend();
    },
    HewanPeriode: function (data) {
        // Themes begin
        am4core.useTheme(am4themes_frozen);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("hewan", am4charts.XYChart);

        // Add data
        chart.data = []
        //loop
        $.each(data, function (index, item) {
            var params = {
                hewan: item.namaAlatBahan,
                jumlah: item.banyak
            }
            chart.data.push(params);
        })

        // Create axes

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "hewan";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        categoryAxis.renderer.labels.template.adapter.add("dy", function (dy, target) {
            if (target.dataItem && target.dataItem.index & 2 == 2) {
                return dy + 25;
            }
            return dy;
        });

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "jumlah";
        series.dataFields.categoryX = "hewan";
        series.name = "Hewan";
        series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        series.columns.template.fillOpacity = .8;

        var columnTemplate = series.columns.template;
        columnTemplate.strokeWidth = 2;
        columnTemplate.strokeOpacity = 1;
    },
    HewanDetail: function (data) {
        // Themes begin
        am4core.useTheme(am4themes_frozen);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("hewan", am4charts.XYChart);

        // Add data
        var banyak = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]

        $.each(data, function (index, item) {
            banyak[item.bulan - 1] = item.banyak;
        })

        // Add data
        chart.data = [{
            "bulan": "Jan",
            "banyak": banyak[0]
        }, {
            "bulan": "Feb",
            "banyak": banyak[1]
        }, {
            "bulan": "Mar",
            "banyak": banyak[2]
        }, {
            "bulan": "Apr",
            "banyak": banyak[3]
        }, {
            "bulan": "Mei",
            "banyak": banyak[4]
        }, {
            "bulan": "Jun",
            "banyak": banyak[5]
        }, {
            "bulan": "Jul",
            "banyak": banyak[6]
        }, {
            "bulan": "Aug",
            "banyak": banyak[7]
        }, {
            "bulan": "Sep",
            "banyak": banyak[8]
        }, {
            "bulan": "Okt",
            "banyak": banyak[9]
        }, {
            "bulan": "Nov",
            "banyak": banyak[10]
        }, {
            "bulan": "Des",
            "banyak": banyak[11]
        }, ];

        // Create axes

        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "bulan";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        categoryAxis.renderer.labels.template.adapter.add("dy", function (dy, target) {
            if (target.dataItem && target.dataItem.index & 2 == 2) {
                return dy + 25;
            }
            return dy;
        });

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "banyak";
        series.dataFields.categoryX = "bulan";
        series.name = "Bulan";
        series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        series.columns.template.fillOpacity = .8;

        var columnTemplate = series.columns.template;
        columnTemplate.strokeWidth = 2;
        columnTemplate.strokeOpacity = 1;
    }
};

var Control = {
    Init: function () {
        Control.SelectHewan();
        Control.FilterKategori();
        Control.FilterPenggunaan();
        Control.FilterKeuangan();
        Control.FilterHewan();
    },
    SelectHewan: function () {
        $.ajax({
                url: "/api/inventarisasi?tipe=1",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsHewan").html("<option value=0>Semua Hewan</option>");
                $.each(data, function (i, item) {
                    $("#slsHewan").append(
                        "<option value='" +
                        item.idAlatBahan +
                        "'>" +
                        item.namaAlatBahan +
                        "</option>"
                    );
                });
                $("#slsHewan").select2({
                    placeholder: "Pilih Hewan"
                });
                $("#slsPeriode").select2();
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    FilterKategori: function () {
        $("#btnFilterKategori").on("click", function () {
            var btn = $("#btnFilterKategori");

            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );
            GetData.Kategori();
            btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                false
            );
        })
    },
    FilterPenggunaan: function () {
        $("#btnFilterPenggunaan").on("click", function () {
            var btn = $("#btnFilterPenggunaan");

            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );
            GetData.Penggunaan();
            btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                false
            );
        })
    },
    FilterKeuangan: function () {
        $("#btnFilterKeuangan").on("click", function () {
            var btn = $("#btnFilterKeuangan");

            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );
            GetData.Keuangan();
            btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                false
            );
        })
    },
    FilterHewan: function () {
        $("#btnFilterHewan").on("click", function () {
            var btn = $("#btnFilterHewan");

            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );
            if ($("#slsHewan").val() == 0) {
                GetData.Hewan();
                btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                    "disabled",
                    false
                );
            } else {
                $.ajax({
                    url: "/api/dashboard/detailHewan?idAlatBahan=" + $("#slsHewan").val() + "&periode=" + $("#slsPeriode").val() + "&tahun=" + $("#tbxTahunHewan").val(),
                    type: "GET",
                    success: function (data) {
                        // console.log(data);
                        Grafik.HewanDetail(data);
                        btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                            "disabled",
                            false
                        );
                    },
                    error: function () {
                        btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                            "disabled",
                            false
                        );
                        alert("error");
                        console.log("eror");
                    }
                })
            }
        })
    }
};
