@extends('layouts.website.app')

@section('title')
    {{ __('website.categories') }}
@endsection

@section('content')
    {{-- breadcrumb and header title --}}
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">{{ __('dashboard.home') }}</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:void(0)">{{ __('dashboard.categories') }}</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">{{ __('dashboard.categories') }}</h1>
            </div>
        </div>
    </section>

    <section class="product-category">
        <div class="container">

            <div style="margin-bottom: 80px"class="category-section">
                @foreach ($categories as $item)
                    <div style="margin:6px" class="product-wrapper" data-aos="fade-right" data-aos-duration="100">
                        <div class="wrapper-img">
                            <img src="{{ asset($item->icon) }}" alt="{{ $item->name }}">
                        </div>
                        <div class="wrapper-info">
                            <a href="{{ route('website.categories.products', $item->slug) }}" class="wrapper-details">{{ $item->name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
