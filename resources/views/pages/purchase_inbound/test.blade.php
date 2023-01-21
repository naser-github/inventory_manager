@extends('layouts.master')

@section('purchase_inbound')
    hover show
@endsection

@section('purchase_inbound.create')
    active
@stop

@section('breadcrumb_navigation_title')
    Create
@endsection

@section('breadcrumb_navigation_path')
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">Purchase Inbound</li>
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
    <form id="purchase_inbound_form" role="form" method="POST" action="{{ route('purchase_inbound.store') }}">
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
        <div class="card card-flush shadow-sm">
            <div class="card-body py-5">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="mb-0">
                            <label for="raised_date" class="form-label required">Raised Date</label>
                            <input class="form-control" placeholder="Pick raised date"
                                   id="raised_date" name="raised_date" required/>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-0">
                            <label for="reference_invoice_number" class="form-label required">Reference Number</label>
                            <input type="text" class="form-control" placeholder="Invoice Number"
                                   id="reference_invoice_number" name="reference_invoice_number" required/>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="vendor_id" class="form-label required">Vendor</label>
                        <select id="vendor_id" name="vendor_id" class="form-select" data-control="select2"
                                data-placeholder="Select a vendor" required>
                            <option></option>
                            @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label for="location_id" class="form-label required">Location</label>
                        <select id="location_id" name="location_id" class="form-select" data-control="select2"
                                data-placeholder="Select a location" required>
                            <option></option>
                            @foreach($locations as $location)
                                <option value="{{$location->id}}">{{$location->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-flush shadow-sm my-10">
            <div class="card-body mb-0 pb-0 pt-5">

                <!--begin::Form group-->
                <div class="d-flex justify-content-end mb-4">
                    <div class="form-group">
                        <button class="btn btn-sm btn-info hover-scale" onClick="generateField()">
                            <i class="la la-plus"></i>Add
                        </button>
                    </div>
                </div>
                <!--end::Form group-->

                <!--begin::Form group-->

                <div id="purchase_inbound_items" class="form-group row mb-5">
                    <p id="GFG_DOWN" class="mb-5"></p>
                </div>
                >
                <!--end::Form group-->

            </div>

            <div class="card-footer">
                <div class="row">
                    {{--sub total--}}
                    <div class="d-flex justify-content-end align-items-center col-md-9 mb-4 me-4">
                        <label for="sub_total" class="form-label">Sub Total</label>
                    </div>
                    <div class="col-md-2 mb-4">
                        <input type="number" step="any" id="sub_total" name="sub_total"
                               class="form-control" required/>
                    </div>

                    {{--others--}}
                    <div class="d-flex justify-content-end align-items-center col-md-9 mb-4 me-4">
                        <label for="others" class="form-label">Others</label>
                    </div>
                    <div class="col-md-2 mb-4">
                        <input type="number" step="any" id="others" name="others"
                               class="form-control" required/>
                    </div>

                    {{--total--}}
                    <div class="d-flex justify-content-end align-items-center col-md-9 mb-4 me-4">
                        <label for="total" class="form-label">Total</label>
                    </div>
                    <div class="col-md-2 mb-4">
                        <input type="number" step="any" id="total" name="total"
                               class="form-control"/>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" id="submit_purchase" class="btn btn-info">Purchase</button>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('page_scripts')
    {{--    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>--}}

    <!--begin::Date Picker-->
    <script>
        $("#raised_date").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                autoApply: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"), 12)
            }
        );
    </script>
    <!--End::Date Picker-->

    <script>
        var down = document.getElementById("GFG_DOWN");

        let rows = 0;

        function generateField() {

            rows++;
            // Create a form dynamically
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "submit.php");

            // Create an input element item quantity
            let quantity = document.createElement("input");
            quantity.setAttribute("type", "number");
            quantity.setAttribute("name", "quantity_" + rows);
            quantity.setAttribute("placeholder", "Quantity");
            quantity.classList.add('form-control')

            // Create an input element item unit price
            let unit_price = document.createElement("input");
            unit_price.setAttribute("type", "number");
            unit_price.setAttribute("name", "unit_price_" + rows);
            unit_price.setAttribute("placeholder", "Unit Price");
            unit_price.classList.add('form-control')

            // Create an input element item quantity
            let sub_total = document.createElement("input");
            sub_total.setAttribute("type", "number");
            sub_total.setAttribute("name", "sub_total_" + rows);
            sub_total.setAttribute("placeholder", "Sub Total");
            sub_total.classList.add('form-control')


            // // Create a submit button
            // var s = document.createElement("input");
            // s.setAttribute("type", "submit");
            // s.setAttribute("value", "Submit");

            // Append the email_ID input to the form
            form.append(quantity);

            // Append the password to the form
            form.append(unit_price);

            // // Append the button to the form
            // form.append(s);

            document.getElementById("purchase_inbound_items").appendChild(form);
        }
    </script>
@endsection

