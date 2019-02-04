var FormWidgets = function() {
    var r;
    return {
        init: function() {
            ! function() {
                $("#m_datepicker").datepicker({
                    todayHighlight: !0,
                    templates: {
                        leftArrow: '<i class="la la-angle-left"></i>',
                        rightArrow: '<i class="la la-angle-right"></i>'
                    }
                }), $("#m_datetimepicker").datetimepicker({
                    pickerPosition: "bottom-left",
                    todayHighlight: !0,
                    autoclose: !0,
                    format: "yyyy.mm.dd hh:ii"
                }), $("#m_datetimepicker").change(function() {
                    r.element($(this))
                }), $("#m_timepicker").timepicker({
                    minuteStep: 1,
                    showSeconds: !0,
                    showMeridian: !0
                }), $("#m_daterangepicker").daterangepicker({
                    buttonClasses: "m-btn btn",
                    applyClass: "btn-primary",
                    cancelClass: "btn-secondary"
                }, function(e, t, i) {
                    var a = $("#m_daterangepicker").find(".form-control");
                    a.val(e.format("YYYY/MM/DD") + " / " + t.format("YYYY/MM/DD")), r.element(a)
                }), $("[data-switch=true]").bootstrapSwitch(), $("[data-switch=true]").on("switchChange.bootstrapSwitch", function() {
                    r.element($(this))
                }), $("#m_bootstrap_select").selectpicker(), $("#m_bootstrap_select").on("changed.bs.select", function() {
                    r.element($(this))
                }), $("#m_select2").select2({
                    placeholder: "Select a state"
                }), $("#m_select2").on("select2:change", function() {
                    r.element($(this))
                });
                var e = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    prefetch: "https://keenthemes.com/metronic/preview/inc/api/typeahead/countries.json"
                });
                $("#m_typeahead").typeahead(null, {
                    name: "countries",
                    source: e
                }), $("#m_typeahead").bind("typeahead:select", function(e, t) {
                    r.element($("#m_typeahead"))
                })
            }(), r = $("#m_form_1").validate({
                rules: {
                    date: {
                        required: !0,
                        date: !0
                    },
                    daterange: {
                        required: !0
                    },
                    datetime: {
                        required: !0
                    },
                    time: {
                        required: !0
                    },
                    select: {
                        required: !0,
                        minlength: 2,
                        maxlength: 4
                    },
                    select2: {
                        required: !0
                    },
                    typeahead: {
                        required: !0
                    },
                    switch: {
                        required: !0
                    },
                    markdown: {
                        required: !0
                    }
                },
                invalidHandler: function(e, t) {
                    var i = $("#m_form_1_msg");
                    i.removeClass("m--hide").show(), mApp.scrollTo(i, -200)
                },
                submitHandler: function(e) {}
            })
        }
    }
}();
jQuery(document).ready(function() {
    FormWidgets.init()
});