@extends('public.index')
@section('title', 'Dashboard')
@section('content')

<div class="m-content">
    <div class="row">
        <div class="col-xl-6">
            <!--begin:: Widgets/Tasks -->
            <div class="m-portlet">
                <div class="m-widget14" style="padding-left: 15px; padding-right: 15px">
                    <div class="m-widget14__header m--margin-bottom-10">
                        <div class="row">
                            <h3 class="m-widget14__title col-lg-6">
                                Penelitian
                            </h3>
                            <ul class="nav nav-pills nav-pills--primary col-lg-6" role="tablist">
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
                    <div class="m-portlet__body" style="padding-left: 0px; padding-right: 0px">
                        <div class="tab-content">
                            <div class="tab-pane active" id="grafikKategori" role="tabpanel">
                                <div class="m-widget14__chart">
                                    <div id="kategori" style="width: auto; height: 300px;"></div>
                                </div>
                            </div>
                            <div class="tab-pane" id="grafikPenggunaan" role="tabpanel">
                                <div class="m-widget14__chart">
                                    <div id="penggunaan" style="width: auto; height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Tasks -->
        </div>
        <div class="col-xl-6">
            <!--begin:: Widgets/Support Tickets -->
            <div class="m-portlet">
                <div class="m-widget14" style="padding-left: 15px; padding-right:15px">
                    <div class="m-widget14__header m--margin-bottom-10">
                        <h3 class="m-widget14__title">
                            Administrasi
                        </h3>
                    </div>
                    <div class="m-widget14__chart">
                        <div id="keuangan" style="width: auto; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Support Tickets -->
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <!--begin:: Widgets/Support Tickets -->
            <div class="m-portlet">
                <div class="m-widget14">
                    <div class="m-widget14__header m--margin-bottom-10">
                        <h3 class="m-widget14__title">
                            Hewan
                        </h3>
                    </div>
                    <div class="m-widget14__chart">
                        <div id="hewan" style="width: auto; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <!--end:: Widgets/Support Tickets -->
        </div>
    </div>
</div>
<script src="{{asset('assets/app/js/dashboard/index.js')}}" type="text/javascript"></script>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/frozen.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
@endsection
