@extends('layouts.master')

@section('permissions.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Permissions List
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Permission Management</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-400 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <li class="breadcrumb-item text-muted">Permissions</li>
    <!--end::Item-->
@endsection

@section('page_css')
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('page_content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                  height="2" rx="1"
                                  transform="rotate(45 17.0365 15.1223)"
                                  fill="currentColor"/>
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="currentColor"/>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input id="searchInput" type="text" data-kt-user-table-filter="search"
                           class="form-control form-control-solid w-250px ps-14" placeholder="Search permission"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <button type="button" class="btn btn-info hover-scale" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_permission">
                    <!--begin::Svg Icon-->
                    <span class="svg-icon svg-icon-2">
                             <i class="fa-solid fa-plus fs-2"></i>
                        </span>
                    <!--end::Svg Icon-->
                    Add Permission
                </button>

                <div class="modal fade" tabindex="-1" id="kt_modal_permission">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Create Permission</h3>

                                <!--begin::Close-->
                                <div class="btn btn-icon btn-sm btn-active-light-info ms-2" data-bs-dismiss="modal"
                                     aria-label="Close">
                                    <span class="svg-icon svg-icon-1">
                                        <i class="fa-solid fa-xmark text-info"></i>
                                    </span>
                                </div>
                                <!--end::Close-->
                            </div>

                            <form role="form" method="POST" action="{{ route('permissions.store') }}">
                                @csrf
                                <div class="modal-body">

                                    <div class="row mt-4">
                                        {{--Name--}}
                                        <div class="col-12 mb-6">
                                            <label for="name" class="required form-label">Name</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                   placeholder="Name" required
                                                   value="{{ old('name') }}"
                                            />
                                            <span id="error" class="text-danger m-0 p-0" role="alert">
                                            {{$errors->first('name')}}
                                        </span>

                                            @error('name')
                                            <span class="text-danger m-0 p-0" role="alert">
                                            {{$errors->first('name')}}
                                        </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-info">
                                        Create
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_permissions">
                <!--begin::Table head-->
                <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Guard Name</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                @foreach($permissions as $permission)
                    <!--begin::Table row-->
                    <tr>

                        <!--begin::Name-->
                        <td>
                            {{$permission->name}}
                        </td>
                        <!--end::Name=-->

                        <!--begin::Guard Name-->
                        <td>
                            <span class="badge badge-light-info ">{{$permission->guard_name}}</span>
                        </td>
                        <!--end::Guard Name-->

                        <!--begin::Action=-->
                        <td class="text-end">
                            <a href="#" class="btn btn-light btn-active-light-info btn-sm"
                               data-kt-menu-trigger="click"
                               data-kt-menu-placement="bottom-end">Actions
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                            fill="currentColor"/>
                                    </svg>
                                </span>
                                <!--end::Svg Icon--></a>
                            <!--begin::Menu-->
                            <div
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary  fw-semibold fs-7 w-125px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <form role="form" method="POST"
                                          action="{{ route('permissions.destroy', $permission->id) }}">
                                        @csrf
                                        @method('Delete')
                                        <button type="submit"
                                                class="btn btn-sm btn-white btn-active-light-info dropdown-item">
                                            <i class="fa-solid fa-trash text-info me-2"></i> Delete
                                        </button>
                                    </form>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                        <!--end::Action=-->
                    </tr>
                    <!--end::Table row-->
                @endforeach
                </tbody>
                <!--end::Table body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>
@endsection


@section('page_scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->

    <script>
        // Begin::DataTable
        const table = $('#kt_table_permissions').DataTable();

        // #searchInput is a <input type="text"> element
        $('#searchInput').on('keyup', function () {
            table.search(this.value).draw();
        });
        // END::DataTable

        // Begin::Modal
        $(document).ready(function () {
            $('#kt_modal_permission').modal({
                backdrop: 'static',
                keyboard: false
            })
        });

        // END::Modal
    </script>
@endsection
