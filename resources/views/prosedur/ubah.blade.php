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
								Ubah Prosedur Penelitian
							</h3>
						</div>
					</div>
                </div>
                <!--begin::Form-->
                <form class="m-form m-form--fit m-form--label-align-right" id="formUbahProsedur">

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
                                <input type="text" class="form-control m-input" id="tbxKategori" disabled="disable">
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Judul Penelitian <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <input type="text" value="{{$prosedur['judulPenelitian']}}" id="tbxJudul" class="form-control m-input" required>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Hewan <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <select class="form-control m-select2" id="slsHewan" required></select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Keterangan Hewan <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <input type="text" value="{{$prosedur['keteranganHewan']}}" id="tbxKeterangan" name="tbxKeterangan" class="form-control m-input" required>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Perlakuan <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <textarea type="text" class="form-control m-input" id="tbxPerlakuan" name="tbxPerlakuan" rows="4" required>{{$prosedur['perlakuan']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Parameter Uji <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <textarea type="text" class="form-control m-input" id="tbxParameter" name="tbxParameter" rows="4" required>{{$prosedur['parameterUji']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Desain Penelitian <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-6">
                                <textarea type="text" class="form-control m-input" id="tbxDesain" name="tbxDesain" rows="4" required>{{$prosedur['desainPenelitian']}}</textarea>
                            </div>
                        </div>
                        <div class="m-form__group form-group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Etik Hewan :
                            </label>
                            <div class="col-lg-9 col-md-9 col-sm-12 m-radio-inline" style="padding-left:20px; padding-top:5px">
                                @if($prosedur['etikHewan'] == 1)
                                    @php ($checked1 = 'checked')
                                    @php ($checked2 = '')
                                @else
                                    @php($checked1 = '')
                                    @php ($checked2 = 'checked')
                                @endif
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="etikHewan" value="1" id="ya" {{$checked1}}>
                                    Ya
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="etikHewan" value="0" id="tidak" {{$checked2}}>
                                    Tidak
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="m-form__group form-group row">
                            @if($prosedur['laporan'] == 1)
                                @php ($checked1 = 'checked')
                                @php ($checked2 = '')
                            @else
                                @php($checked1 = '')
                                @php ($checked2 = 'checked')
                            @endif
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Laporan :
                            </label>
                            <div class="col-lg-9 col-md-9 col-sm-12 m-radio-inline" style="padding-left:20px; padding-top:5px">
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="laporan" value="1" id="ya" {{$checked1}}>
                                    Ya
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="laporan" value="0" id="tidak" {{$checked2}}>
                                    Tidak
                                    <span></span>
                                </label>
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
                                Pemeliharaan :
                            </label>
                            <div class="col-lg-2" style="padding-right:0px">
                                <input type="number" value="{{$prosedur['tahap1']}}" id="tbxDurasi1" name="tbxDurasi1" class="form-control m-input">
                            </div><div class="col-lg-6 m-radio-inline" style="padding-left:20px; padding-top:5px">
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="pemeliharaan" value="1" id="hari" checked>
                                    Hari
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="pemeliharaan" value="0" id="minggu">
                                    Minggu
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Perlakuan :
                            </label>
                            <div class="col-lg-2" style="padding-right:0px">
                                <input type="number" value="{{$prosedur['tahap2']}}" id="tbxDurasi2" name="tbxDurasi2" class="form-control m-input">
                            </div>
                            <div class="col-lg-6 m-radio-inline" style="padding-left:20px; padding-top:5px">
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="perlakuan" value="1" id="hari" checked>
                                    Hari
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="perlakuan" value="0" id="minggu">
                                    Minggu
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Analisis :
                            </label>
                            <div class="col-lg-2" style="padding-right:0px">
                                <input type="number" value="{{$prosedur['tahap3']}}" id="tbxDurasi3" name="tbxDurasi3" class="form-control m-input">
                            </div>
                            <div class="col-lg-6 m-radio-inline" style="padding-left:20px; padding-top:5px">
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="analisis" value="1" id="hari" checked>
                                    Hari
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="analisis" value="0" id="minggu">
                                    Minggu
                                    <span></span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Pembuatan Laporan :
                            </label>
                            <div class="col-lg-2" style="padding-right:0px">
                                <input type="number" value="{{$prosedur['tahap4']}}" id="tbxDurasi4" name="tbxDurasi4" class="form-control m-input">
                            </div>
                            <div class="col-lg-6 m-radio-inline" style="padding-left:20px; padding-top:5px">
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="durasiLaporan" value="1" id="hari" checked>
                                    Hari
                                    <span></span>
                                </label>
                                <label class="m-radio m-radio--solid m-radio--success">
                                    <input type="radio" name="durasiLaporan" value="0" id="minggu">
                                    Minggu
                                    <span></span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__foot m-portlet__foot--fit">
						<div class="m-form__actions m-form__actions">
							<div class="row">
								<div class="col-lg-9 ml-lg-auto">
									<button onclick="JavaScript: window.history.back(1); return false;" class="btn btn-secondary">
										Batal
									</button>
									<button id="btnUbah" class="btn btn-primary">
										Ubah
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
<input type="hidden" value="{{$prosedur['idProsedur']}}" id="idProsedur">
<input type="hidden" value="{{$prosedur['idKategori']}}" id="idKategori">
<input type="hidden" value="{{$prosedur['idAlatBahan']}}" id="idAlatBahan">
<script src="{{asset('assets/app/js/prosedur/ubah.js')}}" type="text/javascript"></script>
@endsection
