@if (!$vwDetailPenelitian)
<div class="m-content">
    <div class="m-alert m-alert--icon alert alert-warning" role="alert">
        <div class="m-alert__icon">
            <i class="la la-warning"></i>
        </div>
        <div class="m-alert__text">
            <!-- <strong>
                Maaf,
            </strong> -->
            Anda tidak memiliki tugas
        </div>
        <div class="m-alert__actions" style="width: 160px;">
            <a href="/Penelitian/TambahPenelitian" class="btn btn-secondary btn-sm m-btn m-btn--pill m-btn--wide">
                <span>
                    <i class="fa fa-plus"></i>
                    <span>
                        Tambah Penelitian
                    </span>
                </span>
            </a>
        </div>
    </div>
</div>
@elseif ($vwDetailPenelitian['idProsedur'] != 0  || $vwDetailPenelitian['idKategori'] == 1)
<input type="hidden" value="{{$vwDetailPenelitian['idMilestone']}}" id="inptMilestoneID">
<input type="hidden" value="{{$vwDetailPenelitian['idKategori']}}" id="inptKategoriID">
<input type="hidden" value="{{$prosedur['laporan']}}" id="statusLaporan">
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="row">
                <div class="col-lg-12" style="margin-right:20px">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            @if ($vwDetailPenelitian['idKategori'] != 1)
                                {{ $vwDetailPenelitian['judulPenelitian'] }}
                            @else
                                Penyediaan Hewan Coba
                            @endif
                            <!-- Judul Penenlitian -->
                            <small>
                                {{ $vwDetailPenelitian['namaPeneliti'] }} / {{ $vwDetailPenelitian['instansiPeneliti'] }}
                            </small>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="m-portlet__body" style="padding-top: 0px;">
        <div class="form-group m-form__group">
            <div class="alert m-alert m-alert--default" role="alert" style="margin-bottom: 20px;">
                <div class="col-lg-12 m--align-center">
                    <!-- modal -->
                    <!-- prosedur -->
                    <div class="modal hide fade" id="prosedur" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Prosedur Penelitian
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label col-lg-3 m--align-right" !important>
                                        Hewan :
                                    </label>
                                    <div class="col-lg-6">
                                        <input class="form-control m-input" value="{{$prosedur['keteranganHewan']}}" disabled/>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                        Keterangan Hewan :
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{$prosedur['keteranganHewan']}}" class="form-control m-input" disabled>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                        Kelompok Perlakuan :
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea type="text" class="form-control m-input" rows="4" disabled>{{$prosedur['perlakuan']}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                        Parameter Uji :
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea type="text" class="form-control m-input" rows="4" disabled>{{$prosedur['parameterUji']}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                        Desain Penelitian :
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea type="text" class="form-control m-input" rows="4" disabled>{{$prosedur['desainPenelitian']}}</textarea>
                                    </div>
                                </div>
                                <div class="m-form__group form-group row">
                                    @if($prosedur['etikHewan'] == 1)
                                        @php ($checked1 = 'checked')
                                        @php ($checked2 = '')
                                    @else
                                        @php($checked1 = '')
                                        @php ($checked2 = 'checked')
                                    @endif
                                    <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                        Etik Hewan :
                                    </label>
                                    <div class="col-lg-3 col-md-3 col-sm-6 m-radio-inline" style="padding-left:20px; padding-top:5px">
                                        <label class="m-radio m-radio--solid m-radio--success">
                                            <input type="radio" name="etikHewan" value="1" id="ya" {{$checked1}} disabled>
                                            Ya
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid m-radio--success">
                                            <input type="radio" name="etikHewan" value="0" id="tidak" {{$checked2}} disabled>
                                            Tidak
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="m-form__group form-group row">
                                    @if($prosedur['laporan'] == 1)
                                        @php ($checked1 = 'checked')
                                        @php ($checked2 = '')
                                    @else
                                        @php($checked1 = '')
                                        @php ($checked2 = 'checked')
                                    @endif
                                    <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                        Laporan :
                                    </label>
                                    <div class="col-lg-3 col-md-3 col-sm-6 m-radio-inline" style="padding-left:20px; padding-top:5px">
                                        <label class="m-radio m-radio--solid m-radio--success">
                                            <input type="radio" name="laporan" value="1" id="ya" {{$checked1}} disabled>
                                            Ya
                                            <span></span>
                                        </label>
                                        <label class="m-radio m-radio--solid m-radio--success">
                                            <input type="radio" name="laporan" value="0" id="tidak" {{$checked2}} disabled>
                                            Tidak
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- form pembayaran -->
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
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Sisa Biaya :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12 m--align-left">
                                            <label class="col-form-label col-lg-3 col-sm-12" id="txtSisaBiaya">
                                                Rp.{{$sisaBiaya}}
                                                <input type="hidden" id="tbxSisaBiaya" value="{{$sisaBiaya}}">
                                            </label>
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
                    <!-- form laporan penelitian -->
                    @if ($vwDetailPenelitian['idMilestone'] == 4 || $vwDetailPenelitian['idMilestone'] == 5)
                    <div class="modal hide fade" id="$vwDetailPenelitian['idMilestone']" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        @if ($vwDetailPenelitian['idMilestone'] == 4)
                                            @if($prosedur['laporan'] == 1)
                                                Pembuatan Laporan
                                            @else
                                                Selesai
                                            @endif
                                        @elseif ($vwDetailPenelitian['idMilestone'] == 5)
                                        Selesai
                                        @endif
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">
                                            &times;
                                        </span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if ($vwDetailPenelitian['idKategori'] != 1)
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            @if ($vwDetailPenelitian['idMilestone'] == 4)
                                            Data <strong style="color:red" ;>*</strong> :
                                            @elseif ($vwDetailPenelitian['idMilestone'] == 5)
                                            Hasil <strong style="color:red" ;>*</strong> :
                                            @endif
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file" id="inptFile" style="margin-top: 5px">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($vwDetailPenelitian['idMilestone'] == 4)
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important">
                                            Analis <strong style="color:red" ;>*</strong> :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12 m--align-left" !important>
                                            <select class="form-control m-select2" id="slsPIC" style="width:550px">
                                            </select>
                                        </div>
                                    </div>
                                    @endif
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
                                        Lanjut
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- form alur penelitian -->
                    @elseif ($vwDetailPenelitian['idMilestone'] == 1 || $vwDetailPenelitian['idMilestone'] == 2 || $vwDetailPenelitian['idMilestone'] == 3)
                    <div class="modal hide fade" id="$vwDetailPenelitian['idMilestone']" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        @if ($vwDetailPenelitian['idMilestone'] == 1)
                                        Mulai Penelitian
                                        @elseif ($vwDetailPenelitian['idMilestone'] == 2)
                                        Pemeliharaan
                                        @elseif ($vwDetailPenelitian['idMilestone'] == 3)
                                        Perlakuan
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
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important">
                                            PIC <strong style="color:red" ;>*</strong> :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12 m--align-left" !important>
                                            <select class="form-control m-select2" id="slsPIC" style="width:550px">
                                            </select>
                                        </div>
                                    </div>
                                    @if ($vwDetailPenelitian['idMilestone'] == 2 || $vwDetailPenelitian['idMilestone'] == 3)
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Catatan :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12">
                                            <textarea type="text" id="tbxCatatan" class="form-control m-input"></textarea>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group m-form__group row">
                                        <label class="col-form-label col-lg-3 col-sm-12 m--align-right" !important>
                                            Durasi :
                                        </label>
                                        <div class="col-lg-9 col-md-9 col-sm-12 m--align-left">
                                            <label class="col-form-label col-lg-3 col-sm-12" id="txtDurasi">
                                            @if($vwDetailPenelitian['idMilestone'] == 1)
                                                {{$vwDetailPenelitian['tahap1']}} Hari
                                            @elseif($vwDetailPenelitian['idMilestone'] == 2)
                                                {{$vwDetailPenelitian['tahap2']}} Hari
                                            @elseif($vwDetailPenelitian['idMilestone'] == 3)
                                                {{$vwDetailPenelitian['tahap3']}} Hari
                                            @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                        Batal
                                    </button>
                                    <button type="button" class="btn btn-success" id="btnTambah">
                                        Lanjut
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <!-- button -->
                    <!-- prosedur -->
                    <a href="#" class="btn btn-primary btn-m m-btn m-btn--icon m-btn--pill m-btn--air" style="margin-left:10px; margin-right:10px" data-toggle="modal" data-target="#prosedur">
                        <span>
                            <i class="la la-file"></i>
                            <span>
                                Lihat Prosedur
                            </span>
                        </span>
                    </a>
                    <!-- cek biaya penelitian -->
                    @if ($vwDetailPenelitian['biaya'] == 0)
                        <a href="/Keuangan/Rincian/{{ $vwDetailPenelitian['idPenelitian'] }}" class="btn btn-success btn-m m-btn m-btn--icon m-btn--pill m-btn--air" style="margin-left:10px; margin-right:10px">
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
                    @if($vwDetailPenelitian['email'] == $email)
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
                                <button type="button" class="btn btn-secondary btn-m m-btn m-btn--icon m-btn--pill m-btn--air" id="btnHapus">
                                    Batal
                                </button>
                            @endif
                        <!-- else if (penelitian sudah mulai) -->
                        @elseif ($vwDetailPenelitian['idMilestone'] == 2 || $vwDetailPenelitian['idMilestone'] == 3 || $vwDetailPenelitian['idMilestone'] == 4 || $vwDetailPenelitian['idMilestone'] == 5)
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
                                        @if($prosedur['laporan'] == 1)
                                            Pembuatan Laporan
                                        @else
                                            Selesai
                                        @endif
                                    @elseif($vwDetailPenelitian['idMilestone'] == 5)
                                        Selesai
                                    @endif
                                    <!-- {{ $vwDetailPenelitian['namaMilestone'] }} -->
                                </span>
                            </span>
                        </a>
                        @endif
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
                                @if($vwDetailPenelitian['idKategori'] == 1 && $vwDetailPenelitian['idMilestone'] == 4)
                                Pemeliharaan
                                @else
                                {{ $vwDetailPenelitian['namaMilestone'] }}
                                @endif
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
                            <span class="text-sm-left">
                                @if($vwDetailPenelitian['idMilestone'] != 6)
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

        <div class="m-portlet__head-title ">
            <h6 class="m-portlet__head-text" style="margin-bottom: 0px;margin-top: 20px;">
                Riwayat Penelitian :
            </h6>
        </div>

        <!-- <div class="m-scrollable mCustomScrollbar _mCS_5 mCS-autoHide m--margin-top-15" data-scrollbar-shown="true" data-scrollable="true" data-max-height="380" style="overflow: visible; position: relative;">
            <textarea readonly class="form-control m-input m-input--air" id="exampleTextarea" rows="5" style="margin-bottom: 30px;">{{ $vwDetailPenelitian['perlakuan'] }}</textarea>
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
        <a href="/Penelitian/TambahProsedur/{{ $vwDetailPenelitian['idPenelitian'] }}" class="btn btn-secondary btn-sm m-btn m-btn--pill m-btn--wide">
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
