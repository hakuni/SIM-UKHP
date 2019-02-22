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
        ConfirmDelete: function (message) {
            swal({
                title: "Anda yakin?",
                text: message,
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yakin, hapus ini!"
            }).then(function (e) {
                // if (isConfirm)
                e.value && swal("Deleted!", "Your file has been deleted.", "success")
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
}

jQuery(document).ready(function () {
    //turn active in sidebar
    var path = window.location.pathname;
    path2 = path.split('/')[2];
    path3 = path.split('/')[3];
    $('.sidebarActive').each(function () {
        if (path3 != null) {
            if (this.id == path3) {
                $(this).addClass('m-menu__item--active').siblings().removeClass("m-menu__item--active");
            }
        } else if (this.id == path2)
            $(this).addClass('m-menu__item--active').siblings().removeClass("m-menu__item--active");
    })
});
