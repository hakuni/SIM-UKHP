var Common = {
    //Check Error
    CheckError: {
        Object: function (data) {
            console.log(data);
            if (data.ErrorType == 0) {
                return true;
            } else if (data.ErrorType == 1) {
                Common.Alert.Warning(data.ErrorMessage);
                return false;
            } else if (data.ErrorType == 2) {
                Common.Alert.Error(data.ErrorMessage);
                return false;
            }
        },
        List: function (data) {
            if (data.length > 0) {
                if (data[0].ErrorType == 0) {
                    return true;
                } else if (data[0].ErrorType == 1) {
                    Common.Alert.Warning(data[0].ErrorMessage);
                    return false;
                } else if (data[0].ErrorType == 2) {
                    Common.Alert.Error(data[0].ErrorMessage);
                    return false;
                }
            }
            return true
        }
    },
    Alert: {
        Error: function (message) {
            swal({
                title: "Error!",
                text: message,
                type: "error",
            })
        },
        ErrorRoute: function (message, url) {
            swal({
                    title: "Error!",
                    text: message,
                    type: "error",
                })
                .then(function (isConfirm) {
                    if (isConfirm)
                        window.location.href = url;
                })
        },
        Warning: function (message) {
            swal({
                title: "Warning!",
                text: message,
                type: "warning",
            })
        },
        Success: function (message) {
            swal({
                title: "Success!",
                text: message,
                type: "success",
                showConfirmButton: !1,
                timer:1500,
            })
        },
        SuccessRoute: function (message, url) {
            swal({
                    title: "Success!",
                    text: message,
                    type: "success",
                    showConfirmButton: !1,
                    timer:1500,
                })
                .then(function () {
                    window.location.href = url;
                })
        },
        PromptRedirect: function (message, url) {
            swal({
                    title: 'Anda yakin untuk pindah halaman?',
                    text: message,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes'
                })
                .then(function (isConfirm) {
                    if (isConfirm)
                        window.location.href = url;
                });
        }
    },
    Format: {
        Date(data) {
            var date = new Date(data)
            var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            return (parseInt(date.getDate()) < 10 ? "0" + date.getDate() : date.getDate()) + "-" + monthNames[date.getMonth()] + "-" + date.getFullYear();
        },
        DateHour: function (data) {
            var date = new Date(data);
            return date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
        },
        CommaSeparation: function (yourNumber) {
            //Seperates the components of the number
            var n = parseFloat(yourNumber).toFixed(2).toString().split(".");
            //Comma-fies the first part
            n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            //Combines the two sections
            return n.join(".");
        },
    }
};

