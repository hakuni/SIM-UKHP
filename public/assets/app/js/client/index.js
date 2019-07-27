jQuery(document).ready(function () {
    Control.Init();
});

Control = {
    Init: function () {
        $("#btnLacak").on("click", function () {
            if ($.trim($("#tbxResi").val()) != "") {
                var btn = $("#btnLacak");

                btn.addClass("m-loader m-loader--right m-loader--light").attr(
                    "disabled",
                    true
                );
                Reset.Init();
                $.ajax({
                        url: "/api/clientTrack/" + $("#tbxResi").val(),
                        type: "GET"
                    })
                    .done(function (data, textStatus, jqXHR) {
                        $("#judulPenelitian").html(data[0].judulPenelitian);
                        $("#namaKategori").html(data[0].namaKategori);
                        $("#biodata").html(data[0].namaPeneliti + " / " + data[0].instansiPeneliti);
                        $.each(data, function (i, item) {
                            var img = "assets/app/media/img/logos/process.gif";
                            if (item.status == 1) {
                                img = "assets/app/media/img/logos/success.png";
                            }
                            if (item.idMilestone == null) {
                                document.getElementById("prosedur").src = img;
                            }
                            if (item.idMilestone == 2) {
                                document.getElementById("persiapan").src = img;
                            }
                            if (item.idMilestone == 3) {
                                document.getElementById("pengujian").src = img;
                                if (item.status == 1 && item.statusPembayaran == "LUNAS") {
                                    $("#btnHasil").show();
                                }
                            }
                            if (item.idMilestone == 4) {
                                document.getElementById("analisis").src = img;
                                if (item.status == 1 && item.statusPembayaran == "LUNAS") {
                                    document.getElementById("selesai").src = img;
                                    $("#btnData").show();
                                }
                            }
                        });
                        $("#divHome").hide();
                        $("#divLacak").show();
                        Button.Init(data[0].idPenelitian);
                        btn.removeClass(
                            "m-loader m-loader--right m-loader--light"
                        ).attr("disabled", false);
                    })
                    .fail(function (jqXHR, textStatus, errorThrown) {
                        Common.Alert.Error(jqXHR.responseJSON.message);
                        btn.removeClass(
                            "m-loader m-loader--right m-loader--light"
                        ).attr("disabled", false);
                    });
            } else{
                Common.Alert.Warning("Kode resi tidak boleh kosong");
                return;
            }
        });
    }
};

Button = {
    Init: function (idPenelitian) {
        Button.Hasil(idPenelitian);
        Button.Data(idPenelitian);
    },
    Hasil: function (idPenelitian) {
        $("#btnHasil").on("click", function () {
            location.href = "/AnalisisPenelitian/" + idPenelitian;
        });
    },
    Data: function (idPenelitian) {
        $("#btnData").on("click", function () {
            location.href = "/DataPenelitian/" + idPenelitian;
        });
    }
};

Reset = {
    Init: function () {
        document.getElementById("prosedur").src =
            "assets/app/media/img//logos/success.png";
        document.getElementById("persiapan").src =
            "assets/app/media/img//logos/error.png";
        document.getElementById("pengujian").src =
            "assets/app/media/img//logos/error.png";
        document.getElementById("analisis").src =
            "assets/app/media/img//logos/error.png";
        document.getElementById("selesai").src =
            "assets/app/media/img//logos/error.png";
        $("#btnHasil").hide();
        $("#btnData").hide();
    }
};
