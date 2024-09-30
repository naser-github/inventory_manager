@extends('layouts.master')

@section('items.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Edit Item
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Item Management</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <li class="breadcrumb-item text-muted">Edit</li>
    <!--end::Item-->
@endsection

@section('page_content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <a href="{{ URL::previous() }}" class="btn btn-sm btn-light-info ">
                    <i class="fa-solid fa-arrow-left"></i> Back
                </a>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form role="form" method="POST" action="{{ route('items.update',$item->id) }}">
                @csrf
                @method('PUT')
                <div class="row mt-4">
                    {{--id--}}
                    <input type="hidden" name="id" value="{{ $item->id }}">

                    {{--Name--}}
                    <div class="col-sm-6 mb-6">
                        <label for="name" class="required form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="Name" required
                               value="{{ $item->name }}"
                        />
                        @error('name')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('name')}}
                        </span>
                        @enderror
                    </div>

                    {{--Unit--}}
                    <div class="col-sm-6 mb-6">
                        <label for="unit_name" class="required form-label">Unit</label>
                        <input type="text" id="unit_name" name="unit_name" class="form-control"
                               placeholder="Unit Name" required
                               value="{{ $item->unit }}"
                        />
                        @error('unit_name')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('unit_name')}}
                        </span>
                        @enderror
                    </div>

                    {{--Status--}}
                    <div class="col-sm-6 mb-6">
                        <label for="status" class="required form-label">Select a status</label>
                        <select id="status" name="status" class="form-select" aria-label="Select status" required>
                            <option disabled>Select a Status</option>
                            <option value="1" @if($item->status == 1) selected @endif>Active</option>
                            <option value="0" @if($item->status == 0) selected @endif>Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('status')}}
                        </span>
                        @enderror
                    </div>

                    {{--master category--}}
                    <div class="col-sm-6 mb-6">
                        <label for="master_category" class="required form-label">Master Category</label>
                        <select id="master_category" name="master_category" class="form-select"
                                aria-label="Assign master category" required>
                            <option disabled>Assign a Master Category</option>
                            @foreach($master_categories as $master_category)
                                <option value="{{ $master_category->id }}"
                                        @if($item->master_category->id == $master_category->id) selected @endif
                                >
                                    {{ $master_category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('master_category')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('master_category')}}
                        </span>
                        @enderror
                    </div>

                    {{--level one category--}}
                    <div class="col-sm-6 mb-6">
                        <label for="level_one_category" class="form-label">Level One Category</label>
                        <select id="level_one_category" name="level_one_category" class="form-select"
                                aria-label="Assign level one category">
                            <option value="">Assign a Level One Category</option>
                            @foreach($level_one_categories as $level_one_category)
                                <option value="{{ $level_one_category->id }}"
                                        @if($item->level_one_category->id == $level_one_category->id) selected @endif
                                >
                                    {{ $level_one_category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('level_one_category')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('level_one_category')}}
                        </span>
                        @enderror
                    </div>

                    {{--level two category--}}
{{--                    <div class="col-sm-6 mb-6">--}}
{{--                        <label for="level_two_category" class="form-label">Level Two Category</label>--}}
{{--                        <select id="level_two_category" name="level_two_category" class="form-select"--}}
{{--                                aria-label="Assign level two category" required>--}}
{{--                            <option value="">Assign a Level Two Category</option>--}}
{{--                            @foreach($level_two_categories as $level_two_category)--}}
{{--                                <option value="{{ $level_two_category->id }}"--}}
{{--                                        @if($item->level_two_category->id == $level_two_category->id) selected @endif--}}
{{--                                >--}}
{{--                                    {{ $level_two_category->name }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                        @error('level_two_category')--}}
{{--                        <span class="text-danger m-0 p-0" role="alert">--}}
{{--                            {{$errors->first('level_two_category')}}--}}
{{--                        </span>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-info">Update</button>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
@endsection
