@extends('public.index')
@section('title', 'Penelitian')
@section('content')
<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Tambah Prosedur Penelitian
                            </h3>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right" id="formTambahProsedur">

                    <div class="m-form__content">
                        <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="msgProsedur">
                            <div class="m-alert__icon">
                                <i class="la la-warning"></i>
                            </div>
                            <div class="m-alert__text">
                                Mohon maaf, Silahkan cek kembali form ini lagi :)
                            </div>
                            <div class="m-alert__close">
                                <button type="button" class="close" data-close="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__body">

                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Kategori <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <input type="text" value="{{$kategori}}" class="form-control m-input" id="tbxKategori" disabled="disable">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Judul Penelitian <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <input type="text" id="tbxJudul" class="form-control m-input" required>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Hewan <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control m-select2" id="slsHewan" name="slsHewan" required></select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Jumlah Hewan <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <input type="number" id="tbxJumlah" name="tbxJumlah" class="form-control m-input" required>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Perlakuan <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <textarea type="text" class="form-control m-input" id="tbxPerlakuan" name="tbxPerlakuan" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Parameter Uji <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <textarea type="text" class="form-control m-input" id="tbxParameter" name="tbxParameter" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Desain Penelitian <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <textarea type="text" class="form-control m-input" id="tbxDesain" name="tbxDesain" rows="4" required></textarea>
                            </div>
                        </div>
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                            </div>
                        </div>
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Durasi Penelitian
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Durasi Tahap 1 <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <input type="number" id="tbxDurasi1" name="tbxDurasi1" class="form-control m-input" required>
                            </div>
                            Hari
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Durasi Tahap 2 <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <input type="number" id="tbxDurasi2" name="tbxDurasi2" class="form-control m-input" required>
                            </div>
                            Hari
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Durasi Tahap 3 <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <input type="number" id="tbxDurasi3" name="tbxDurasi3" class="form-control m-input" required>
                            </div>
                            Hari
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
                        <div class="m-form__actions m-form__actions">
                            <div class="row">
                                <div class="col-lg-9 ml-lg-auto">
                                    <button onclick="JavaScript: window.history.back(1); return false;" class="btn btn-secondary">
                                        Batal
                                    </button>
                                    <button type="submit" id="btnTambah" class="btn btn-success">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>
</div>
<input type="hidden" value="{{$idPen}}" id="idPenelitian">
<input type="hidden" value="{{$idKategori}}" id="idKategori">
<script src="{{asset('assets/app/js/prosedur/tambah.js')}}" type="text/javascript"></script>
@endsection
