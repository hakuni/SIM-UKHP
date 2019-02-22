@foreach ($vwListPenelitian as $vwPenelitian)
<div class="tab-content divShowDetail" id="{{$vwPenelitian['idPenelitian']}}">
    <div class="tab-pane active" id="m_widget2_tab1_content">
        <div class="m-widget2">
            <div class="m-widget2__item m-widget2__item--primary">
                <div class="m-widget2__checkbox">
                    <!-- @*UNTUK JARAK ANTARA WARNA DAN TULISAN*@ -->
                </div>
                <div class="m-widget2__desc">
                    <div>
                        <span class="m-widget2__text" style="float: left;">
                            {{$vwPenelitian['namaPeneliti']}}
                        </span>

                        <span class="m-badge m-badge--success m-badge--wide" style="float: right;">
                            {{$vwPenelitian['namaMilestone']}}
                        </span>
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