var App = {
    Logout: function () {
        $.ajax({
                url: "/api/logout",
                type: "POST",
                cache: false
            })
            .done(function (data, textStatus, jqXHR) {
                document.cookie = "token=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                localStorage.removeItem('idUser');
                localStorage.removeItem('namaUser');
                localStorage.removeItem('role');
                localStorage.removeItem('namaRole');
                location.href = "/Logout";
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    GetCookie: function (cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    },
    SidebarTag: function () {
        //turn active in sidebar
        var path = window.location.pathname;
        path2 = path.split('/')[1];
        $('.sidebarActive').each(function () {
            if (this.id == path2) {
                document.getElementById(this.id).setAttribute("style", "background-color:#716aca");
            }
        })
    },
    ModalAkun: function () {
        var id = localStorage.getItem('idUser');
        $.ajax({
                url: "/api/user/" + id,
                type: "GET",
                dataType: "json",
            })
            .done(function (data, textStatus, jqXHR) {
                $("#tbxNamaProfil").val(data.namaUser);
                $("#tbxEmailProfil").val(data.email);
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    },
    SaveAkun: function () {
        params = {
            id: localStorage.getItem('idUser'),
            email: $("#tbxEmailProfil").val(),
            namaUser: $("#tbxNamaProfil").val(),
            password: $("#tbxPassProfil").val()
        }
        $.ajax({
            url: '/api/user/',
            type: "PUT",
            data: JSON.stringify(params),
            dataType: 'json',
            contentType: "application/json",
            cache: false,
            success: function (data, textStatus, jqXHR) {
                $("#formProfil").modal("toggle");
                Common.Alert.Success('Berhasil mengubah data')
            },
            error: function (jqXHR, textStatus, errorThrown) {

            }
        })
    },
    Notif: function () {
        var cek = document.getElementsByClassName("notifAktif")[0];
        var warna = "primary";
        // m_topbar_notification_icon
        $.ajax({
                url: "/api/user/notifikasi/0",
                type: "GET",
            })
            .done(function (data, textStatus, jqXHR) {
                $("#listNotifMulai").html();
                if (data.length == 0) {
                    $("#listNotifMulai").append('Tidak ada pemberitahuan')
                } else {
                    cek.id = "m_topbar_notification_icon";
                    $("#titik").show();
                    $("#jmlPenelitian").html(data[0].total + " Penelitian");
                    $.each(data, function (i, item) {
                        if (item.idMilestone == 1) {
                            warna = "warning";
                        }
                        $("#listNotifMulai").append('<div class="m-list-timeline__item"> <span class="m-list-timeline__badge"></span> <span class="m-list-timeline__text"> ' + item.namaPeneliti + ' <span class="m-badge m-badge--' + warna + ' m-badge--wide"> ' + item.namaKategori + ' </span> </span> <span class="m-list-timeline__time"> ' + item.durasi + ' Hari </span> </div>');
                    });
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });

        $.ajax({
                url: "/api/user/notifikasi/1",
                type: "GET",
            })
            .done(function (data, textStatus, jqXHR) {
                $("#listNotifTelat").html();
                if (data.length == 0) {
                    $("#listNotifTelat").append('Tidak ada pemberitahuan')
                } else {
                    cek.id = "m_topbar_notification_icon";
                    $("#titik").show();
                    $("#jmlPenelitian").html(data[0].total + " Penelitian");
                    $.each(data, function (i, item) {
                        $("#listNotifTelat").append('<div class="m-list-timeline__item"> <span class="m-list-timeline__badge"></span> <span class="m-list-timeline__text"> ' + item.namaPeneliti + ' <span class="m-badge m-badge--primary m-badge--wide"> ' + item.namaKategori + ' </span> </span> <span class="m-list-timeline__time"> ' + item.durasi + ' Hari </span> </div>');
                    });
                }
            })
            .fail(function (jqXHR, textStatus, errorThrown) {
                Common.Alert.Error(errorThrown);
            });
    }

}

jQuery(document).ready(function () {
    $.ajaxSetup({
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Authorization", "Bearer " + localStorage.getItem("token"));
        },
        xhrFields: {
            withCredentials: true
        },
        // crossDomain: true
    });
    if (localStorage.getItem('role') == 1 || localStorage.getItem('role') == 4) {
        $(".ukhp").show();
        $(".inven").show();
        $(".master").show();
    }
    // if (localStorage.getItem('role') == 2) {
    // }
    if (localStorage.getItem('role') == 3) {
        $(".ukhp").show();
    }
    if (localStorage.getItem('role') == 5) {
        $(".inven").show();
    }

    $("#nama").html(localStorage.getItem('namaUser'));
    $("#jabatan").html(localStorage.getItem('namaRole'));

    App.SidebarTag();

    $.ajax({
        url: '/api/cekToken',
        type: 'GET',
        success: function () {
            App.Notif();
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

    $('#btnProfilUser').on('click', function () {
        $('#btnProfilUser').addClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            true
        );
        App.SaveAkun();
        $('#btnProfilUser').removeClass("m-loader m-loader--right m-loader--light").attr(
            "disabled",
            false
        );
    })
});
