@extends('layouts.dashboard.app')

@section('title', __('Order Details'))

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">

            {{-- Breadcrumbs --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">{{ __('dashboard.orders_table') }}</h3>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard.orders.index') }}">{{ __('dashboard.orders') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('Order Details') }}</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Card --}}
            <div class="content-body">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ __('dashboard.orders') }}</h4>

                        <div class="d-flex gap-2">
                            @if ($orderWithItems->status !== 'delivered')
                                <a href="{{ route('dashboard.orders.markDelivered', $orderWithItems->id) }}" class="btn btn-success"
                                    onclick="return confirm('{{ __('dashboard.confirm_mark_delivered') }}')">
                                    {{ __('Mark As Delivered') }}
                                </a>
                            @endif
                            <form action="{{ route('dashboard.orders.destroy', $orderWithItems->id) }}" method="POST"
                                onsubmit="return confirm('{{ __('dashboard.confirm_delete') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete Order') }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body">

                            {{-- Customer Info --}}
                            <div class=" card p-3 mb-4">
                                <h5>{{ __('Customer Info') }}</h5>
                                <p><strong>{{ __('Name') }}:</strong> {{ $orderWithItems->user_name }}</p>
                                <p><strong>{{ __('Phone') }}:</strong> {{ $orderWithItems->user_phone }}</p>
                                <p><strong>{{ __('Email') }}:</strong> {{ $orderWithItems->user_email }}</p>
                                <p><strong>{{ __('Date') }}:</strong> {{ $orderWithItems->created_at }}</p>
                                <p><strong>{{ __('status') }}:</strong>
                                    <span class="badge 
                                            @if ($orderWithItems->status == 'pending') badge-warning
                                            @elseif ($orderWithItems->status == 'paid') badge-primary
                                            @elseif ($orderWithItems->status == 'cancelled') badge-danger
                                            @elseif ($orderWithItems->status == 'delivered') badge-success
                                            @endif">
                                        {{ ucfirst($orderWithItems->status) }}
                                    </span>
                                </p>


                            </div>

                            {{-- Shipping Info --}}
                            <div class="card p-3 mb-4">
                                <h5>{{ __('Shipping Info') }}</h5>
                                <p><strong>{{ __('Country') }}:</strong> {{ $orderWithItems->country }}</p>
                                <p><strong>{{ __('Governorate') }}:</strong> {{ $orderWithItems->governorate }}</p>
                                <p><strong>{{ __('City') }}:</strong> {{ $orderWithItems->city }}</p>
                                <p><strong>{{ __('Street') }}:</strong> {{ $orderWithItems->street }}</p>
                                <p><strong>{{ __('note') }}:</strong> {{ $orderWithItems->note }}</p>

                            </div>

                            {{-- Pricing --}}
                            <div class="card p-3 mb-4">
                                <h5>{{ __('Pricing') }}</h5>
                                <p><strong>{{ __('Subtotal') }}:</strong> {{ $orderWithItems->price }} EGP</p>
                                <p><strong>{{ __('Shipping') }}:</strong> {{ $orderWithItems->shapping_price }} EGP</p>
                                <p><strong>{{ __('Coupon') }}:</strong> {{ $orderWithItems->coupon ?? 'no coupon' }}</p>
                                <p><strong>{{ __('Coupon Discount') }}:</strong> {{ $orderWithItems->coupon_discount }} %</p>
                                <p><strong>{{ __('Total') }}:</strong> {{ $orderWithItems->total_price }} EGP</p>
                            </div>

                            {{-- orderWithItems Items --}}
                            <div class="card p-3">
                                <h5>{{ __('Order Items') }}</h5>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead>
                                            <tr>
                                                {{-- <th>#</th> --}}
                                                <th>{{ __('Product Name') }}</th>
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Quantity') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Price For Quantity') }}</th>
                                                <th>{{ __('Attributes') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($orderWithItems->orderItems as $item)
                                                <tr>
                                                    {{-- <td>{{ $loop->iteration}}</td> --}}
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>
                                                        <img src="{{asset('uploads/products/' . $item->product->images->first()->file_name) }}"
                                                            width="50">

                                                    </td>
                                                    <td>{{ $item->product_quantity }}</td>
                                                    <td>{{ $item->product_price }} EGP</td>
                                                    <td>{{ $item->product_price * $item->product_quantity }} EGP</td>
                                                    <td>
                                                        @if ($item->attributes != null)
                                                            @foreach ($item->attributes as $attribute => $value)
                                                                <h5 class="heading">{{ $attribute . ' : ' . $value }}</h5>
                                                            @endforeach
                                                        @else
                                                            <h5 class="heading">no Attributes</h5>
                                                        @endif

                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div> 
                    </div>
                </div> 
            </div> 
        </div> 
    </div> 
@endsection