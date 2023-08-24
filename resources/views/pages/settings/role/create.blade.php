@extends('layouts.master')

@section('roles.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Create Role
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
    <li class="breadcrumb-item text-muted">Create</li>
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
            <form role="form" method="POST" action="{{ route('roles.store') }}">
                @csrf

                <div class="row mt-4">
                    {{--Name--}}
                    <div class="col-sm-12 mb-6">
                        <label for="name" class="required form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="Role Name" required
                               value="{{ old('name') }}"
                        />
                        @error('name')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('name')}}
                        </span>
                        @enderror
                    </div>

                    <div class="col-sm-12 mt-4">
                        <label for="permissions" class="required form-label mb-6">Permissions</label>

                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-sm-2 col-md-4 col-xl-3 mb-6">
                                    <div class="form-check form-check-custom">
                                        <input id="{{$permission->id}}" name="permissions[]" type="checkbox"
                                               class="form-check-input" value="{{$permission->id}}"/>
                                        <label class="form-check-label" for="{{$permission->id}}">
                                            {{$permission->name}}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-info"> Create</button>
                </div>
            </form>
        </div>
        <!--end::Card body-->
    </div>
@endsection
