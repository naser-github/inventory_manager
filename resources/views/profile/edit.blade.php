@extends('layouts.master')

@section('breadcrumb_navigation_title')
    Profile
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Profile</li>
    <!--end::Item-->
@endsection

@section('page_content')
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body py-4">
            <form role="form" method="POST" action="{{ route('profile.update', $user->id) }}">
                @csrf
                @method('Patch')

                <div class="row mt-4">

                    {{--Name--}}
                    <div class="col-sm-12 mb-6">
                        <label for="name" class="required form-label">Name</label>
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
                        <label for="password" class="form-label">Password</label>
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
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control" placeholder="Confirm Password"
                               value="{{ old('password_confirmation') }}"
                        />
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
