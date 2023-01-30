@extends('layouts.master')

@section('dashboard.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Dashboard
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Dashboard</li>
    <!--end::Item-->
@endsection

@section('page_content')
    <div class="card card-flush shadow-sm">
        <div class="card-body py-5"></div>
    </div>
@endsection
