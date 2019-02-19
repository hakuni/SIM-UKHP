@if({{$vwDetailPenelitian['idProsedur'] }} != 0)
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">

                <h3 class="m-portlet__head-text">
                    {{$vwDetailPenelitian['judulPelitian'] }}
                    <small>
                        {{$vwDetailPenelitian['namaPeneliti'] }} / {{$vwDetailPenelitian['instansiPeneliti'] }}
                    </small>
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body" style="padding-top: 0px;">
        <div class="form-group m-form__group">
            <div class="alert m-alert m-alert--default" role="alert" style="margin-bottom: 20px;">
                <div class="col-lg-12 m--align-center" id="btnGenerate">
                    <a href="#" class="btn btn-primary btn-m m-btn m-btn--icon m-btn--pill m-btn--air"
                        style="margin-right: 10px;">
                        <span>
                            <i class="la la-edit"></i>
                            <span>
                                Ubah Penelitian
                            </span>
                        </span>
                    </a>
                    <!-- modal -->

                    <!-- button -->

                    <!-- else if (penelitian belum mulai) -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">

                <div class="m-portlet__head-title">
                    <div class="m-portlet__head-text">

                        <div class="m-portlet__head-icon">
                            <span style="margin-right: 5px;">
                                <i class="flaticon-user"></i>
                            </span>
                            <span>
                                Penanggung Jawab
                            </span>
                        </div>
                        <div class="m-portlet__head-icon">
                            <span style="margin-right: 5px;">
                                <i class="flaticon-route"></i>
                            </span>
                            <span>
                                Tahapan
                            </span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-5" style="padding-left: 55px;">

                <div class="m-portlet__head-title">
                    <div class="m-portlet__head-text">

                        <div class="m-portlet__head-icon">
                            <span style="margin-right: 5px;">
                                <i class="flaticon-music-2"></i>
                            </span>
                            <span class="text-sm-left" id="txtStartPlan">
                                Biaya Penelitian
                            </span>
                        </div>
                        <div class="m-portlet__head-icon">
                            <span style="margin-right: 5px;">
                                <i class="flaticon-music-1"></i>
                            </span>
                            <span class="text-sm-left" id="txtEndPlan">
                                Target Selesai
                            </span>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="m-portlet__head-title ">
            <h3 class="m-portlet__head-text" style="margin-bottom: 0px;margin-top: 20px;">
                Perlakuan :
            </h3>
        </div>

        <div class="m-scrollable mCustomScrollbar _mCS_5 mCS-autoHide m--margin-top-15" data-scrollbar-shown="true"
            data-scrollable="true" data-max-height="380" style="overflow: visible; position: relative;">
            <textarea readonly class="form-control m-input m-input--air" id="exampleTextarea" rows="4" style="margin-bottom: 30px;">Isi Perlakuan</textarea>
        </div>

        <ul class="nav nav-pills nav-fill nav-pills--warning" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#milestones">
                    Milestones
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#workLog">
                    Work Log
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#history">
                    History
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="milestones" role="tabpanel">
                <div class="m_datatable" id="divMilestoneList">

                </div>
            </div>
            <div class="tab-pane" id="workLog" role="tabpanel">
                <div class="m_datatable" id="divWorkLogList">

                </div>
            </div>
            <div class="tab-pane" id="history" role="tabpanel">
                <div class="m_datatable" id="divHistoryList">

                </div>
            </div>
        </div>
    </div>
</div>
@else

@endif
