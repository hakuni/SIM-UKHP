<!DOCTYPE html>
@section('title', 'Client')
<html lang="en" >
	<!-- begin::Head -->
	<head>
		@include('public.head')
	</head>
	<!-- end::Head -->
    <!-- end::Body -->
	<body  class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default"  >
		<!-- begin:: Page -->
		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-grid--tablet-and-mobile m-grid--hor-tablet-and-mobile m-login m-login--1 m-login--signin" id="m_login">
				<div class="m-grid__item m-grid__item--order-tablet-and-mobile-2 m-login__aside">
					<div class="m-stack m-stack--hor m-stack--desktop">
						<div class="m-stack__item m-stack__item--fluid">
							<div class="m-login__wrapper">
								<div class="m-login__logo">
									<a href="#">
                                        <img alt="" src="{{asset('assets/app/media/img//logos/client.png')}}" style="width:350px; height:150px" />
										<!-- <img src="../../../assets/app/media/img//logos/logo-2.png"> -->
									</a>
								</div>
								<div class="m-login__signin">
									<!-- <div class="m-login__head">
										<h3 class="m-login__title">
											SIM-UKHP
										</h3>
									</div> -->
									<form class="m-form m-form--fit" action="">

										<div class="form-group m-form__group row">
                                            <label class="col-form-label col-lg-5 col-sm-12">
                                                Kode Resi :
                                            </label>
											<input class="form-control m-input" type="text" placeholder="Masukkan Kode Resi" id="tbxResi" autocomplete="off">
										</div>
										<div class="row m-login__form-sub">
                                            <div class="col-lg-4">

                                            </div>
											<div class="col-lg-4">
												<button id="btnLacak" class="btn btn-primary btn-m m-btn m-btn--icon m-btn--pill m-btn--air" style="margin-left:10px; margin-right:10px">
                                                    <span>
                                                        <i class="la la-send"></i>
                                                        <span>
                                                            Lacak
                                                        </span>
                                                    </span>
                                                </button>
                                            </div>
                                            <div class="col-lg-4">

                                            </div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
                </div>
                <div id="divHome" class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url({{ URL::asset('assets/app/media/img//bg/biofarmaka.jpg') }})">

                </div>
				<div id="divLacak" class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-grid__item--order-tablet-and-mobile-1	m-login__content" style="background-image: url({{ URL::asset('assets/app/media/img//bg/biofarmaka1.jpg') }}); padding-top:30px; padding-bottom:30px; padding-left:20px; padding-right:20px; display:none">
					<div class="m-grid__item m-grid__item--middle">
                        <h3 style="color:white" id="judulPenelitian">
                        </h3>
                        <h5 style="color: white" id="namaKategori">
                        </h5>
						<p class="m-login__msg" id="biodata">
						</p>
                    </div>
                    <br>
                    <div class="m-widget4">
                        <div class="m-widget4__item" style="border-bottom:0px;padding-bottom:0px">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img id="prosedur" src="{{asset('assets/app/media/img//logos/success.png')}}" alt="">
                            </div>
                            <div class="m-widget4__text">
                                <h5 style="color:white;margin-top:12px; margin-left:20px">Pembuatan Prosedur</h5>
                            </div>
                        </div>
                        <div class="m-widget4__item" style="border-bottom:0px;padding-bottom:0px">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img id="persiapan" src="{{asset('assets/app/media/img//logos/error.png')}}" alt="">
                            </div>
                            <div class="m-widget4__text">
                                <h5 style="color:white;margin-top:12px; margin-left:20px">Pemeliharaan</h5>
                            </div>
                        </div>
                        <div class="m-widget4__item" style="border-bottom:0px;padding-bottom:0px">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img id="pengujian" src="{{asset('assets/app/media/img//logos/error.png')}}" alt="">
                            </div>
                            <div class="m-widget4__text">
                                <h5 style="color:white;margin-top:12px; margin-left:20px">Perlakuan</h5>
                            </div>
                        </div>
                        <div class="m-widget4__item" style="border-bottom:0px;padding-bottom:0px">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img id="analisis" src="{{asset('assets/app/media/img//logos/error.png')}}" alt="">
                            </div>
                            <div class="m-widget4__text">
                                <h5 style="color:white;margin-top:12px; margin-left:20px">Analisis</h5>
                            </div>
                        </div>
                        <div class="m-widget4__item" style="border-bottom:0px;padding-bottom:0px">
                            <div class="m-widget4__img m-widget4__img--logo">
                                <img id="selesai" src="{{asset('assets/app/media/img//logos/error.png')}}" alt="">
                            </div>
                            <div class="m-widget4__text">
                                <h5 style="color:white;margin-top:12px; margin-left:20px">Selesai</h5>
                            </div>
                        </div>
                    </div>
                    <br>
                    <br>
                     <br>
                    <div class="row">
                        <div class="col-lg-8" id="data" syle="margin-right:5px">
                            <button  class="btn btn-primary btn-m m-btn m-btn--icon m-btn--pill m-btn--air" id="btnData" style="margin-right: 10px; display:none">
                                <span>
                                    <i class="la la-download"></i>
                                    <span>
                                        Data Penelitian
                                    </span>
                                </span>
                            </button>
                        </div>
                        <div class="col-lg-4" id="hasil">
                            <button class="btn btn-success btn-m m-btn m-btn--icon m-btn--pill m-btn--air" id="btnHasil" style="margin-right: 10px; display:none">
                                <span>
                                    <i class="la la-download"></i>
                                    <span>
                                        Hasil Penelitian
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<!-- end:: Page -->
    	<!--begin::Base Scripts -->
		<script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
		<script src="{{asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
		<!--end::Base Scripts -->
        <!--begin::Page Snippets -->
        <script src="{{asset('assets/app/js/common.js')}}" type="text/javascript"></script>
        <script src="{{asset('assets/app/js/client/index.js')}}" type="text/javascript"></script>
		<!--end::Page Snippets -->
	</body>
	<!-- end::Body -->
</html>
