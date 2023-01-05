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
            <form role="form" method="POST" action="{{ route('items.update', $item->id) }}">
                @csrf
                @method('Patch')

                <div class="row mt-4">

                    {{--id--}}
                    <input type="hidden" name="id" value="{{ $item->id }}">

                    {{--First Name--}}
                    <div class="col-sm-12 mb-6">
                        <label for="name" class="required form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="First Name" required
                               value="{{ $item->name }}"
                        />
                        @error('name')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('name')}}
                        </span>
                        @enderror
                    </div>

                    {{--Status--}}
                    <div class="col-sm-6 mb-6">
                        <label for="status" class="required form-label">Select a status</label>
                        <select id="status" name="status" class="form-select" aria-label="Select status" required>
                            <option disabled>Select a Status</option>
                            <option value=1 @if($item->status == 1) selected @endif>Active</option>
                            <option value=0 @if($item->status == 0) selected @endif>Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('status')}}
                        </span>
                        @enderror
                    </div>

                    {{--Role--}}
                    <div class="col-sm-6 mb-6">
                        <label for="role" class="required form-label">Assign a Role</label>
                        <select id="role" name="role" class="form-select" aria-label="Assign role" required>
                            <option disabled>Assign a Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" @if($user->roles[0]->id == $role->id) selected @endif>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('role')}}
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-info">Update</button>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
@endsection
