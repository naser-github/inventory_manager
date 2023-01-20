@extends('layouts.master')

@section('inventory.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Inventory
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Inventory</li>
    <!--end::Item-->
@endsection

@section('page_css')
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('page_content')
    <div class="card card-flush shadow-sm">
        <div class="card-body py-5">
            <form role="form" method="GET">
                @csrf
                <div class="row">
                    {{--Locaiton--}}
                    <div class="col-lg-4">
                        <label for="location" class="form-label required">Location</label>
                        <select id="location" name="location" class="form-select"
                                aria-label="Assign a location" required>
                            <option disabled>Assign a Location</option>
                            @foreach($locations as $location)
                                <option {{ request()->get('location') == $location->id ? "selected" : "" }} value="{{ $location->id }}">
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('location')
                        <span class="text-danger m-0 p-0" role="alert">{{$errors->first('location')}}</span>
                        @enderror
                    </div>

                    {{--Date--}}
                    <div class="col-lg-4">
                        <label class="form-label required">Date</label>
                        <input class="form-control" placeholder="Pick a date"
                               id="date" name="date" required/>
                        @error('date')
                        <span class="text-danger m-0 p-0" role="alert">{{$errors->first('date')}}</span>
                        @enderror
                    </div>

                    <div class="col-lg-2 mt-8">
                        <button type="submit" class="btn btn-info hover-scale">
                            <i class="fa-solid fa-filter fs-6"></i>Filter
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="card my-6">
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
                           class="form-control form-control-solid w-250px ps-14" placeholder="Search inventory items"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_inventory">
                <!--begin::Table head-->
                <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Item Name</th>
                    <th class="min-w-125px">Quantity</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                @foreach($inventory as $inventoryItem)
                    <!--begin::Table row-->
                    <tr>
                        <td>
                            {{$inventoryItem->item?$inventoryItem->item->name:$inventoryItem->stock->item->name}}
                        </td>

                        <td>
                            {{$inventoryItem->quantity}}
                        </td>
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
        const table = $('#kt_table_inventory').DataTable();

        // #searchInput is a <input type="text"> element
        $('#searchInput').on('keyup', function () {
            table.search(this.value).draw();
        });
    </script>

    // date picker
    <script>

        const queryString = window.location.search; // get url parameter
        const dateParam = new URLSearchParams(queryString).get('date'); // get date value from the parameter

        const maxDate = new Date();

        $("#date").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                maxDate: maxDate,
                minYear: 2023,
                maxYear: parseInt(moment().format("YYYY"), 12),
                startDate: dateParam != null ? dateParam : maxDate,
            }
        );
    </script>
@endsection
