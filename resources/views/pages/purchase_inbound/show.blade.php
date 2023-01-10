@extends('layouts.master')

@section('purchase_inbound')
    hover show
@endsection

@section('purchase_inbound.index')
    active
@stop

@section('breadcrumb_navigation_title')
    Detail
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
    <li class="breadcrumb-item text-muted">Detail</li>
    <!--end::Item-->
@endsection

@section('page_content')
    <div class="card card-flush shadow-sm mb-10">
        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
             data-bs-target="#card_purchase_inbound_detail">
            <h3 class="card-title">Purchase Inbound Detail</h3>
            <div class="card-toolbar rotate-180">
            <span class="svg-icon svg-icon-1">
                <i class="fa-solid fa-arrow-down fs-3"></i>
            </span>
            </div>
        </div>
        <div id="card_purchase_inbound_detail" class="collapse show">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td>Purchase Inbound Number</td>
                            <td class="fw-bold fs-6 text-gray-800">{{ $purchase_inbound->purchase_inbound_number }}</td>
                            <td>Raised Date</td>
                            <td class="fw-bold fs-6 text-gray-800">{{ $purchase_inbound->raised_date }}</td>
                        </tr>
                        <tr>
                            <td>Reference Number</td>
                            <td class="fw-bold fs-6 text-gray-800">{{ $purchase_inbound->reference_invoice_number }}</td>
                            <td>Vendor</td>
                            <td class="fw-bold fs-6 text-gray-800">{{ $purchase_inbound->vendor->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card card-flush shadow-sm">
        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
             data-bs-target="#card_purchase_inbound_items_detail">
            <h3 class="card-title">Purchase Inbound Items Detail</h3>
            <div class="card-toolbar rotate-180">
            <span class="svg-icon svg-icon-1">
                <i class="fa-solid fa-arrow-down fs-3"></i>
            </span>
            </div>
        </div>
        <div id="card_purchase_inbound_items_detail" class="collapse show">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-rounded table-striped border gy-7 gs-7">
                        <thead>
                        <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                            <th>Name</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Sub Total</th>
                            <th>Vat</th>
                            <th>Total</th>
                            <th>Remark</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchase_inbound->purchaseInboundItems as $inbound_item)
                            <tr>
                                <td>{{$inbound_item->item->name}}</td>
                                <td>
                                    <span class="badge badge-light-info">{{$inbound_item->item->unit}}</span>
                                </td>
                                <td>{{$inbound_item->quantity}}</td>
                                <td>{{$inbound_item->unit_price}}</td>
                                <td>{{$inbound_item->sub_total}}</td>
                                <td>{{$inbound_item->vat}}</td>
                                <td>{{$inbound_item->total}}</td>
                                <td>{{$inbound_item->remarks}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
