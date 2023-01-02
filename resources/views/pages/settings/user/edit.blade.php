@extends('layouts.master')

@section('users.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Edit User
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">User Management</li>
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
            <form role="form" method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('Patch')

                <div class="row mt-4">

                    <input type="hidden" name="id" value="{{ $user->id }}">

                    {{--First Name--}}
                    <div class="col-sm-12 mb-6">
                        <label for="name" class="required form-label">First Name</label>
                        <input type="text" id="name" name="name" class="form-control"
                               placeholder="First Name" required
                               value="{{ $user->name }}"
                        />
                        @error('name')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('name')}}
                        </span>
                        @enderror
                    </div>

                    {{--Email--}}
                    <div class="col-sm-6 mb-6">
                        <label for="email" class="required form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control form-control-solid"
                               placeholder="Email" readonly
                               value="{{ $user->email }}"
                        />
                        @error('email')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('email')}}
                        </span>
                        @enderror
                    </div>

                    {{--Phone--}}
                    <div class="col-sm-6 mb-6">
                        <label for="phone" class="required form-label">Phone</label>
                        <input type="text" id="phone" name="phone" class="form-control"
                               placeholder="Phone" required
                               value="{{ $user->profile->phone }}"
                        />
                        @error('phone')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('phone')}}
                        </span>
                        @enderror
                    </div>

                    {{--Password--}}
                    <div class="col-sm-6 mb-6">
                        <label for="password" class="required form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="Password"
                               value="{{ old('password') }}"
                        />
                        @error('password')
                        <span class="text-danger m-0 p-0" role="alert">
                            {{$errors->first('password')}}
                        </span>
                        @enderror
                    </div>

                    {{--Confirm Password--}}
                    <div class="col-sm-6 mb-6">
                        <label for="password_confirmation" class="required form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" placeholder="Confirm Password"
                               value="{{ old('password_confirmation') }}"
                        />
                    </div>

                    {{--Status--}}
                    <div class="col-sm-6 mb-6">
                        <label for="status" class="required form-label">Select a status</label>
                        <select id="status" name="status" class="form-select" aria-label="Select status" required>
                            <option disabled>Select a Status</option>
                            <option value=1 @if($user->status == 1) selected @endif>Active</option>
                            <option value=0 @if($user->status == 0) selected @endif>Inactive</option>
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
