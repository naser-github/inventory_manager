@extends('layouts.master')

@section('consumption')
    hover show
@endsection

@section('consumption.add')
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



@section('page_content')
    <form role="form" method="POST" action="{{ route('consumption.store') }}">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card card-flush shadow-sm mb-4">
            <div class="card-body py-5">
                <div class="row mb-4">
                    <div class="col-md-3 my-2">
                        <label for="location_id" class="form-label required">Location</label>
                        <select id="location_id" name="location_id" class="form-select"
                                data-control="select2" data-placeholder="Select a location"
                                oninput="showConsumptionPortal()"
                                required>
                            <option></option>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6 my-2">
                        <label class="form-label required">Received By</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="name"
                               value="{{ old('name') }}" required/>
                    </div>

                    <div class="col-md-3 my-2">
                        <div class="mb-0">
                            <label for="consumption_date" class="form-label required">Consumption Date</label>
                            <input id="consumption_date" name="consumption_date" class="form-control"
                                   placeholder="Pick a date" required/>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--begin::Consumption Portal-->
        <div id="consumptionPortal" class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10"></div>
        <!--end::Consumption Portal-->
    </form>
@endsection


@section('page_scripts')

    <script>
        $("#consumption_date").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                minYear: 1901,
                maxDate: new Date(),
                maxYear: parseInt(moment().format("YYYY"), 12)
            }
        );
    </script>

    <script>
        function showConsumptionPortal() {
            var locationId = document.getElementById("location_id").value;

            $.ajax({
                type: 'POST',
                url: "{!! route('consumption.consumption_portal') !!}",
                cache: false,
                data: {
                    _token: "{{csrf_token()}}",
                    'location_id': locationId
                },
                success: function (data) {
                    $('#consumptionPortal').html(data);
                }
            });
        }
    </script>
@endsection
