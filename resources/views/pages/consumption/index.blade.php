@extends('layouts.master')

@section('consumption')
    hover show
@endsection

@section('consumption.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Consumption
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Consumption</li>
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
                    <div class="col-md-4">
                        <label for="location" class="form-label required">Location</label>
                        <select id="location" name="location" class="form-select"
                                aria-label="Assign a location" required>
                            <option disabled>Assign a Location</option>
                            @foreach($locations as $location)
                                <option
                                    {{ request()->get('location') == $location->id ? "selected" : "" }} value="{{ $location->id }}">
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('location')
                        <span class="text-danger m-0 p-0" role="alert">{{$errors->first('location')}}</span>
                        @enderror
                    </div>


                    {{--Date--}}
                    <div class="col-md-4">
                        <label class="form-label required">Date</label>
                        <input class="form-control" placeholder="Pick a date"
                               id="date" name="date" required/>
                        @error('date')
                        <span class="text-danger m-0 p-0" role="alert">{{$errors->first('date')}}</span>
                        @enderror
                    </div>

                    <div class="col-md-4 mt-8">
                        <button type="submit" class="btn btn-info hover-scale">
                            <i class="fa-solid fa-filter fs-1"></i>Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
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
                           class="form-control form-control-solid w-250px ps-14"
                           placeholder="Search item"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_consumption">
                <!--begin::Table head-->
                <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Unit</th>
                    <th class="min-w-125px">Date</th>
                    <th class="min-w-125px">Quantity</th>
                    <th class="min-w-125px">Action</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                @foreach($consumptions as $item)
                    <!--begin::Table row-->
                    <tr>
                        <td>{{$item->item->name}}</td>

                        <td><span class="badge badge-light-info">{{$item->item->unit}}</span></td>

                        <td>{{$item->consumption_date}}</td>

                        <td>{{$item->quantity}}</td>

                        <td>
                            <form role="form" method="POST"
                                  action="{{ route('consumption.destroy', $item->id) }}">
                                @csrf
                                @method('Delete')
                                <button type="submit" class="btn btn-icon btn-danger">
                                    <i class="la la-trash-o fs-3"></i>
                                </button>
                            </form>
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
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->

    <script>
        const table = $('#kt_table_consumption').DataTable();

        // #searchInput is a <input type="text"> element
        $('#searchInput').on('keyup', function () {
            table.search(this.value).draw();
        });
    </script>

    {{--date picker--}}
    <script>

        const maxDate = new Date();

        const queryString = window.location.search; // get url parameter
        const dateParam = new URLSearchParams(queryString).get('date'); // get date value from the parameter
        const dateArray = dateParam != null ? dateParam.split(" - ") : null;

        const start = dateArray != null ? moment(dateArray[0]) : moment().subtract(29, "days");
        const end = dateArray != null ? moment(dateArray[1]) : moment();

        function cb(start, end) {
            $("#date").html(start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY"));
        }

        $('#date').daterangepicker({
            startDate: start,
            endDate: end,
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
            },
            maxDate: maxDate,
        }, cb);

        cb(start, end);
    </script>
@endsection
