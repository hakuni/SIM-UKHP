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
            })
        },
        SuccessRoute: function (message, url) {
            swal({
                    title: "Success!",
                    text: message,
                    type: "success"
                })
                .then(function (isConfirm) {
                    if (isConfirm)
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
                localStorage.removeItem('namaUser');
                location.href = "/Login";
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
    }
}

jQuery(document).ready(function () {
    $.ajaxSetup({
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader("Authorization", "Bearer " + App.GetCookie("token"));
        },
        xhrFields: {
            withCredentials: true
        },
        // crossDomain: true
    })

    if (localStorage.getItem('role') == 2) {
        //hide sesuatu
        $("#Kategori").hide();
        $("#Layanan").hide();
        $("#Pengguna").hide();
        $("#Role").hide();
    }
    if (localStorage.getItem('role') == 3) {
        //hide sesuatu
        $("#Kategori").hide();
        $("#Layanan").hide();
        $("#Pengguna").hide();
        $("#Role").hide();
    }
    if (localStorage.getItem('role') == 4) {
        //hide sesuatu
        $("#Kategori").hide();
        $("#Layanan").hide();
        $("#Pengguna").hide();
        $("#Role").hide();
    }

    $("#nama").html(localStorage.getItem('namaUser'));
    $("#jabatan").html(localStorage.getItem('namaRole'));

    App.SidebarTag();
});
