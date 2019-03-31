<!DOCTYPE html>
<!--
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
Renew Support: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->

<html lang="en">
<!-- begin::Head -->

<head>
    @include('public.head')
    <!--begin::Base Scripts -->
    <script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
    <!--end::Base Scripts -->
    <!--begin::Page Vendors -->
    <script src="{{asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript">
    </script>
    <!--end::Page Vendors -->
    <!--begin::Page Snippets -->
    <!-- <script src="{{asset('assets/app/js/dashboard.js')}}" type="text/javascript"></script> -->
    <script src="{{asset('assets/app/js/common.js')}}" type="text/javascript"></script>
    <!--end::Page Snippets -->
</head>
<!-- end::Head -->
<!-- end::Body -->

<body
    class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <!-- BEGIN: Header -->
        @include('public.header')
        <!-- END: Header -->
        <div class="modal hide fade" id="formProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Ubah Pengguna
                        </h5>
                        <button type="button" class="close closebtn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                &times;
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Email <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="email" id="tbxEmailProfil" class="form-control m-input" required>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Nama <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="text" id="tbxNamaProfil" class="form-control m-input" required>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Role <strong style="color:red" ;>*</strong> :
                            </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <select class="form-control m-select2 role" id="slsRoleProfil"
                                    style="width:550px"></select>
                            </div>
                        </div>
                        <div class="form-group m-form__group row">
                            <label class="col-form-label col-lg-3 col-sm-12">
                                Kata Sandi :
                            </label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input type="password" id="tbxPassProfil" class="form-control m-input">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary closebtn" data-dismiss="modal">
                            Batal
                        </button>
                        <button type="button" class="btn btn-primary" id="btnProfilUser">
                            Ubah
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- begin::Body -->
        <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
            <!-- BEGIN: Left Aside -->
            @include('public.sidebar')
            <!-- END: Left Aside -->
            <div class="m-grid__item m-grid__item--fluid m-wrapper">
                @yield('content')
            </div>
        </div>
        <!-- end:: Body -->
        <!-- begin::Footer -->
        @include('public.footer')
        <!-- end::Footer -->
    </div>
    <!-- end:: Page -->
    <!-- begin::Quick Sidebar -->

    <!-- end::Quick Sidebar -->
    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
        <i class="la la-arrow-up"></i>
    </div>
    <!-- end::Scroll Top -->
    <!-- begin::Quick Nav -->
    <!-- begin::Quick Nav -->
</body>
<!-- end::Body -->

</html>
