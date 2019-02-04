@extends('public.index')
@section('content')

<div class="m-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="m-portlet m-portlet--tabs">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <div class="m-portlet__head-text ">
                                <a href="/BugTracker" class="fa fa-arrow-left"></a>
                            </div>
                            <h3 class="m-portlet__head-text col-lg-4">
                                Rincian Keuangan |
                                <small class="m-portlet__head-caption">Adji, S2 IPB</small>
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
                                <a class="nav-link m-tabs__link" data-toggle="tab" href="#logTab" role="tab">
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
                                    <div class="col-xl-12 order-2 order-xl-1 m--align-right">
                                        <div class="form-group m-form__group row align-items-center">
                                            <div class="col-xl-6 order-1 order-xl-2 m--align-right">
                                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                                            </div>
                                            <div class="col-xl-3 order-1 order-xl-2 m--align-right">
                                                <a href="/Project/Create" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                    <span>
                                                        <i class="fa fa-file-excel-o"></i>
                                                        <span>
                                                            Eksport
                                                        </span>
                                                    </span>
                                                </a>
                                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                                            </div>
                                            <div class="col-xl-3 order-1 order-xl-2 m--align-right">
                                                <a href="/Project/Create" class="btn btn-success m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                                    <span>
                                                        <i class="fa fa-plus"></i>
                                                        <span>
                                                            Tambah Rincian
                                                        </span>
                                                    </span>
                                                </a>
                                                <div class="m-separator m-separator--dashed d-xl-none"></div>
                                            </div>
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
<script src="resources/js/keuangan/rincian.js" type="text/javascript"></script>
@endsection
