@extends('public.index')
@section('title', 'Penelitian')
@section('content')
    <div class="m-content">
	<div class="row">
		<div class="col-lg-12">
			<!--begin::Portlet-->
			<div class="m-portlet">
				<div class="m-portlet__head">
					<div class="m-portlet__head-caption col-lg-4">
						<div class="m-portlet__head-title">
							<div class="m-portlet__head-text ">
                                <a href="/Penelitian" class="fa fa-arrow-left"></a>
                            </div>
							<h3 class="m-portlet__head-text">
								Prosedur Penelitian
							</h3>
						</div>
                    </div>
                    <div class="m-portlet__head-caption col-lg-4">
                        <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="btnEksport">
                            <span>
                                <i class="fa fa-edit"></i>
                                <span>
                                    Eksport File
                                </span>
                            </span>
                        </a>
                    </div>
                    <div class="m-portlet__head-caption col-lg-4">
                        <a href="/UbahProsedur/{{$idPenelitian}}/{{$idProsedur}}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" id="btnUbahProsedur">
                            <span>
                                <i class="fa fa-edit"></i>
                                <span>
                                    Ubah Prosedur
                                </span>
                            </span>
                        </a>
                    </div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="formTambahProsedur">

					<div class="m-form__content">
						<div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="msgFail">
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
								<select class="form-control m-select2" id="slsKategori" disabled="disabled"></select>
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-form-label col-lg-3 col-sm-12">
								Judul Penelitian <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6">
								<input type="text" id="tbxJudul" class="form-control m-input" disabled="disabled">
							</div>
                        </div>
                        <div class="form-group m-form__group row">
							<label class="col-form-label col-lg-3 col-sm-12">
								Hewan <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6">
								<select class="form-control m-select2" id="slsHewan" disabled="disabled"></select>
							</div>
						</div>
                        <div class="form-group m-form__group row">
							<label class="col-form-label col-lg-3 col-sm-12">
								Jumlah Hewan <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6">
								<input type="number" id="tbxJumlah" class="form-control m-input" disabled="disabled">
							</div>
						</div>
						<div class="form-group m-form__group row">
							<label class="col-form-label col-lg-3 col-sm-12">
								Perlakuan <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6">
								<textarea type="text" class="form-control m-input" id="tbxPerlakuan" rows="4" disabled="disabled"></textarea>
							</div>
                        </div>
                        <div class="form-group m-form__group row">
							<label class="col-form-label col-lg-3 col-sm-12">
								Parameter Uji <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6">
								<textarea type="text" class="form-control m-input" id="tbxParameter" rows="4" disabled="disabled"></textarea>
							</div>
                        </div>
                        <div class="form-group m-form__group row">
							<label class="col-form-label col-lg-3 col-sm-12">
								Desain Penelitian <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6">
								<textarea type="text" class="form-control m-input" id="tbxDesain" rows="4" disabled="disabled"></textarea>
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
<input type="hidden" value="{{$idPenelitian}}" id="idPenelitian">
<input type="hidden" value="{{$idProsedur}}" id="idProsedur">
<script src="{{asset('assets/app/js/prosedur/index.js')}}" type="text/javascript"></script>
@endsection
