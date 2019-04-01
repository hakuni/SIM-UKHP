@foreach ($vwListPenelitian as $vwPenelitian)
<div class="tab-content divShowDetail" id="{{$vwPenelitian['idPenelitian']}}">
    <div class="tab-pane active" id="m_widget2_tab1_content">
        <div class="m-widget2">
            @php ($color = "")
                @if ($vwPenelitian['idMilestone'] == "1")
                    @php ($color = "warning")
                @elseif ($vwPenelitian['idMilestone'] == "2" || $vwPenelitian['idMilestone'] == "3" || $vwPenelitian['idMilestone'] == "4")
                    @php ($color = "primary")
                @elseif ($vwPenelitian['idMilestone'] == "5")
                    @php ($color = "success")
                @endif
            <div class="m-widget2__item m-widget2__item--{{$color}}">
                <div class="m-widget2__checkbox">
                    <!-- @*UNTUK JARAK ANTARA WARNA DAN TULISAN*@ -->
                </div>
                <div class="m-widget2__desc">
                    <div>
                        <span class="m-widget2__text" style="float: left;">
                            {{$vwPenelitian['namaPeneliti']}}
                        </span>

                        @if ($vwPenelitian['idKategori'] != 1)
                        <span class="m-badge m-badge--{{$color}} m-badge--wide" style="float: right;">
                            {{$vwPenelitian['namaMilestone']}}
                        </span>
                        @endif
                    </div>
                </div>
                <span class="m-widget2__user-name">
                    <a class="m-widget2__link" style="padding-left: 35px;">
                        {{$vwPenelitian['namaKategori']}}
                    </a>
                </span>
            </div>
        </div>
    </div>
    <div class="tab-pane" id="m_widget2_tab2_content"></div>
    <div class="tab-pane" id="m_widget2_tab3_content"></div>
</div>
@endforeach
<input type="hidden" value="{{$idPenelitian}}" id="idPenelitian">
<input type="hidden" value="{{$banyak}}" id="inptJmlhPenelitian">
