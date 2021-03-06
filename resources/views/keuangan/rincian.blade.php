@extends('public.index')
@section('title', 'Keuangan')
@section('content')

<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet m-portlet--tabs">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <div class="m-portlet__head-text ">
                                <a href="/Keuangan" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                    style="padding-left:15px; padding-right:15px"">
                                    <i class="
                                    fa fa-arrow-left"></i>
                                </a>
                            </div>
                            <h3 class="m-portlet__head-text col-lg-4">
                                Rincian Keuangan |
                                <small class="m-portlet__head-caption" id="biodata"></small>
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <ul class="nav nav-tabs m-tabs-line m-tabs-line--success m-tabs-line--2x m-tabs-line--right"
                            role="tablist">
                            <li class="nav-item m-tabs__item">
                                <a class="nav-link m-tabs__link active" data-toggle="tab" href="#rincianTab" role="tab">
                                    Rincian
                                </a>
                            </li>
                            <li class="nav-item m-tabs__item">
                                <a id="tabLog" class="nav-link m-tabs__link" data-toggle="tab" href="#logTab" role="tab">
                                    Log
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="rincianTab" role="tabpanel">
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                <div class="row align-items-center">
                                    <!-- modal rincian -->
                                    <div class="modal hide" id="formRincian" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Tambah Rincian
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">
                                                            &times;
                                                        </span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Tahapan <strong style="color:red" ;>*</strong> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <select class="form-control m-select2" id="slsMilestone"
                                                                style="width:550px">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- header -->
                                                    <div class="form-group m-form__group row" style="padding-bottom:0px">
                                                        <div class="col-lg-5">
                                                            <label class="col-form-label">
                                                                Alat dan Bahan <strong style="color:red" ;>*</strong> :
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="col-form-label">
                                                                Jumlah <strong style="color:red" ;>*</strong> :
                                                            </label>
                                                        </div>
                                                        <div class="col-lg-3">
                                                            <label class="col-form-label">
                                                                Faktor Pengali <strong style="color:red" ;>*</strong> :
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="formRepeat">
                                                        <div data-repeater-list="" class="col-lg-12 ui-sortable">
                                                            <div data-repeater-item class="form-group m-form__group row align-items-center" style="display:none">
                                                                <div class="col-lg-5" style="padding-left:0px">
                                                                    <select class="form-control m-select2 slsAlatBahan infinityInput notInit"
                                                                            style="width:240px" id="slsAlatBahan">
                                                                    </select>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="number" id="tbxJumlah" class="form-control m-input tbxJumlah infinityInput"
                                                                            required>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="text" class="form-control m-input tbxKeterangan infinityInput"
                                                                            required>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <div data-repeater-delete="" class="btn btn-outline-danger m-btn m-btn--icon m-btn--pill">
                                                                        <i class="la la-trash-o"></i>
                                                                    </div>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                            </div>
                                                            <div data-repeater-item class="form-group m-form__group row align-items-center divRepeat">
                                                                <div class="col-lg-5" style="padding-left:0px">
                                                                    <select class="form-control m-select2 slsAlatBahan infinityInput notInit"
                                                                            style="width:240px" id="slsAlatBahan">
                                                                    </select>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="number" id="tbxJumlah" class="form-control m-input tbxJumlah infinityInput"
                                                                            required>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                                <div class="col-lg-3">
                                                                    <input type="text" class="form-control m-input tbxKeterangan infinityInput"
                                                                            required>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                                <div class="col-lg-1">
                                                                    <div data-repeater-delete="" class="btn btn-outline-danger m-btn m-btn--icon m-btn--pill">
                                                                        <i class="la la-trash-o"></i>
                                                                    </div>
                                                                    <div class="d-md-none m--margin-bottom-10"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="m--align-right col-lg 6">
                                                            <div data-repeater-create="" class="btn btn-brand m-btn m-btn--icon m-btn--pill">
                                                                <i class="la la-plus"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="tutup" class="btn btn-secondary" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="button" class="btn btn-success" id="btnTambah">
                                                        Tambah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal hide fade" id="formEditRincian" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Ubah Rincian
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">
                                                            &times;
                                                        </span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Milestone :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <label class="col-form-label col-lg-3 col-sm-12" id="txtMilestone">Persiapan</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Alat dan Bahan <strong style="color:red" ;>*</strong> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <select class="form-control m-select2" id="slsAlatBahanUbah"
                                                                style="width:550px">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Jumlah <span style="color:red">*</span> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <input type="number" id="tbxJumlahUbah" class="form-control m-input"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="button" class="btn btn-primary" id="btnUbah">
                                                        Ubah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- btn eksport/ tambah rincian -->
                                    <div class="col-xl-12 order-2 order-xl-1 m--align-right">
                                        <div class="form-group m-form__group row align-items-center">
                                            <div class="col-xl-6 order-1 order-xl-2 m--align-right">
                                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                                            </div>
                                            <div class="col-xl-3 order-1 order-xl-2 m--align-right">
                                                <a href="/Keuangan/Biaya/{{$id}}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                    <span>
                                                        <i class="fa fa-file"></i>
                                                        <span>
                                                            Eksport
                                                        </span>
                                                    </span>
                                                </a>
                                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                                            </div>
                                            @if($statusPenelitian == 1)
                                            <div class="col-xl-3 order-1 order-xl-2 m--align-right">
                                                <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                                    id="btnRincian" data-toggle="modal" data-target="#formRincian">
                                                    <span>
                                                        <i class="fa fa-plus"></i>
                                                        <span>
                                                            Tambah Rincian
                                                        </span>
                                                    </span>
                                                </a>
                                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m_datatable" id="divRincianList"></div>
                        </div>
                        <div class="tab-pane" id="logTab" role="tabpanel">
                            <div class="m_datatable" id="divLogList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="{{$id}}" id="idPenelitian">
<input type="hidden" value="{{$statusPenelitian}}" id="statusPenelitian">
<script src="{{asset('assets/app/js/keuangan/rincian.js')}}" type="text/javascript"></script>
@endsection
