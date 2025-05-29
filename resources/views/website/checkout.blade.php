@extends('layouts.website.app')

@section('title')
{{ __('website.checkout') }}
@endsection

@section('content')

<section class="blog about-blog">
    <div class="container">
        <div class="blog-bradcrum">
            <span><a href="{{ route('website.home') }}">{{ __('website.home') }}</a></span>
            <span class="devider">/</span>
            <span><a href="#">{{ __('website.checkout') }}</a></span>
        </div>
        <div class="blog-heading about-heading">
            <h1 class="heading">{{ __('website.checkout') }}</h1>
        </div>
    </div>
</section>
@include('website.includes.alert')

<section class="checkout product footer-padding">
    <div class="container">
        <div class="checkout-section">
            <div class="row gy-5">
                {{-- shipping address --}}
                <div class="col-lg-6">
                   @livewire('website.checkout.shipping-details')
                </div>
                {{-- cart details --}}
                <div class="col-lg-6">
                    @livewire('website.checkout.order-summary')

                    {{-- coupons --}}
                    <div class="review-form">
                        @livewire('website.checkout.coupons')
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
