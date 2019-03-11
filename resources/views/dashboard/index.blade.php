@extends('public.index')
@section('title', 'Dashboard')
@section('content')

<div class="m-content">
    <div class="row">
        <!-- chart penelitian -->
        <div class="col-xl-6">
            <div class="m-portlet">
                <div class="m-widget14">
                    <div class="m-widget14__header" style="padding-bottom:0px">
                        <div class="row align-items-center">
                            <h3 class="m-widget14__title col-lg-6">
                                Penelitian
                            </h3>
                            <ul class="nav nav-pills nav-pills--primary col-lg-6" role="tablist" style="margin-bottom:0px">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#grafikKategori">
                                        Kategori
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#grafikPenggunaan">
                                        Penggunaan
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__foot" style="padding-bottom: 0px"></div>
                    <div class="m-portlet__body" style="padding-left: 0px; padding-right: 0px; padding-top: 0px;">
                        <div class="tab-content">
                            <!-- chart banyak penelitian menggunakan kategori apa -->
                            <div class="tab-pane active" id="grafikKategori" role="tabpanel">
                                <div class="m-form m-form--label-align-right">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="m-form__group m-form__group--inline">
                                                <div class="m-form__label">
                                                    <label class="m-label m-label--single">
                                                        Tahun:
                                                    </label>
                                                </div>
                                                <div class="m-form__control">
                                                    <input class="form-control m-input" id="tbxTahunKategori" />
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <button class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                            id="btnFilterKategori" style="padding-left:15px; padding-right:15px">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="m-widget14__chart">
                                    <div id="kategori" style="width: auto; height: 332px;"></div>
                                </div>
                            </div>
                            <!-- chart banyak penelitian menggunakan hewan apa -->
                            <div class="tab-pane" id="grafikPenggunaan" role="tabpanel">
                                <div class="m-form m-form--label-align-right">
                                    <div class="form-group m-form__group row align-items-center">
                                        <div class="col-lg-6">
                                            <div class="m-form__group m-form__group--inline">
                                                <div class="m-form__label">
                                                    <label class="m-label m-label--single">
                                                        Tahun:
                                                    </label>
                                                </div>
                                                <div class="m-form__control">
                                                    <input class="form-control m-input" id="tbxTahunGuna" />
                                                </div>
                                            </div>
                                            <div class="d-md-none m--margin-bottom-10"></div>
                                        </div>
                                        <button class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                            id="btnFilterPenggunaan" style="padding-left:15px; padding-right:15px">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="m-widget14__chart">
                                    <div id="penggunaan" style="width: auto; height: 332px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end chart -->
        <!-- chart pemasukan keuangan -->
        <div class="col-xl-6">
            <div class="m-portlet">
                <div class="m-widget14">
                    <div class="m-widget14__header" style="padding-bottom:0px">
                        <div class="row align-items-center">
                            <h3 class="m-widget14__title col-lg-6">
                                Keuangan
                            </h3>
                            <div class="col-lg-6 form-group m-form__group row" style="margin-bottom:0px">
                                <div class="col-lg-9">
                                    <div class="m-form__group m-form__group row">
                                        <div class="m-form__label" style="padding-top:7px">
                                            <label class="m-label m-label--single">
                                                Tahun:
                                            </label>
                                        </div>
                                        <div class="m-form__control col-lg-8" style="padding-left:10px; padding-right:10px">
                                            <input class="form-control m-input" id="tbxTahunKeu" />
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                    id="btnFilterKeuangan" style="padding-left:15px; padding-right:15px">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__foot" style="padding-bottom: 0px"></div>
                    <div class="m-widget14__chart">
                        <div id="keuangan" style="width: auto; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end chart -->
    </div>
    <div class="row">
        <!-- chart jumlah hewan digunakan -->
        <div class="col-xl-12">
            <div class="m-portlet">
                <div class="m-widget14">
                    <div class="m-widget14__header" style="padding-bottom:0px">
                        <div class="row align-items-center">
                            <h3 class="m-widget14__title col-lg-3">
                                Hewan
                            </h3>
                            <div class="col-lg-9 m-form__group row" style="margin-bottom:0px">
                                <div class="col-lg-4">
                                    <div class="m-form__group row">
                                        <div class="m-form__label" style="padding-top:7px">
                                            <label class="m-label m-label--single">
                                                Hewan :
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-bootstrap-select" data-dropup-auto="false" id="slsHewan">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="m-form__group--inline">
                                        <div class="m-form__label" style="padding-top:7px">
                                            <label class="m-label m-label--single">
                                                Periode :
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-bootstrap-select" id="slsPeriode" data-dropup-auto="false">
                                                <option value="6">Jan - Jun</option>
                                                <option value="7">Jul - Des</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="m-form__group row">
                                        <div class="m-form__label" style="padding-top:7px">
                                            <label class="m-label m-label--single">
                                                Tahun :
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <input class="form-control m-input" id="tbxTahunHewan" />
                                                </div>
                                                <div class="col-lg-3">
                                                    <button class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                                                        id="btnFilterHewan" style="padding-left:15px; padding-right:15px">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="m-widget14__chart">
                        <div id="hewan" style="width: auto; height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end chart -->
    </div>
</div>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script src="{{asset('assets/app/js/dashboard/index.js')}}" type="text/javascript"></script>
@endsection
