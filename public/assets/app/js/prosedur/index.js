var id = $("#idPenelitian").val();
//== Class Initialization
jQuery(document).ready(function () {
    Form.Init();
    Control.Init();
});

var Form = {
    Init: function () {
        $.ajax({
                url: "/api/prosedur/" + id,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                Control.SelectKategori(data.data.idKategori),
                    $("#tbxJudul").val(data.data.judulPenelitian),
                    Control.SelectHewan(data.data.idAlatBahan),
                    $("#tbxJumlah").val(data.data.jumlahHewan),
                    $("#tbxPerlakuan").val(data.data.perlakuan),
                    $("#tbxParameter").val(data.data.parameterUji),
                    $("#tbxDesain").val(data.data.desainPenelitian)
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
}

var Control = {
    Init: function () {
        Control.GetKategori();
        Control.GetHewan();
    },
    GetKategori: function () {
        $.ajax({
                url: "/api/kategori",
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                Control.SelectKategori(data.idKategori);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    GetHewan: function () {
        $.ajax({
                url: "/api/inventarisasi/1",
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                Control.SelectHewan(data.idAlatBahan);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    SelectKategori: function () {
        $.ajax({
                url: "/api/kategori",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsKategori").html("<option></option>");
                $.each(data, function (i, item) {
                    $("#slsKategori").append("<option value='" + item.idKategori + "' selected>" + item.namaKategori + "</option>");
                });
                $("#slsKategori").select2({
                    placeholder: "Pilih Kategori"
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    SelectHewan: function () {
        $.ajax({
                url: "/api/inventarisasi/1",
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#slsHewan").html("<option></option>");
                $.each(data, function (i, item) {
                    $("#slsHewan").append("<option value='" + item.idAlatBahan + "' selected>" + item.namaAlatBahan + "</option>");
                });
                $("#slsHewan").select2({
                    placeholder: "Pilih Hewan"
                });
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }
};
