@extends('layouts.master')

@section('users.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Role
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Role Management</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <li class="breadcrumb-item text-muted">Role Detail</li>
    <!--end::Item-->
@endsection

@section('page_content')
    <div class="card" id="kt_profile_details_view">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <a href="{{ URL::previous() }}" class="btn btn-icon-gray-600 m-0 p-0 me-2">
                    <i class="fa-solid fa-arrow-left text-info"></i>
                </a>
                <h3 class="fw-bold m-0">Role Details</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body p-9">
            <!--begin::Row-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-sm-4 fw-semibold text-muted">Role Name</label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-sm-8">
                    <span class="fw-bold fs-6 text-gray-800">{{$role->name}}</span>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Input group-->
            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-sm-4 fw-semibold text-muted">Permissions</label>
                <!--end::Label-->
                <div class="col-sm-8">
                    <div class="row">
                        <!--begin::Col-->
                        @foreach($role->permissions as $permission)
                            <div class="col-sm-6 col-lg-4 mt-2">
                                <span class="badge badge-info">{{$permission->name}}</span>
                            </div>
                        @endforeach
                        <!--end::Col-->
                    </div>
                </div>
            </div>
            <!--end::Input group-->

        </div>
        <!--end::Card body-->
    </div>
@endsection
