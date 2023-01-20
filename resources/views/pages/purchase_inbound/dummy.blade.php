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
                            <label class="form-label required">Raised Date</label>
                            <input class="form-control" placeholder="Pick raised date"
                                   id="raised_date" name="raised_date" required/>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-0">
                            <label class="form-label required">Reference Number</label>
                            <input type="text" class="form-control" placeholder="Invoice Number"
                                   id="reference_invoice_number" name="reference_invoice_number" required/>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label required">Vendor</label>
                        <select id="vendor_id" name="vendor_id" class="form-select" data-control="select2"
                                data-placeholder="Select a vendor" required>
                            <option></option>
                            @foreach($vendors as $vendor)
                                <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label required">Location</label>
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
                <!--begin::Repeater-->
                <div id="purchase_inbound_items" class="pt-6">
                    <!--begin::Form group-->
                    <div class="d-flex justify-content-end mb-4">
                        <div class="form-group">
                            <a href="javascript:;" data-repeater-create class="btn btn-sm btn-info hover-scale ">
                                <i class="la la-plus"></i>Add
                            </a>
                        </div>
                    </div>
                    <!--end::Form group-->

                    <!--begin::Form group-->
                    <div class="form-group purchase">
                        <div data-repeater-list="purchase_inbound_items">
                            <div data-repeater-item>
                                <div class="form-group row mb-5">
                                    <div class="col-md-2">
                                        <label class="form-label required">Select an Item</label>
                                        <select name="item_id" class="form-select" data-kt-repeater="select2"
                                                data-placeholder="Select an option" required>
                                            <option></option>
                                            @foreach($items as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label required">Quantity</label>
                                        <input type="number" step="any" id="item_quantity" name="quantity"
                                               class="form-control" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label required">Unit Price</label>
                                        <input type="number" step="any" id="item_unit_price" name="unit_price"
                                               class="form-control" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Sub Total</label>
                                        <input type="number" step="any" id="item_sub_total" name="sub_total"
                                               class="form-control" required/>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Vat</label>
                                        <input type="number" step="any" id="item_vat" name="vat"
                                               class="form-control" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Total</label>
                                        <input type="number" step="any" id="item_total" name="total"
                                               class="form-control" required/>
                                    </div>
                                    <div class="col-md-1">
                                        <label class="form-label">Remark</label>
                                        <input type="text" id="item_remark" name="remark"
                                               class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Form group-->

                </div>
                <!--end::Repeater-->
            </div>

            <div class="card-footer">
                <div class="row">
                    {{--sub total--}}
                    <div class="d-flex justify-content-end align-items-center col-md-9 mb-4 me-4">
                        <label class="form-label">Sub Total</label>
                    </div>
                    <div class="col-md-2 mb-4">
                        <input type="number" step="any" id="sub_total" name="sub_total"
                               class="form-control" required/>
                    </div>

                    {{--others--}}
                    <div class="d-flex justify-content-end align-items-center col-md-9 mb-4 me-4">
                        <label class="form-label">Others</label>
                    </div>
                    <div class="col-md-2 mb-4">
                        <input type="number" step="any" id="others" name="others"
                               class="form-control" required/>
                    </div>

                    {{--total--}}
                    <div class="d-flex justify-content-end align-items-center col-md-9 mb-4 me-4">
                        <label class="form-label">Total</label>
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
    <script src="{{asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js')}}"></script>

    <!--begin::Date Picker-->
    <script>
        $("#raised_date").daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().format("YYYY"), 12)
            },
            function (start, end, label) {
                var years = moment().diff(start, "years");
                alert("You are " + years + " years old!");
            }
        );
    </script>
    <!--End::Date Picker-->

    <!--begin::repeater-->
    <script>
        $('#purchase_inbound_items').repeater({
            initEmpty: false,

            defaultValues: {
                'text-input': 'foo'
            },

            show: function () {
                $(this).slideDown();

                // Re-init select2
                $(this).find('[data-kt-repeater="select2"]').select2();
            },

            hide: function (deleteElement) {
                $(this).slideUp(deleteElement);
            },

            ready: function () {
                // Init select2
                $('[data-kt-repeater="select2"]').select2();
            }
        });
    </script>
    <!--End::repeater-->
@endsection

