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
                                            <input type="number" id="tbxNominal" class="form-control m-input"
                                                required/>
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
                                        Laporan
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
                                        Pengujian
                                        @elseif ($vwDetailPenelitian['idMilestone'] == 3)
                                        Analisis
                                        @elseif ($vwDetailPenelitian['idMilestone'] == 4)
                                        Laporan
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
                    <!-- cek biaya penelitian -->
                    @if ($vwDetailPenelitian['biaya'] == 0)
                        <a href="/Rincian/{{ $vwDetailPenelitian['idPenelitian'] }}" class="btn btn-success btn-m m-btn m-btn--icon m-btn--pill m-btn--air" style="margin-left:10px; margin-right:10px">
                            <span>
                                <i class="la la-dollar"></i>
                                <span>
                                    Tambah Rincian
                                </span>
                            </span>
                        </a>
                    @else
                        @if ($vwDetailPenelitian['totalBayar'] < $vwDetailPenelitian['biaya'])
                        <a href="#" class="btn btn-success btn-m m-btn m-btn--icon m-btn--pill m-btn--air" style="margin-left:10px; margin-right:10px"
                            data-toggle="modal" data-target="#formPembayaran">
                            <span>
                                <i class="la la-dollar"></i>
                                <span>
                                    Bayar
                                </span>
                            </span>
                        </a>
                        @endif
                    @endif
                    <!-- cek alur -->
                    <!-- penelitian rencana -->
                    @if ($vwDetailPenelitian['idMilestone'] == 1)
                        @if($vwDetailPenelitian['totalBayar'] >= ($vwDetailPenelitian['biaya']/2.0) && $vwDetailPenelitian['biaya'] != 0)
                        <div class="btn-group m-btn-group m-btn-group--pill m-btn-group--air" role="group" aria-label="...">
                            <button type="button" class="m-btn btn btn-secondary" id="btnHapus">
                                Batal
                            </button>
                            <button type="button" class="m-btn btn btn-success" data-toggle="modal" data-target="#$vwDetailPenelitian['idMilestone']" id="btnLanjut">
                                Lanjut
                            </button>
                        </div>
                        @else
                            <button type="button" class="m-btn btn btn-secondary" id="btnHapus">
                                Batal
                            </button>
                        @endif
                    <!-- else if (penelitian sudah mulai) -->
                    @elseif ($vwDetailPenelitian['idMilestone'] == 2 || $vwDetailPenelitian['idMilestone'] == 3 || $vwDetailPenelitian['idMilestone'] == 4)
                    <a href="#" class="btn btn-success btn-m m-btn m-btn--icon m-btn--pill m-btn--air btn-generate" id="btnTrx"
                        style="margin-left:10px; margin-right:10px" data-toggle="modal" data-target="#$vwDetailPenelitian['idMilestone']">
                        <span>
                            <i class="la la-info"></i>
                            <span>
                                @if($vwDetailPenelitian['idMilestone'] == 2)
                                    Mulai Pengujian
                                @elseif($vwDetailPenelitian['idMilestone'] == 3)
                                    Mulai Analisis
                                @elseif($vwDetailPenelitian['idMilestone'] == 4)
                                    Selesai
                                @endif
                                <!-- {{ $vwDetailPenelitian['namaMilestone'] }} -->
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
                                <i class="flaticon-coins"></i>
                            </span>
                            <span class="text-sm-left">
                            @if ($vwDetailPenelitian['totalBayar'] == NULL)
                                Rp 0 dari {{ $vwDetailPenelitian['biaya'] }}
                            @elseif ($vwDetailPenelitian['totalBayar'] < $vwDetailPenelitian['biaya'])
                                Rp {{ $vwDetailPenelitian['totalBayar'] }} dari {{ $vwDetailPenelitian['biaya'] }}
                            @else
                                Lunas
                            @endif
                            </span>
                        </div>
                        <div class="m-portlet__head-icon">
                            <span style="margin-right: 5px;">
                                <i class="flaticon-calendar-1"></i>
                            </span>
                            <span class="text-sm-left" id="txtEndPlan">
                                @if($vwDetailPenelitian['idMilestone'] != 5)
                                    @if ($vwDetailPenelitian['sisaDurasi'] < 0)
                                        Lewat {{ $vwDetailPenelitian['sisaDurasi'] }} Hari
                                    @elseif ($vwDetailPenelitian['sisaDurasi'] == NULL)
                                        Durasi Belum Ada
                                    @else
                                        {{ $vwDetailPenelitian['sisaDurasi'] }} Hari Lagi
                                    @endif
                                @else
                                    Selesai
                                @endif
                            </span>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <!-- <div class="m-portlet__head-title ">
            <h3 class="m-portlet__head-text" style="margin-bottom: 0px;margin-top: 20px;">
                Perlakuan :
            </h3>
        </div>

        <div class="m-scrollable mCustomScrollbar _mCS_5 mCS-autoHide m--margin-top-15" data-scrollbar-shown="true"
            data-scrollable="true" data-max-height="380" style="overflow: visible; position: relative;">
            <textarea readonly class="form-control m-input m-input--air" id="exampleTextarea" rows="4" style="margin-bottom: 30px;">{{ $vwDetailPenelitian['perlakuan'] }}</textarea>
        </div> -->

        <div class="m_datatable" id="divHistory" style="margin-top: 20px">

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
