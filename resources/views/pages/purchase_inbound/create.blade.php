@extends('layouts.master')

@section('purchase_inbound')
    hover show
@endsection

@section('purchase_inbound.create')
    active
@stop

@section('breadcrumb_navigation_title')
    Create
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Purchase Inbound</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <li class="breadcrumb-item text-muted">Create</li>
    <!--end::Item-->
@endsection

@section('page_content')
    <form role="form" method="POST" action="{{ route('purchase_inbound.store') }}">
        @csrf
<select class="form-select" data-control="select2" data-placeholder="Select an option">
    <option></option>
    <option value="1">Option 1</option>
    <option value="2">Option 2</option>
</select>
    </form>

@endsection

