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
    <div class="d-flex flex-column flex-lg-row">
        <!--begin::Content-->
        <div class="flex-lg-row-fluid mb-10 mb-lg-0">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card body-->
                <div class="card-body p-12">
                    <!--begin::Form-->
                    {{--                    <form id="purchase_inbound_form" role="form" method="POST" action="{{ route('purchase_inbound.store') }}">--}}
                    <form action="" id="purchase_inbound_form">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column align-items-start flex-xxl-row">
                            <!--begin::Input group-->
                            <div class="d-flex align-items-center flex-equal fw-row me-4 order-2"
                                 data-bs-toggle="tooltip" data-bs-trigger="hover" title="Specify invoice date">
                                <!--begin::Date-->
                                <div class="fs-6 fw-bold text-gray-700 text-nowrap">Date:</div>
                                <!--end::Date-->
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center w-150px">
                                    <!--begin::Datepicker-->
                                    <input class="form-control form-control-transparent fw-bold pe-5"
                                           placeholder="Select date" name="invoice_date"/>
                                    <!--end::Datepicker-->
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-2 position-absolute ms-4 end-0">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<path
                                                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                                fill="currentColor"/>
																		</svg>
																	</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex flex-center flex-equal fw-row text-nowrap order-1 order-xxl-2 me-4"
                                 data-bs-toggle="tooltip" data-bs-trigger="hover" title="Enter invoice number">
                                <span class="fs-2x fw-bold text-gray-800">Invoice #</span>
                                <input type="text"
                                       class="form-control form-control-flush fw-bold text-muted fs-3 w-125px"
                                       value="2021001" placehoder="..."/>
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="d-flex align-items-center justify-content-end flex-equal order-3 fw-row"
                                 data-bs-toggle="tooltip" data-bs-trigger="hover" title="Specify invoice due date">
                                <!--begin::Date-->
                                <div class="fs-6 fw-bold text-gray-700 text-nowrap">Due Date:</div>
                                <!--end::Date-->
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center w-150px">
                                    <!--begin::Datepicker-->
                                    <input class="form-control form-control-transparent fw-bold pe-5"
                                           placeholder="Select date" name="invoice_due_date"/>
                                    <!--end::Datepicker-->
                                    <!--begin::Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-2 position-absolute end-0 ms-4">
																		<svg width="24" height="24" viewBox="0 0 24 24"
                                                                             fill="none"
                                                                             xmlns="http://www.w3.org/2000/svg">
																			<path
                                                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                                fill="currentColor"/>
																		</svg>
																	</span>
                                    <!--end::Svg Icon-->
                                    <!--end::Icon-->
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Top-->
                        <!--begin::Separator-->
                        <div class="separator separator-dashed my-10"></div>
                        <!--end::Separator-->
                        <!--begin::Wrapper-->
                        <div class="mb-0">

                            <!--begin::Table wrapper-->
                            <div class="table-responsive mb-10">
                                <!--begin::Table-->
                                <table class="table g-5 gs-0 mb-0 fw-bold text-gray-700" data-kt-element="items">
                                    <!--begin::Table head-->
                                    <thead>
                                    <tr class="border-bottom fs-7 fw-bold text-gray-700 text-uppercase">
                                        <th class="min-w-300px w-475px">Item</th>
                                        <th class="min-w-100px w-100px">QTY</th>
                                        <th class="min-w-150px w-150px">Price</th>
                                        <th class="min-w-100px w-150px text-end">Sub Total</th>
                                        <th class="min-w-100px w-150px text-end">Other</th>
                                        <th class="min-w-100px w-150px text-end">Total</th>
                                        <th class="min-w-75px w-75px text-end">Action</th>
                                    </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody>
                                    <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                        <td class="pe-7">
                                            <select name="id[]" class="form-select" data-control="select2"
                                                    data-placeholder="Select an item" data-kt-element="id"
                                                    required>
                                                <option></option>
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="ps-0">
                                            <input class="form-control form-control-solid" type="number" min="1"
                                                   name="quantity[]" placeholder="1" value="1"
                                                   data-kt-element="quantity"/>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control form-control-solid text-end"
                                                   name="unit_price[]" placeholder="0.00" value="0.00"
                                                   data-kt-element="unit_price"/>
                                        </td>
                                        <td class="pt-8 text-end text-nowrap">$
                                            <span data-kt-element="sub_total">0.00</span>
                                        </td>
                                        <td class="ps-0">
                                            <input class="form-control form-control-solid" type="number" min="1"
                                                   name="other[]" placeholder="1" value="1"
                                                   data-kt-element="other"/>
                                        </td>
                                        <td class="pt-8 text-end text-nowrap">$
                                            <span data-kt-element="total">0.00</span>
                                        </td>
                                        <td class="pt-5 text-end">
                                            <button type="button" class="btn btn-sm btn-icon btn-active-color-primary"
                                                    data-kt-element="remove-item">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                    <!--begin::Table foot-->
                                    <tfoot>
                                    <tr class="border-top border-top-dashed align-top fs-6 fw-bold text-gray-700">
                                        <th class="text-primary">
                                            <button class="btn btn-link py-1" data-kt-element="add-item">Add item
                                            </button>
                                        </th>
                                        <th colspan="2" class="border-bottom border-bottom-dashed ps-0">
                                            <div class="d-flex flex-column align-items-start">
                                                <div class="fs-5">Subtotal</div>
                                                <button class="btn btn-link py-1" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover" title="Coming soon">Add tax
                                                </button>
                                                <button class="btn btn-link py-1" data-bs-toggle="tooltip"
                                                        data-bs-trigger="hover" title="Coming soon">Add discount
                                                </button>
                                            </div>
                                        </th>
                                        <th colspan="2" class="border-bottom border-bottom-dashed text-end">$
                                            <span data-kt-element="sub-total">0.00</span></th>
                                    </tr>
                                    <tr class="align-top fw-bold text-gray-700">
                                        <th></th>
                                        <th colspan="2" class="fs-4 ps-0">Total</th>
                                        <th colspan="2" class="text-end fs-4 text-nowrap">$
                                            <span data-kt-element="grand-total">0.00</span></th>
                                    </tr>
                                    </tfoot>
                                    <!--end::Table foot-->
                                </table>
                            </div>
                            <!--end::Table-->
                            <!--begin::Item template-->
                            <table class="table d-none" data-kt-element="item-template">
                                <tr class="border-bottom border-bottom-dashed" data-kt-element="item">
                                    <td class="pe-7">
                                        <select name="id[]" class="form-select" data-control="select2"
                                                data-placeholder="Select an item" data-kt-element="id" required>
                                            <option></option>
                                            @foreach($items as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="ps-0">
                                        <input class="form-control form-control-solid" type="number" min="1"
                                               name="quantity[]" placeholder="1" data-kt-element="quantity"/>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-solid text-end"
                                               name="unit_price[]" placeholder="0.00" data-kt-element="unit_price"/>
                                    </td>
                                    <td class="pt-8 text-end text-nowrap">$
                                        <span data-kt-element="sub_total">0.00</span>
                                    </td>
                                    <td class="ps-0">
                                        <input class="form-control form-control-solid" type="number" min="1"
                                               name="other[]" placeholder="1" value="1"
                                               data-kt-element="other"/>
                                    </td>
                                    <td class="pt-8 text-end text-nowrap">$
                                        <span data-kt-element="total">0.00</span>
                                    </td>
                                    <td class="pt-5 text-end">
                                        <button type="button" class="btn btn-sm btn-icon btn-active-color-primary"
                                                data-kt-element="remove-item">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            </table>
                            <table class="table d-none" data-kt-element="empty-template">
                                <tr data-kt-element="empty">
                                    <th colspan="5" class="text-muted text-center py-10">No items</th>
                                </tr>
                            </table>
                            <!--end::Item template-->
                        </div>
                        <!--end::Wrapper-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content-->
    </div>
@endsection

@section('page_scripts')
    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="{{asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Vendors Javascript-->

    <script>
        "use strict";
        let KTAppInvoicesCreate = function () {
            let e, t = function () {
                let t = [].slice.call(e.querySelectorAll('[data-kt-element="items"] [data-kt-element="item"]')), a = 0,
                    n = wNumb({decimals: 2, thousand: ","});
                t.map((function (e) {
                    let t = e.querySelector('[data-kt-element="quantity"]'),
                        l = e.querySelector('[data-kt-element="unit_price"]'),
                        r = n.from(l.value);
                    r = !r || r < 0 ? 0 : r;
                    let i = parseInt(t.value);
                    i = !i || i < 0 ? 1 : i, l.value = n.to(r), t.value = i, e.querySelector('[data-kt-element="sub_total"]').innerText = n.to(r * i), a += r * i
                })), e.querySelector('[data-kt-element="sub-total"]').innerText = n.to(a), e.querySelector('[data-kt-element="grand-total"]').innerText = n.to(a)
            }, a = function () {
                if (0 === e.querySelectorAll('[data-kt-element="items"] [data-kt-element="item"]').length) {
                    let t = e.querySelector('[data-kt-element="empty-template"] tr').cloneNode(!0);
                    e.querySelector('[data-kt-element="items"] tbody').appendChild(t)
                } else KTUtil.remove(e.querySelector('[data-kt-element="items"] [data-kt-element="empty"]'))
            };
            return {
                init: function (n) {
                    (e = document.querySelector("#purchase_inbound_form")).querySelector('[data-kt-element="items"] [data-kt-element="add-item"]').addEventListener("click", (function (n) {
                        n.preventDefault();
                        let l = e.querySelector('[data-kt-element="item-template"] tr').cloneNode(!0);
                        e.querySelector('[data-kt-element="items"] tbody').appendChild(l), a(), t()
                    })), KTUtil.on(e, '[data-kt-element="items"] [data-kt-element="remove-item"]', "click", (function (e) {
                        e.preventDefault(), KTUtil.remove(this.closest('[data-kt-element="item"]')), a(), t()
                    })), KTUtil.on(e, '[data-kt-element="items"] [data-kt-element="quantity"], [data-kt-element="items"] [data-kt-element="unit_price"]', "change", (function (e) {
                        e.preventDefault(), t()
                    })), $(e.querySelector('[name="invoice_date"]')).flatpickr({
                        enableTime: !1,
                        dateFormat: "d, M Y"
                    }), $(e.querySelector('[name="invoice_due_date"]')).flatpickr({
                        enableTime: !1,
                        dateFormat: "d, M Y"
                    }), t()
                }
            }
        }();
        KTUtil.onDOMContentLoaded((function () {
            KTAppInvoicesCreate.init()
        }));

    </script>
@endsection

