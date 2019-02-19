@extends('public.index')
@section('title', 'Tracking')
@section('content')
<div class="m-content">
    <div class="row">

        <div class="col-lg-1" id="sidebarHide" style="display: none">
            <div class="m-portlet">
                <div class="m-portlet__head" style="border-bottom-width: 0px; padding-right: 18px; padding-left: 10px;">
                    <div class="m-portlet__head-tools">
                        <button type="button" class="btn btn-brand m-btn m-btn--icon m-btn--icon-only" id="btnMaximize">
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
                <div class="m-portlet__body" style="height: 111.6px;">
                    <div class="m--align-center">
                        <div class="row" style="-webkit-transform: rotate(90deg); -moz-transform: rotate(90deg); -ms-transform: rotate(90deg); -o-transform:  rotate(90deg); transform: rotate(90deg);">
                            <h4 style="margin-bottom: 0px;">
                                Peneliitian
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4" id="hideList">
            <!--begin:: Widgets/Tasks -->
            <div class="m-portlet m-portlet--full-height" id="sidebarShow">
                <div class="m-portlet__head">

                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                Penelitian
                                <span class="m-menu__link-badge">
                                    <span class="m-badge m-badge--info">
                                        <!-- banyak penelitian -->
                                    </span>
                                </span>
                            </h3>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">

                        <!-- <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                                m-dropdown-toggle="hover" aria-expanded="true">
                                <small class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand">
                                    Order By :
                                </small>
                                <div class="m-dropdown__wrapper" style="width: 130px;">
                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"
                                        style="left: auto; right: 36.5px;"></span>
                                    <div class="m-dropdown__inner">
                                        <div class="m-dropdown__body">
                                            <div class="m-dropdown__content">
                                                <ul class="m-nav">
                                                    <li class="m-nav__item TaskOrderBy" id="Order-UpdatedDate">
                                                        <a style="cursor:pointer" class="m-nav__link">
                                                            <span class="m-nav__link-text text-sm-right">
                                                                Update Date
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item TaskOrderBy" id="Order-TaskName">
                                                        <a style="cursor:pointer" class="m-nav__link">
                                                            <span class="m-nav__link-text text-sm-right">
                                                                Task Name
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="m-nav__item TaskOrderBy" id="Order-TaskCode">
                                                        <a style="cursor:pointer" class="m-nav__link">
                                                            <span class="m-nav__link-text text-sm-right">
                                                                Task Code
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul> -->

                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item" m-dropdown-toggle="hover" aria-expanded="true">
                                <button type="button" class="btn btn-brand m-btn m-btn--icon m-btn--icon-only" id="btnMinimize">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="m-scrollable" data-scrollable="true" data-max-height="500px" style="height: 380px; overflow: hidden;">
                        <div id="listPenelitian">
                            <!-- looping penelitian -->

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-lg-8" id="detailPenelitian">
            <!-- detail penelitian -->
        </div>
    </div>

</div>
<script src="{{asset('assets/app/js/tracking/index.js')}}" type="text/javascript"></script>
@endsection
