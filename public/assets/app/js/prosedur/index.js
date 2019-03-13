var id = $("#idPenelitian").val();
//== Class Initialization
jQuery(document).ready(function () {
    Control.Init();
    // Transaction.Download(id);
});

var Control = {
    Init: function () {
        Control.GetKategori();
        Control.GetHewan();
    },
    GetKategori: function () {
        $.ajax({
                url: "/api/kategori/" + $("#idKategori").val(),
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#tbxKategori").val(data.namaKategori)
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    GetHewan: function () {
        $.ajax({
                url: "/api/inventarisasi/" + $("#idAlatBahan").val(),
                type: "GET"
            })
            .done(function (data, textStatus, jqXHR) {
                $("#tbxHewan").val(data.namaAlatBahan)
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    SelectHewan: function () {
        $.ajax({
                url: "/api/inventarisasi?tipe=1",
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

var Transaction = {
    Download: function (id) {
        $("#btnEksport").on("click", function () {
            var btn = $("#btnEksport");

            btn.addClass("m-loader m-loader--right m-loader--light").attr(
                "disabled",
                true
            );

            $.ajax({
                    url: "/api/export/" + id,
                    type: "GET"
                })
                .done(function (data, textStatus, jqXHR) {
                    Common.Alert.Success("Berhasil diunduh");
                    btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                        "disabled",
                        false
                    );
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    Common.Alert.Error(errorThrown);
                    btn.removeClass("m-loader m-loader--right m-loader--light").attr(
                        "disabled",
                        false
                    );
                });
        })
    }
}
