@extends('public.index')
@section('title', 'Keuangan')
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
								Tambah Pembayaran Penelitian
							</h3>
						</div>
					</div>
				</div>
				<!--begin::Form-->
				<form class="m-form m-form--fit m-form--label-align-right" id="formTambahPembayaran">

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
								Kategori <strong style="color:red" ;>*</strong>:
							</label>
							<div class="col-lg-6">
								<select class="form-control m-select2" id="slsKategori" required></select>
							</div>
						</div>
                        <div class="form-group m-form__group row">
							<label class="col-form-label col-lg-3 col-sm-12">
								Tanggal Pembayaran <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6 col-md-9 col-sm-12">
								<div class="input-group date">
									<input type="text" class="form-control m-input datepicker" id="tbxTanggalPembayaran" />
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
								Bayar <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6">
								<input type="number" id="tbxBayar" class="form-control m-input" required>
							</div>
                        </div>
                        <div class="form-group m-form__group row">
							<label class="col-form-label col-lg-3 col-sm-12">
								Sisa <strong style="color:red" ;>*</strong> :
							</label>
							<div class="col-lg-6">
								<input type="number" id="tbxSisa" class="form-control m-input" required>
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
									<button id="btnTambah" class="btn btn-success">
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

<script src="{{asset('assets/app/js/keuangan/tambah.js')}}" type="text/javascript"></script>
@endsection
