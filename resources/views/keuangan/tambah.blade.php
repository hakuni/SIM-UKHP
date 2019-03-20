@extends('public.index')
@section('title', 'Keuangan')
@section('content')

<div class="m-content">
    <div class="m-portlet__body">
                        <div class="m-form__section m-form__section--first">
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-sm-2">
                                    <label>Step to Procedure</label>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Expected Result</label>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Actual Result</label>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-sm-1">
                                    <label>Status</label>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-sm-2">
                                    <label class="m--align-center">Description</label>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Severity</label>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                                <div class="col-sm-1">
                                    <label>Delete</label>
                                    <div class="d-md-none m--margin-bottom-10"></div>
                                </div>
                            </div>
                            <div id="formCreateBug">
                                <div class="form-group m-form__group row" id="draggable">
                                    <div data-repeater-list="" class="col-lg-12 ui-sortable" id="dragBug">
                                        <div data-repeater-item class="form-group m-form__group align-items-center" style="display:none">
                                            <div class="form-group m-form__group row align-items-center dragDiv">
                                                <div class="col-sm-2">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <textarea type="text" class="form-control m-input infinityInput" placeholder="Step to Procedure" name="tbxProcedure" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <textarea type="text" class="form-control m-input infinityInput exRes" placeholder="Expected Result" name="tbxExResult" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <textarea type="text" class="form-control m-input infinityInput acRes" placeholder="Actual Result" name="tbxAcResult" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <select class="form-control m-select2 infinityInput notInit slsStatus" name="slsStatus" required> </select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <textarea type="text" class="form-control m-input infinityInput" placeholder="Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <select class="form-control m-select2 slsSeverity notInit infinityInput" id="slsSeverity" name="slsSeverity" required></select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a data-repeater-delete="" href="#" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill">
                                                        <i class="la la-trash-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div data-repeater-item class="form-group m-form__group align-items-center divHead">
                                            <div class="form-group m-form__group row align-items-center dragDiv">
                                                <div class="col-sm-2">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <textarea type="text" class="form-control m-input infinityInput" placeholder="Step to Procedure" name="tbxProcedure" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <textarea type="text" class="form-control m-input infinityInput exRes" placeholder="Expected Result" name="tbxExResult" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <textarea type="text" class="form-control m-input infinityInput acRes" placeholder="Actual Result" name="tbxAcResult" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <select class="form-control m-select2 infinityInput notInit slsStatus" name="slsStatus" required> </select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="m-form__group m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <textarea type="text" class="form-control m-input infinityInput" placeholder="Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <div class="m-form__group--inline">
                                                        <div class="m-form__control">
                                                            <select class="form-control m-select2 slsSeverity notInit infinityInput" id="slsSeverity" name="slsSeverity" required></select>
                                                        </div>
                                                    </div>
                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <a data-repeater-delete="" href="#" class="btn btn-outline-danger m-btn m-btn--icon m-btn--icon-only m-btn--outline-2x m-btn--pill">
                                                        <i class="la la-trash-o"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6" style="padding-left: 5px;">
                                        <label for="inputFile" class="btn btn btn-sm m-btn m-btn--icon m-btn--pill">
                                            <span>
                                                <input id="inputFile" type="file" />
                                            </span>
                                        </label>
                                    </div>
                                    <div class="m--align-right col-lg 6">
                                        <div data-repeater-create="" class="btn btn btn-sm btn-brand m-btn m-btn--icon m-btn--pill m-btn--wide">
                                            <span>
                                                <i class="la la-plus"></i>
                                                <span>
                                                    Add
                                                </span>
                                            </span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
</div>

<script>
    jQuery(document).ready(function () {
        Repeat();
    });
    function Repeat() {
        Select.Init();
        $("#formCreateBug").repeater({
            initEmpty: !1,
            defaultValues: {
                "text-input": "foo"
            },
            show: function () {
                $(this).slideDown();
                $(this).addClass("divHead");
                Select.Init();
            },
            hide: function (e) {
                $(this).slideUp(e)
            }
        })
    };
    var Select = {
        Init: function () {
            var select = $(".slsSeverity");
            select.each(function (index, item) {
                var ths = $(this);
                //autofill severity from db
                if (ths.hasClass("notInit")) {
                    Select.Fill(ths);
                }
            })
        },
        Fill: function (ths) {
            $.ajax({
                    url: "/api/inventarisasi?tipe=0",
                    type: "GET"
                })
                .done(function (data, textStatus, jqXHR) {
                    ths.html("");
                    $.each(data, function (i, item) {
                        if(i == 0){
                            ths.append("<option value='' selected style='display:none'>" + "Pilih Alat Bahan" + "</option>");
                            ths.append("<option value='" + item.idAlatBahan + "'>" + item.namaAlatBahan + "</option>");
                        }
                        ths.append("<option value='" + item.idAlatBahan + "'>" + item.namaAlatBahan + "</option>");
                    });
                    ths.removeClass("notInit");
                    ths.selectpicker('refresh');
                })
                .fail(function (jqXHR, textStatus, errorThrown) {
                    Common.Alert.Error(errorThrown);
                });
        }
};

</script>
@endsection
