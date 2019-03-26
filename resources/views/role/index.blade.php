@extends('public.index')
@section('title', 'Role')
@section('content')

<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Daftar Role
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    <div class="col-md-5">

                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                    <div class="col-md-5">

                                        <div class="d-md-none m--margin-bottom-10"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal tambah role -->
                            <div class="modal hide fade" id="formTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Tambah Role
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
                                                    Nama Role <strong style="color:red" ;>*</strong> :
                                                </label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" id="tbxRole" class="form-control m-input"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="button" class="btn btn-success" id="btnTambahRole">
                                                Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal ubah role -->
                            <div class="modal hide fade" id="formUbah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Ubah Role
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
                                                    Nama Role <strong style="color:red" ;>*</strong> :
                                                </label>
                                                <div class="col-lg-9 col-md-9 col-sm-12">
                                                    <input type="text" id="tbxRoleUbah" class="form-control m-input"
                                                        required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                Batal
                                            </button>
                                            <button type="button" class="btn btn-primary" id="btnUbahRole">
                                                Ubah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- btn tambah role -->
                            <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                    id="btnTambah" data-toggle="modal" data-target="#formTambah">
                                    <span>
                                        <i class="fa fa-plus"></i>
                                        <span>
                                            Tambah Role
                                        </span>
                                    </span>
                                </a>
                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                            </div>
                        </div>
                    </div>
                    <!--end: Search Form -->
                    <!--begin: Datatable -->
                    <div class="m_datatable" id="divRoleList"></div>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('assets/app/js/role/index.js')}}" type="text/javascript"></script>
@endsection
