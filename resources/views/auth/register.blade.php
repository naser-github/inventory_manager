@extends('layouts.app')
@section('auth_page_content')
    <!--begin::Form-->
    <form method="POST" action="{{ route('register') }}" class="form w-100" novalidate="novalidate"
          id="kt_sign_up_form">
        @csrf
        <!--begin::Heading-->
        <div class="text-center mb-11">
            <!--begin::Title-->
            <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
            <!--end::Title-->
            <!--begin::Subtitle-->
            {{--            <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>--}}
            <!--end::Subtitle=-->
        </div>
        <!--begin::Heading-->

        <!--begin::Separator-->
        <div class="separator separator-content my-14">
            <span class="w-125px text-gray-500 fw-semibold fs-7">credential</span>
        </div>
        <!--end::Separator-->

        <!--begin::Input group-->
        <div class="fv-row mb-6">
            <div>
                <!--begin::Name-->
                <input id="name" type="text" name="name" placeholder="Name" autocomplete="off"
                       class="form-control bg-transparent" value="{{ old('name') }}" required
                />
                @error('name')
                <span class="text-danger m-0 p-0" role="alert">{{$errors->first('name')}}</span>
                @enderror
            </div>
            <!--end::Name-->
        </div>
        <!--end::Input group=-->

        <!--begin::Input group-->
        <div class="fv-row mb-6">
            <div>
                <!--begin::Email-->
                <input id="email" type="email" name="email" placeholder="Email" autocomplete="off"
                       class="form-control bg-transparent" value="{{ old('email') }}" required/>
                <!--end::Email-->
                @error('email')
                <span class="text-danger m-0 p-0" role="alert">{{$errors->first('email')}}</span>
                @enderror
            </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-6">
            <div>
                <!--begin::Phone-->
                <input id="phone" type="text" name="phone" placeholder="Phone Number" autocomplete="off"
                       class="form-control bg-transparent" value="{{ old('phone') }}" required/>
                <!--end::Phone-->
                @error('phone')
                <span class="text-danger m-0 p-0" role="alert">{{$errors->first('phone')}}</span>
                @enderror
            </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-6">
            <div>
                <!--begin::Password-->
                <input id="password" type="password" name="password" autocomplete="off" placeholder="Password" required
                       class="form-control bg-transparent"/>
                <!--end::Password-->
                @error('password')
                <span class="text-danger m-0 p-0" role="alert">{{$errors->first('password')}}</span>
                @enderror
            </div>
        </div>
        <!--end::Input group-->

        <!--begin::Input group-->
        <div class="fv-row mb-6">
            <!--begin::Confirm Password-->
            <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="off"
                   placeholder="Confirm Password" required
                   class="form-control bg-transparent"/>
            <!--end::Password-->
        </div>
        <!--end::Input group-->

        <!--begin::Submit button-->
        <div class="d-grid mb-10">
            <button type="submit" id="kt_sign_in_submit" class="btn btn-info">
                <!--begin::Indicator label-->
                <span class="indicator-label">Sign Up</span>
                <!--end::Indicator label-->
                <!--begin::Indicator progress-->
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
                <!--end::Indicator progress-->
            </button>
        </div>
        <!--end::Submit button-->
        <!--begin::Sign up-->
        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
            <a href="{{route('login')}}"
               class="link-primary">Sign In</a></div>
        <!--end::Sign up-->
    </form>
    <!--end::Form-->
@endsection

{{--<x-guest-layout>--}}
{{--    <form method="POST" action="{{ route('register') }}">--}}
{{--        @csrf--}}

{{--        <!-- Name -->--}}
{{--        <div>--}}
{{--            <x-input-label for="name" :value="__('Name')" />--}}
{{--            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />--}}
{{--            <x-input-error :messages="$errors->get('name')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Email Address -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="email" :value="__('Email')" />--}}
{{--            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />--}}
{{--            <x-input-error :messages="$errors->get('email')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password" :value="__('Password')" />--}}

{{--            <x-text-input id="password" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password"--}}
{{--                            required autocomplete="new-password" />--}}

{{--            <x-input-error :messages="$errors->get('password')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <!-- Confirm Password -->--}}
{{--        <div class="mt-4">--}}
{{--            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />--}}

{{--            <x-text-input id="password_confirmation" class="block mt-1 w-full"--}}
{{--                            type="password"--}}
{{--                            name="password_confirmation" required />--}}

{{--            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />--}}
{{--        </div>--}}

{{--        <div class="flex items-center justify-end mt-4">--}}
{{--            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">--}}
{{--                {{ __('Already registered?') }}--}}
{{--            </a>--}}

{{--            <x-primary-button class="ml-4">--}}
{{--                {{ __('Register') }}--}}
{{--            </x-primary-button>--}}
{{--        </div>--}}
{{--    </form>--}}
{{--</x-guest-layout>--}}
