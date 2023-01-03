@extends('layouts.master')

@section('categories.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Category
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Category Management</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <li class="breadcrumb-item text-muted">Categories</li>
    <!--end::Item-->
@endsection

@section('page_content')
    <div class="row mt-10">
        <div class="col-sm-12 col-md-6 col-xl-4 my-4">
            <a href="{{route('master-categories.index')}}" class="card hover-elevate-up shadow-sm parent-hover">
                <div class="card-body d-flex align-items-center ">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-solid fa-dice-one fs-4x text-hover-info"></i>
                    </span>
                    <span class="ms-3 text-gray-700 parent-hover-primary fs-1 fw-bold">
                        <span class="text-nowrap">Master Categories</span>
                    </span>
                </div>
            </a>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-4 my-4">
            <a href="{{route('level-one-categories.index')}}" class="card hover-elevate-up shadow-sm parent-hover">
                <div class="card-body d-flex align-items-center ">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-solid fa-dice-one fs-4x text-hover-info"></i>
                    </span>
                    <span class="ms-3 text-gray-700 parent-hover-primary fs-1 fw-bold">
                        <span class="text-nowrap">Level One Categories</span>
                    </span>
                </div>
            </a>
        </div>

        <div class="col-sm-12 col-md-6 col-xl-4 my-4">
            <a href="{{route('level-two-categories.index')}}" class="card hover-elevate-up shadow-sm parent-hover">
                <div class="card-body d-flex align-items-center ">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-solid fa-dice-one fs-4x text-hover-info"></i>
                    </span>
                    <span class="ms-3 text-gray-700 parent-hover-primary fs-1 fw-bold">
                        <span class="text-nowrap">Level Two Categories</span>
                    </span>
                </div>
            </a>
        </div>
    </div>
@endsection

