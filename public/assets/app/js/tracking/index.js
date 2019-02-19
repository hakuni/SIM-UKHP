var id = 0;
//== Class Initialization
jQuery(document).ready(function() {
    $("#sidebarHide").hide();
    Page.Init();
});

var Page = {
    Init: function() {
        Get.ListPenelitian();
        $("#listPenelitian").on("click", "div.divShowDetail", function(e) {
            var idPen = this.id;
            console.log(idPen);
            $(this)
                .css({
                    background: "whitesmoke"
                })
                .siblings()
                .css({
                    background: "transparent"
                });
            $(this)
                .addClass("selected")
                .siblings()
                .removeClass("selected");
            Get.DetailPenelitian(idPen);
        });
    }
};

var Get = {
    ListPenelitian: function() {
        var link = "/Tracking/List";
        console.log(link);
        $.ajax({
            url: link,
            type: "GET",
            success: function(data) {
                $("#listPenelitian").html(data);
                id = $("#idPenelitian").val();
                Get.DetailPenelitian(id);
            },
            error: function() {
                alert("error");
            }
        });
    },
    DetailPenelitian: function(id) {
        var link = "/Tracking/Detail/" + id;
        console.log(link);
        $.ajax({
            url: link,
            type: "GET",
            success: function(data) {
                $("#detailPenelitian").html(data);

                $("#btnMaximize").on("click", function() {
                    $("#sidebarShow").show();
                    $("#detailPenelitian").removeClass("col-lg-11");
                    $("#hideList").addClass("col-lg-4");
                    $("#sidebarHide").removeClass("col-lg-1");
                    $("#sidebarHide").hide();
                });
                $("#btnMinimize").on("click", function() {
                    $("#sidebarShow").hide();
                    $("#detailPenelitian").addClass("col-lg-11");
                    $("#hideList").removeClass("col-lg-4");
                    $("#sidebarHide").addClass("col-lg-1");
                    $("#sidebarHide").show();
                });
            },
            error: function() {
                alert("error");
            }
        });
    }
};
