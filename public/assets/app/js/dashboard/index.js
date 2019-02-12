jQuery(document).ready(function () {
    Grafik.Init();
});

var Grafik = {
    Init: function () {
        Grafik.Kategori();
        Grafik.Penggunaan();
        Grafik.Keuangan();
        Grafik.Hewan();
    },
    Kategori: function () {
        // Themes begin
        am4core.useTheme(am4themes_frozen);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("kategori", am4charts.PieChart);

        // Add data
        chart.data = [{
                kategoriPen: "Diabetes",
                jumlah: 15
            },
            {
                kategoriPen: "Melitus",
                jumlah: 9
            }
        ];

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
    Penggunaan: function () {
        var chart = am4core.create("penggunaan", am4charts.PieChart);

        // Add data
        chart.data = [{
                hewan: "Tikus",
                jumlah: 15
            },
            {
                hewan: "Mencit",
                jumlah: 9
            },
            {
                hewan: "Zebrafish",
                jumlah: 4
            }
        ];

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
    Keuangan: function () {
        // Themes begin
        am4core.useTheme(am4themes_frozen);
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("keuangan", am4charts.XYChart);

        // Add data
        chart.data = [{
            "tahun": "2016",
            "pengeluaran": 100,
            "pemasukan": 500
        }, {
            "tahun": "2017",
            "pengeluaran": 100,
            "pemasukan": 200
        }, {
            "tahun": "2018",
            "pengeluaran": 200,
            "pemasukan": 300
        }];

        // Create category axis
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.title.text = "Tahun";
        categoryAxis.dataFields.category = "tahun";

        // Create value axis
        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "Uang (Ribu Rupiah)";
        valueAxis.renderer.minLabelPosition = 0.1;

        // Create dot / bullet
        var pengeluaran = chart.series.push(new am4charts.LineSeries());
        pengeluaran.dataFields.valueY = "pengeluaran";
        pengeluaran.dataFields.categoryX = "tahun";
        pengeluaran.name = "Pengeluaran";
        pengeluaran.strokeWidth = 3;
        pengeluaran.tooltipText = "{name} tahun {categoryX}: {valueY}";
        pengeluaran.legendSettings.valueText = "{valueY}";
        pengeluaran.visible = false;
        var dot = pengeluaran.bullets.push(new am4charts.Bullet());
        var kotak = dot.createChild(am4core.Rectangle);
        kotak.width = 10;
        kotak.height = 10;
        kotak.horizontalCenter = "middle";
        kotak.verticalCenter = "middle";

        var pemasukan = chart.series.push(new am4charts.LineSeries());
        pemasukan.dataFields.valueY = "pemasukan";
        pemasukan.dataFields.categoryX = "tahun";
        pemasukan.name = 'Pemasukan';
        pemasukan.strokeWidth = 3;
        pemasukan.bullets.push(new am4charts.CircleBullet());
        pemasukan.tooltipText = "{name} tahun {categoryX}: {valueY}";
        pemasukan.legendSettings.valueText = "{valueY}";

        // Add chart cursor
        chart.cursor = new am4charts.XYCursor();
        chart.cursor.behavior = "zoomX";

        // Add legend
        chart.legend = new am4charts.Legend();
    },
    Hewan: function () {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("hewan", am4charts.XYChart);

        // Add data
        chart.data = [{
            "tahun": "2016",
            "tikus": 5,
            "mencit": 4,
            "zebrafish": 2
        }, {
            "tahun": "2017",
            "tikus": 6,
            "mencit": 3,
            "zebrafish": 1
        }, {
            "tahun": "2018",
            "tikus": 4,
            "mencit": 2,
            "zebrafish": 1
        }];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "tahun";
        categoryAxis.title.text = "Tahun";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 20;
        categoryAxis.renderer.cellStartLocation = 0.1;
        categoryAxis.renderer.cellEndLocation = 0.9;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.min = 0;
        valueAxis.title.text = "Jumlah";

        // Create series
        function createSeries(field, name, stacked) {
            var series = chart.series.push(new am4charts.ColumnSeries());
            series.dataFields.valueY = field;
            series.dataFields.categoryX = "tahun";
            series.name = name;
            series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
            series.stacked = stacked;
            series.columns.template.width = am4core.percent(95);
        }

        createSeries("tikus", "Tikus", false);
        createSeries("mencit", "Mencit", false);
        createSeries("zebrafish", "Zebrafish", false);

        // Add legend
        chart.legend = new am4charts.Legend();
    }
};

var GetData = {
    Init: function (startDate, endDate) {
        GetData.Resources(startDate, endDate);
    },
    Resources: function (startDate, endDate) {
        var projectID = $("#slsProjectName").val();
        $.ajax({
            url: "/DashboardPM/Resources/",
            type: "GET",
            data: {
                ProjectID: projectID,
                StartDate: startDate,
                EndDate: endDate
            },
            success: function (data) {
                $("#resources").html(data);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(errorThrown);
            }
        });
    }
};
