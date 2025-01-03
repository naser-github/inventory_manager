@extends('layouts.master')

@section('purchase_inbound')
    hover show
@endsection

@section('purchase_inbound.index')
    active
@stop

@section('breadcrumb_navigation_title')
    List
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
    <li class="breadcrumb-item text-muted">List</li>
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
                           class="form-control form-control-solid w-250px ps-14" placeholder="Search purchase inbound"/>
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_purchase_inbound">
                <!--begin::Table head-->
                <thead>
                <!--begin::Table row-->
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">PI Number</th>
                    <th class="min-w-125px">Reference Number</th>
                    <th class="min-w-125px">Inbound Date</th>
                    <th class="min-w-125px">Vendor</th>
                    <th class="min-w-125px">Status</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                <!--end::Table row-->
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody class="text-gray-600 fw-semibold">
                @foreach($purchase_inbounds as $item)
                    <!--begin::Table row-->
                    <tr>
                        <td>
                            {{$item->purchase_inbound_number}}
                        </td>

                        <td>
                            {{$item->reference_invoice_number}}
                        </td>

                        <td>
                            {{$item->raised_date}}
                        </td>

                        <td>
                            {{$item->vendor?->name}}
                        </td>

                        <td>
                            <span class="badge badge-light-{{ $item->purchaseInboundStatus?->status == \App\Http\Enums\PurchaseInboundStatusEnum::PENDING ? 'warning' : ($item->purchaseInboundStatus?->status == \App\Http\Enums\PurchaseInboundStatusEnum::APPROVED ? 'success' : 'danger') }}">
                                @if($item->purchaseInboundStatus?->status == \App\Http\Enums\PurchaseInboundStatusEnum::PENDING)
                                    Pending
                                @elseif($item->purchaseInboundStatus?->status == \App\Http\Enums\PurchaseInboundStatusEnum::APPROVED)
                                    Active
                                @elseif($item->purchaseInboundStatus?->status == \App\Http\Enums\PurchaseInboundStatusEnum::CANCELLED)
                                    Cancelled
                                @endif
                            </span>
                        </td>

                        <!--begin::Action=-->
                        <td class="text-end">
                            <div class="dropdown">
                                <button type="button" class="btn btn-light btn-active-light-info btn-sm"
                                        id="actionButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                fill="currentColor"/>
                                        </svg>
                                    </span>
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="actionButton">
                                    <li>
                                        <!--begin::Menu item-->
                                        <a href="{{route('purchase_inbound.show', $item->id)}}"
                                           class="btn btn-sm btn-white btn-active-info dropdown-item">
                                            <i class="fa-solid fa-eye me-2"></i> View
                                        </a>
                                        <!--end::Menu item-->


                                        @if(\App\Http\Enums\PurchaseInboundStatusEnum::isPending($item->purchaseInboundStatus?->status))
                                            <!--begin::Menu item-->
                                            <form role="form" method="POST"
                                                  action="{{ route('purchase_inbound.approve', $item->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="btn btn-sm btn-white btn-active-info dropdown-item">
                                                    <i class="fa-solid fa-check me-2"></i> Approve
                                                </button>
                                            </form>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <form role="form" method="POST"
                                                  action="{{ route('purchase_inbound.cancel', $item->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="btn btn-sm btn-white btn-active-info dropdown-item">
                                                    <i class="fa-solid fa-ban me-2"></i> Cancel
                                                </button>
                                            </form>
                                            <!--end::Menu item-->
                                        @endif


                                        <!--begin::Menu item-->
                                        <form role="form" method="POST"
                                              action="{{ route('purchase_inbound.destroy', $item->id) }}">
                                            @csrf
                                            @method('Delete')
                                            <button type="submit"
                                                    class="btn btn-sm btn-white btn-active-info dropdown-item">
                                                <i class="la la-trash-o me-3"></i> Delete
                                            </button>
                                        </form>
                                        <!--end::Menu item-->
                                    </li>
                                </ul>
                            </div>
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

    <!--begin::Datatable-->
    <script>
        $(document).ready(function () {
            const table = $('#kt_table_purchase_inbound').DataTable({
                order: []
            });

            // #searchInput is a <input type="text"> element
            $('#searchInput').on('keyup', function () {
                table.search(this.value).draw();
            });
        })
        q

    </script>
    <!--End::Datatable-->
@endsection
