@extends('layouts.dashboard.app')

@section('title')
    {{ __('dashboard.order_show') }}
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.orders_table') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">
                                        {{ __('dashboard.products') }}</a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{ __('dashboard.order_items') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                @include('dashboard.includes.button-header')
            </div>
            <div class="row" id="header-styling">
                <div class="col-md-12">
                    <div class="content-body">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-colored-form-control">
                                    {{ __('dashboard.order_items') }}
                                </h4>
                                <br>
                                <div class="btn-group">
                                    {{-- Mark as delivered  --}}
                                    @if ($orderWithItems->status !== 'delivered')
                                        <a href="{{ route('dashboard.orders.markDelivered', $orderWithItems->id) }}"
                                            class="btn btn-success"
                                            onclick="return confirm('{{ __('dashboard.confirm_mark_as_delivered') }}')">
                                            <i class="la la-truck me-1"></i>{{ __('dashboard.mark_as_delivered') }}
                                        </a>
                                    @endif

                                    {{-- Delete order --}}
                                    <form action="{{ route('dashboard.orders.destroy', $orderWithItems->id) }}"
                                        method="POST" onsubmit="return confirm('{{ __('dashboard.confirm_delete') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="la la-trash me-1"></i>{{ __('dashboard.delete_order') }}
                                        </button>
                                    </form>
                                </div>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>


                            <div class="card-content">
                                <div class="card-body">
                                    {{-- Details section --}}
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-3">{{ __('dashboard.customer_info') }}</h6>
                                            <ul class="list-unstyled lh-lg mb-0">
                                                <li><strong>{{ __('dashboard.user_name') }}:</strong>
                                                    {{ $orderWithItems->user_name }}</li>
                                                <li><strong>{{ __('dashboard.user_email') }}:</strong>
                                                    {{ $orderWithItems->user_email }}</li>
                                                <li><strong>{{ __('dashboard.user_phone') }}:</strong>
                                                    {{ $orderWithItems->user_phone }}</li>
                                                <li><strong>{{ __('dashboard.note') }}:</strong>
                                                    {{ $orderWithItems->note ?: __('dashboard.no_note') }}</li>
                                                <li>
                                                    <strong>{{ __('dashboard.status') }}:</strong>
                                                    <span
                                                        class="badge text-white badge-status-{{ $orderWithItems->status }}">
                                                        {{ ucfirst($orderWithItems->status) }}
                                                    </span>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <h6 class="text-muted mb-3">{{ __('dashboard.shipping_address') }}</h6>
                                            <ul class="list-unstyled lh-lg mb-0">
                                                <li><strong>{{ __('dashboard.country') }}:</strong>
                                                    {{ $orderWithItems->country }}</li>
                                                <li><strong>{{ __('dashboard.governorate') }}:</strong>
                                                    {{ $orderWithItems->governorate }}</li>
                                                <li><strong>{{ __('dashboard.city') }}:</strong>
                                                    {{ $orderWithItems->city }}</li>
                                                <li><strong>{{ __('dashboard.street') }}:</strong>
                                                    {{ $orderWithItems->street }}</li>
                                                <li><strong>{{ __('dashboard.coupon') }}:</strong>
                                                    {{ $orderWithItems->coupon ?? __('dashboard.no_coupon') }}</li>
                                                <li><strong>{{ __('dashboard.coupon_discount') }}:</strong>
                                                    {{ $orderWithItems->coupon_discount }}%</li>
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Financial summary --}}
                                    <div class="row text-center mb-4">
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <div class="glass-box p-3">
                                                <i class=" fas fa-dollar-sign fs-3"></i>
                                                <div>{{ __('dashboard.price') }}</div>
                                                <strong>{{ $orderWithItems->price }} EGP</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3 mb-md-0">
                                            <div class="glass-box p-3">
                                                <i class="fas fa-shipping-fast fs-3"></i>
                                                <div>{{ __('dashboard.shipping_price') }}</div>
                                                <strong>{{ $orderWithItems->shipping_price }} EGP</strong>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="glass-box p-3">
                                                <i class="la la-calculator fs-3"></i>
                                                <div>{{ __('dashboard.total_price') }}</div>
                                                <strong>{{ $orderWithItems->total_price }} EGP</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- order items --}}

                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>{{ __('dashboard.product_name') }}</th>
                                                <th>{{ __('dashboard.product_image') }}</th>
                                                <th>{{ __('dashboard.product_quantity') }}</th>
                                                <th>{{ __('dashboard.product_price') }}</th>
                                                <th>{{ __('dashboard.product_price_for_quantity') }}</th>
                                                <th>{{ __('dashboard.attributes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderWithItems->orderItems as $item)
                                                <tr>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>
                                                        <img src="{{asset('uploads/products/' . $item->product->images->first()->file_name) }}"
                                                            width="50">
                                                    </td>

                                                    <td>{{ $item->product_quantity }}</td>
                                                    <td>{{ $item->product_price }} EGP</td>
                                                    <td>{{ $item->product_price * $item->product_quantity }} EGP</td>
                                                    <td>
                                                        @forelse(($item->attributes ?? []) as $attr => $value)
                                                            <span class="badge bg-secondary me-1">{{ $attr }}:
                                                                {{ $value }}</span>
                                                        @empty
                                                            <span
                                                                class="text-muted">{{ __('dashboard.no_attributes') }}</span>
                                                        @endforelse
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a href="{{ route('dashboard.orders.index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left"></i> Back to orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('css')
    <style>
        .glass-box {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .glass-box:hover {
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .badge-status-pending {
            background: #f0ad4e
        }

        .badge-status-Paid {
            background: #010509
        }

        .badge-status-delivered {
            background: #5cb85c
        }

        .badge-status-cancelled {
            background: #d9534f
        }
    </style>
@endpush
