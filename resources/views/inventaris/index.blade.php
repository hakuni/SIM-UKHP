@extends('public.index')
@section('title', 'Inventaris')
@section('content')

<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption col-lg-8">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                List Alat dan Bahan
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-caption col-lg-4">
                        <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                            <span>
                                <i class="fa fa-file"></i>
                                <span>
                                    Eksport File
                                </span>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <ul class="nav nav-pills nav-fill nav-pills--warning" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#stockList">
                                Stock
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#pembelianList">
                                Pembelian
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#penggunaanList">
                                Penggunaan
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="stockList" role="tabpanel">
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="form-group m-form__group row align-items-center">
                                            <div class="col-md-5">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label class="m-label m-label--single">
                                                            <span>
                                                                Bulan:
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-bootstrap-select" id="slsBulan"></select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label class="m-label m-label--single">
                                                            <span>
                                                                Tahun:
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-bootstrap-select" id="slsTahun"></select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Search Form -->
                            <!--begin: Datatable -->
                            <div class="m_datatable" id="divStockList"></div>
                        </div>
                        <div class="tab-pane" id="pembelianList" role="tabpanel">
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="form-group m-form__group row align-items-center">
                                            <div class="col-md-5">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label class="m-label m-label--single">
                                                            <span>
                                                                Bulan:
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-bootstrap-select" id="slsBulan"></select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label class="m-label m-label--single">
                                                            <span>
                                                                Tahun:
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-bootstrap-select" id="slsTahun"></select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal form pembelian -->
                                    <div class="modal hide fade" id="formPembelian" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Pembelian Alat dan Bahan
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
                                                            Tipe Alat dan Bahan <strong style="color:red" ;>*</strong> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <input data-switch="true" type="checkbox" checked="checked"
                                                                data-on-text="Hewan" data-handle-width="70"
                                                                data-off-text="Bukan" data-on-color="info" id="btnTipe">
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Alat dan Bahan <strong style="color:red" ;>*</strong> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <select class="form-control m-select2" id="slsAlatBahan" style="width:550px">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Tanggal Pembelian <strong style="color:red" ;>*</strong> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control m-input datepicker"
                                                                    id="tbxTanggalPembelian" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Jumlah <span style="color:red">*</span> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <input type="number" id="tbxJumlahBeli" class="form-control m-input"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Harga <span style="color:red">*</span> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <input type="number" id="tbxHargaBeli" class="form-control m-input"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="button" class="btn btn-success" id="btnTambahPembelian">
                                                        Tambah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- button modal -->
                                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                        <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                            id="btnPembelian" data-toggle="modal" data-target="#formPembelian">
                                            <span>
                                                <i class="fa fa-plus"></i>
                                                <span>
                                                    Tambah Alat dan Bahan
                                                </span>
                                            </span>
                                        </a>
                                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="m_datatable" id="divPembelianList"></div>
                        </div>
                        <div class="tab-pane" id="penggunaanList" role="tabpanel">
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                                <div class="row align-items-center">
                                    <div class="col-xl-8 order-2 order-xl-1">
                                        <div class="form-group m-form__group row align-items-center">
                                            <div class="col-md-5">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label class="m-label m-label--single">
                                                            <span>
                                                                Bulan:
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-bootstrap-select" id="slsBulan"></select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="m-form__group m-form__group--inline">
                                                    <div class="m-form__label">
                                                        <label class="m-label m-label--single">
                                                            <span>
                                                                Tahun:
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="m-form__control">
                                                        <select class="form-control m-bootstrap-select" id="slsTahun"></select>
                                                    </div>
                                                </div>
                                                <div class="d-md-none m--margin-bottom-10"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- modal form penggunaan -->
                                    <div class="modal hide fade" id="formPenggunaan" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">
                                                        Penggunaan Alat dan Bahan
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
                                                            Alat dan Bahan <strong style="color:red" ;>*</strong> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <select class="form-control m-select2" id="slsAlatBahanGuna" style="width:550px">
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Tanggal Penggunaan <strong style="color:red" ;>*</strong> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control m-input datepicker"
                                                                    id="tbxTanggalPenggunaan" />
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-calendar"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-form-label col-lg-3 col-sm-12">
                                                            Jumlah <span style="color:red">*</span> :
                                                        </label>
                                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                                            <input type="number" id="tbxJumlahPenggunaan" class="form-control m-input"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                        Batal
                                                    </button>
                                                    <button type="button" class="btn btn-success" id="btnTambahPenggunaan">
                                                        Tambah
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- button modal -->
                                    <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                        <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                            id="btnPenggunaan" data-toggle="modal" data-target="#formPenggunaan">
                                            <span>
                                                <i class="fa fa-plus"></i>
                                                <span>
                                                    Tambah Penggunaan
                                                </span>
                                            </span>
                                        </a>
                                        <div class="m-separator m-separator--dashed d-xl-none"></div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Search Form -->
                            <!--begin: Datatable -->
                            <div class="m_datatable" id="divPenggunaanList"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/app/js/inventaris/index.js')}}" type="text/javascript"></script>
@endsection
