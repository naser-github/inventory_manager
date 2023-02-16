@extends('layouts.master')

@section('dashboard.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Dashboard
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Dashboard</li>
    <!--end::Item-->
@endsection

@section('page_css')
    <style>
        table, th, td {
            border: 1px groove lightgrey !important;
            border-collapse: collapse !important;
        }
    </style>
@endsection

@section('page_content')
    <div class="card card-flush shadow-sm mb-5">
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
                    <div class="col-lg-4">
                        <label class="form-label required">Date</label>
                        <input class="form-control" placeholder="Pick a date"
                               id="date" name="date" required/>
                        @error('date')
                        <span class="text-danger m-0 p-0" role="alert">{{$errors->first('date')}}</span>
                        @enderror
                    </div>

                    <div class="col-lg-2 mt-8">
                        <button type="submit" class="btn btn-block btn-info hover-scale">
                            <i class="fa-solid fa-filter fs-6"></i>Filter
                        </button>
                    </div>

                    @if($exportable)
                        <div class="col-lg-2 mt-8">
                            <button type="button" class="btn btn-block btn-info hover-scale" onclick="exportReport()">
                                <i class="fa-solid fa-filter fs-6"></i>Export
                            </button>
                        </div>
                    @endif
                </div>

            </form>
        </div>
    </div>

    @if($exportable === true && count($stock_report_data)===0)
        <!--begin::Alert-->
        <div class="alert alert-dismissible bg-info d-flex flex-column flex-sm-row p-5 mb-10 justify-content-center">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column justify-content-between pe-0 pe-sm-10">
                <!--begin::Title-->
                <h4 class="fw-semibold text-white">No Data Found</h4>
                <!--end::Title-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Alert-->
    @elseif($exportable === true && count($stock_report_data)>0)
        <div class="card card-flush shadow-sm">
            <div class="card-body py-5">

                <div class="table-responsive text-center">
                    <table class="table table-bordered table-rounded gy-7 gs-7">
                        <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th rowspan="2" class="align-middle w-10px">ক্রমিক নং</th>
                            <th rowspan="2" class="align-middle">বিবরণী</th>
                            <th colspan="8" class="text-center">মজুদ মালের পরিমান</th>
                            <th rowspan="2" class="align-middle">টাকা</th>
                        </tr>
                        <tr class="fw-semibold fs-6 text-gray-800">
                            <th>প্রারম্ভিক</th>
                            <th>দর</th>
                            <th>টাকা</th>
                            <th>ক্রয়</th>
                            <th>দর</th>
                            <th>বিক্রয়</th>
                            <th colspan="2">সমাপনী</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stock_report_data as $key=>$item)
                            <tr>
                                <td>
                                    {{$bangla_number->bnCommaLakh($key+1)}}
                                </td>
                                <td>
                                    {{$item['item_name']}}
                                </td>
                                <td>
                                    {{
                                        $bangla_number->bnCommaLakh(
                                            round(
                                                $item['opening_quantity']
                                            ,2)
                                        )
                                    }}
                                </td>
                                <td>
                                    {{
                                        $bangla_number->bnCommaLakh(
                                            round(
                                                $item['opening_unit_price']
                                            ,2)
                                        )
                                    }}
                                </td>
                                <td>
                                    {{
                                        $bangla_number->bnCommaLakh(
                                            round(
                                                $item['opening_quantity']*$item['opening_unit_price']
                                            ,2)
                                        )
                                    }}
                                </td>
                                <td>
                                    {{$item['inbound_quantity']!=null?
                                        $bangla_number->bnCommaLakh(
                                            round(
                                                $item['inbound_quantity']
                                            ,2)
                                        ):null
                                    }}
                                </td>
                                <td>
                                    {{$item['inbound_unit_price']!=null?
                                        $bangla_number->bnCommaLakh(
                                            round(
                                                $item['inbound_unit_price']
                                            ,2)
                                        ):null
                                    }}
                                </td>
                                <td>
                                    {{$item['consumption_quantity']!=null?
                                        $bangla_number->bnCommaLakh(
                                            round(
                                                $item['consumption_quantity']
                                            ,2)
                                        ):null
                                    }}
                                </td>
                                <td>
                                    {{$item['opening_quantity'] + $item['inbound_quantity'] - $item['consumption_quantity']!=null?
                                        $bangla_number->bnCommaLakh(
                                            round(
                                                $item['opening_quantity'] + $item['inbound_quantity'] - $item['consumption_quantity']
                                            ,2)
                                        ):null
                                    }}
                                </td>
                                <td>
                                    {{$item['item_unit']}}
                                </td>
                                <td>
                                    @if(($item['opening_quantity']*$item['opening_unit_price']+$item['inbound_quantity']*$item['inbound_unit_price'])>0)
                                        {{
                                        $bangla_number->bnCommaLakh
                                        (
                                            round(
                                                ($item['opening_quantity']*$item['opening_unit_price']+$item['inbound_quantity']*$item['inbound_unit_price'])
                                                -
                                                (
                                                    (
                                                        (
                                                            $item['opening_quantity']*$item['opening_unit_price']
                                                            +
                                                            $item['inbound_quantity']*$item['inbound_unit_price']
                                                        )
                                                        /
                                                        ($item['opening_quantity']+$item['inbound_quantity'])
                                                    )
                                                    *
                                                    $item ['consumption_quantity']
                                                )
                                            ,2)
                                        )
                                        }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('page_scripts')
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

    <script>
        function exportReport() {
            var location = document.querySelector('[name="location"]').value;
            var date = document.querySelector('[name="date"]').value;

            console.log(typeof location, location, typeof date, date)

            $.ajax({
                type: 'GET',
                url: "{!! route('export.report') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    date,
                    location,
                },
                xhrFields: {
                    responseType: 'blob'
                },
                success: function (data) {
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(data);
                    link.download = `report.xlsx`;
                    link.click();
                },
                fail: function (data) {
                    alert('Not downloaded');
                    //console.log('fail',  data);
                }


            });
        }
    </script>
@endsection
