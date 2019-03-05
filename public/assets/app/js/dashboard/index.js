jQuery(document).ready(function () {
    GetData.Init();
    Grafik.Init();
});

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
        $.each(data, function(index, item){
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
        $.each(data, function(index, item){
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

        var pemasukan = [0,0,0,0,0,0,0,0,0,0,0,0]

        $.each(data, function(index, item){
            pemasukan[item.bulan-1] = item.pemasukan;
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
        },{
            "bulan": "Apr",
            "pemasukan": pemasukan[3]
        },{
            "bulan": "Mei",
            "pemasukan": pemasukan[4]
        },{
            "bulan": "Jun",
            "pemasukan": pemasukan[5]
        },{
            "bulan": "Jul",
            "pemasukan": pemasukan[6]
        },{
            "bulan": "Aug",
            "pemasukan": pemasukan[7]
        },{
            "bulan": "Sep",
            "pemasukan": pemasukan[8]
        },{
            "bulan": "Okt",
            "pemasukan": pemasukan[9]
        },{
            "bulan": "Nov",
            "pemasukan": pemasukan[10]
        },{
            "bulan": "Des",
            "pemasukan": pemasukan[11]
        },];

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
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("hewan", am4charts.XYChart);
        
        chart.data = [];
        $.each(data, function(index, item){
            var params = {
                hewan: item.namaAlatBahan,
                jumlah: item.hewan
            }
            chart.data.push(params);
        })
        // Add data
        // chart.data = [{
        //     "hewan": "Tikus",
        //     "bulan1": 1,
        //     "bulan2": 1,
        //     "bulan3": 2,
        //     "bulan4": 2,
        //     "bulan5": 1,
        //     "bulan6": 1,
        // }, {
        //     "hewan": "Mencit",
        //     "bulan1": 1,
        //     "bulan2": 1,
        //     "bulan3": 1,
        //     "bulan4": 1,
        //     "bulan5": 1,
        //     "bulan6": 1,
        // }, {
        //     "hewan": "Kelinci",
        //     "bulan1": 1,
        //     "bulan2": 1,
        //     "bulan3": 1,
        //     "bulan4": 2,
        //     "bulan5": 1,
        //     "bulan6": 2,
        // }];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "hewan";
        categoryAxis.title.text = "Hewan";
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
            series.dataFields.categoryX = "hewan";
            series.name = name;
            series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
            series.stacked = stacked;
            series.columns.template.width = am4core.percent(95);
        }
        // createSeries("bulan1", "Jan", false);
        if(data[0].bulan<=6){
            createSeries("bulan1", "Jan", false);
            createSeries("bulan2", "Feb", true);
            createSeries("bulan3", "Mar", true);
            createSeries("bulan4", "Apr", true);
            createSeries("bulan5", "Mei", true);
            createSeries("bulan6", "Jun", true);
        }
        else{
            createSeries("bulan1", "Jul", false);
            createSeries("bulan2", "Ags", true);
            createSeries("bulan3", "Sep", true);
            createSeries("bulan4", "Okt", true);
            createSeries("bulan5", "Nov", true);
            createSeries("bulan6", "Des", true);
        }

        // Add legend
        chart.legend = new am4charts.Legend();
    },
    HewanDetail: function (data) {
        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("hewan", am4charts.XYChart);
        
        chart.data = [];
        var jumlah = [0,0,0,0,0,0];
        $.each(data, function(i, hewan){
            jumlah[((hewan.bulan) % 6)-1] = hewan.banyak;
            console.log("garok")
        })
        // loop data
        $.each(data, function(index, item){
            // loop banyak hewan
            var params = {
                hewan: item.namaAlatBahan,
                bulan1: jumlah[0],
                bulan2: jumlah[1],
                bulan3: jumlah[2],
                bulan4: jumlah[3],
                bulan5: jumlah[4],
                bulan6: jumlah[5],
            }
            console.log(params)
            chart.data.push(params);
        })
        
        // Add data
        // chart.data = [{
        //     "hewan": "Tikus",
        //     "bulan1": 1,
        //     "bulan2": 1,
        //     "bulan3": 2,
        //     "bulan4": 2,
        //     "bulan5": 1,
        //     "bulan6": 1,
        // }, {
        //     "hewan": "Mencit",
        //     "bulan1": 1,
        //     "bulan2": 1,
        //     "bulan3": 1,
        //     "bulan4": 1,
        //     "bulan5": 1,
        //     "bulan6": 1,
        // }, {
        //     "hewan": "Kelinci",
        //     "bulan1": 1,
        //     "bulan2": 1,
        //     "bulan3": 1,
        //     "bulan4": 2,
        //     "bulan5": 1,
        //     "bulan6": 2,
        // }];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "hewan";
        categoryAxis.title.text = "Hewan";
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
            series.dataFields.categoryX = "hewan";
            series.name = name;
            series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
            series.stacked = stacked;
            series.columns.template.width = am4core.percent(95);
        }
        if(data[0].bulan<=6){
            createSeries("bulan1", "Jan", false);
            createSeries("bulan2", "Feb", true);
            createSeries("bulan3", "Mar", true);
            createSeries("bulan4", "Apr", true);
            createSeries("bulan5", "Mei", true);
            createSeries("bulan6", "Jun", true);
        }
        else{
            createSeries("bulan1", "Jul", false);
            createSeries("bulan2", "Ags", true);
            createSeries("bulan3", "Sep", true);
            createSeries("bulan4", "Okt", true);
            createSeries("bulan5", "Nov", true);
            createSeries("bulan6", "Des", true);
        }

        // Add legend
        chart.legend = new am4charts.Legend();
    }
};

var GetData = {
    Init: function(){
        GetData.Kategori();
        GetData.Penggunaan();
        GetData.Keuangan();
        GetData.Hewan();
    },
    Kategori: function () {
        $.ajax({
            url: "/api/dashboard/kategori",
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
            url: "/api/dashboard/penggunaan",
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
            url: "/api/dashboard/pemasukan",
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
    Hewan: function(){
        $.ajax({
            url: "/api/dashboard/banyakHewan",
            type: 'GET',
            success: function (data) {
                Grafik.Hewan(data);
                console.log(data);
            },
            error: function () {
                alert("error");
                console.log("eror");
            }
        });
    }
};
