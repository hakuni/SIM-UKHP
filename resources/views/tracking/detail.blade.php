@if ($vwDetailPenelitian['idProsedur'] != 0 )
<input type="hidden" value="{{$vwDetailPenelitian['idMilestone']}}" id="inptMilestoneID">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">
                    {{ $vwDetailPenelitian['judulPenelitian'] }}
                    <!-- Judul Penenlitian -->
                    <small>
                        {{ $vwDetailPenelitian['namaPeneliti'] }} / {{ $vwDetailPenelitian['instansiPeneliti'] }}
                    </small>
                </h3>
            </div>
        </div>
    </div>
    <div class="m-portlet__body" style="padding-top: 0px;">
        <div class="form-group m-form__group">
            <div class="alert m-alert m-alert--default" role="alert" style="margin-bottom: 20px;">
                <div class="col-lg-12 m--align-center">
                    <a href="/UbahPenelitian/{{ $vwDetailPenelitian['idPenelitian'] }}" class="btn btn-primary btn-m m-btn m-btn--icon m-btn--pill m-btn--air"
                        style="margin-right: 10px;">
                        <span>
                            <i class="la la-edit"></i>
                            <span>
                                Ubah Penelitian
                            </span>
                        </span>
                    </a>
                    <!-- modal -->
                    <div class="modal hide fade" id="formPembayaran" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Tambah Pembayaran
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Tgl Pembayaran <strong style="color:red" ;>*</strong> :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <div class="input-group date">
                                                <input type="text" class="form-control m-input datepicker" id="tbxTglPembayaran" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <i class="la la-calendar"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Nominal <strong style="color:red" ;>*</strong> :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea type="number" id="tbxNominal" class="form-control m-input"
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-success" id="btnTambahBayar">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($vwDetailPenelitian['idMilestone'] == 4)
                    <div class="modal hide fade" id="$vwDetailPenelitian['idMilestone']" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Tahap Ketiga
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Hasil <strong style="color:red" ;>*</strong> :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file" id="inptFile" style="margin-top: 5px">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Catatan <strong style="color:red" ;>*</strong> :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea type="text" id="tbxCatatan" class="form-control m-input" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-success" id="btnTambah">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif ($vwDetailPenelitian['idMilestone'] == 1 || $vwDetailPenelitian['idMilestone'] == 2 ||
                    $vwDetailPenelitian['idMilestone'] == 3)
                    <div class="modal hide fade" id="$vwDetailPenelitian['idMilestone']" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        @if ($vwDetailPenelitian['idMilestone'] == 1)
                                        Mulai Penelitian
                                        @elseif ($vwDetailPenelitian['idMilestone'] == 2)
                                        Tahap Pertama
                                        @elseif ($vwDetailPenelitian['idMilestone'] == 3)
                                        Tahap Kedua
                                        @elseif ($vwDetailPenelitian['idMilestone'] == 4)
                                        Tahap Ketiga
                                        @endif
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Penanggung Jawab <strong style="color:red" ;>*</strong> :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" id="tbxPJ" class="form-control m-input" required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Durasi <strong style="color:red" ;>*</strong> :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <input type="text" id="tbxDurasi" class="form-control m-input" required>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Catatan :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea type="text" id="tbxCatatan" class="form-control m-input"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-success" id="btnTambah">
                                        Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- button -->
                    <a href="#" class="btn btn-success btn-m m-btn m-btn--icon m-btn--pill m-btn--air" style="margin-left:10px; margin-right:10px"
                        data-toggle="modal" data-target="#formPembayaran">
                        <span>
                            <i class="la la-dollar"></i>
                            <span>
                                Bayar
                            </span>
                        </span>
                    </a>
                    @if ($vwDetailPenelitian['idMilestone'] == 1)
                    <div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">
                        <button type="button" class="m-btn btn btn-secondary" id="btnHapus">
                            Batal
                        </button>
                        <button type="button" class="m-btn btn btn-success" data-toggle="modal" data-target="#$vwDetailPenelitian['idMilestone']">
                            Lanjut
                        </button>
                    </div>
                    <!-- else if (penelitian belum mulai) -->
                    @else
                    <a href="#" class="btn btn-success btn-m m-btn m-btn--icon m-btn--pill m-btn--air btn-generate" id="trx"
                        style="margin-left:10px; margin-right:10px" data-toggle="modal" data-target="#$vwDetailPenelitian['idMilestone']">
                        <span>
                            <i class="la la-info"></i>
                            <span>
                                {{ $vwDetailPenelitian['namaMilestone'] }}
                            </span>
                        </span>
                    </a>
                    @endif
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
                                {{ $vwDetailPenelitian['PIC'] }}
                            </span>
                        </div>
                        <div class="m-portlet__head-icon">
                            <span style="margin-right: 5px;">
                                <i class="flaticon-route"></i>
                            </span>
                            <span>
                                {{ $vwDetailPenelitian['namaMilestone'] }}
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
                            <span class="text-sm-left">
                                {{ $vwDetailPenelitian['biaya'] }}
                            </span>
                        </div>
                        <div class="m-portlet__head-icon">
                            <span style="margin-right: 5px;">
                                <i class="flaticon-music-1"></i>
                            </span>
                            <span class="text-sm-left" id="txtEndPlan">
                                @if ($vwDetailPenelitian['durasi'] != 0)
                                {{ $vwDetailPenelitian['durasi'] }}
                                @else
                                Durasi Belum Ada
                                @endif
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
            <textarea readonly class="form-control m-input m-input--air" id="exampleTextarea" rows="4" style="margin-bottom: 30px;">{{ $vwDetailPenelitian['perlakuan'] }}</textarea>
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
<div class="m-alert m-alert--icon alert alert-warning" role="alert">
    <div class="m-alert__icon">
        <i class="la la-warning"></i>
    </div>
    <div class="m-alert__text">
        <strong>
            Maaf,
        </strong>
        Silahkan membuat prosedur penelitian
    </div>
    <div class="m-alert__actions" style="width: 160px;">
        <a href="/TambahProsedur/{{ $vwDetailPenelitian['idPenelitian'] }}" class="btn btn-secondary btn-sm m-btn m-btn--pill m-btn--wide">
            <span>
                <i class="fa fa-plus"></i>
                <span>
                    Tambah Prosedur
                </span>
            </span>
        </a>
    </div>
</div>
@endif
