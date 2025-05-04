@extends('layouts.website.app')

@section('title')
    {{ __('website.brands') }}
@endsection

@section('content')
    {{-- breadcrumb and header title --}}
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">{{ __('dashboard.home') }}</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)">{{ __('dashboard.brands') }}</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">{{ __('dashboard.brands') }}</h1>
            </div>
        </div>
    </section>

    <section class="product brand" data-aos="fade-up">
        <div class="container">

            <div style="margin-bottom: 80px" class="brand-section">
                @foreach ($brands as $brand)
                    <div style="margin:6px" class="product-wrapper">
                        <div class="wrapper-img">
                            <a href="{{ route('website.brands.products', $brand->slug) }}">
                                <img src="{{ asset($brand->logo) }}" alt="{{ $brand->name }}">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
