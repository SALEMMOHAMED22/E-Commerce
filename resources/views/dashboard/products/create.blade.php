@extends('layouts.dashboard.app')
@section('title')
    {{ __('dashboard.create_product') }}
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.create_product') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">
                                        {{ __('dashboard.products') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="{{ route('dashboard.products.create') }}">
                                        {{ __('dashboard.create_product') }}</a>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
                @include('dashboard.includes.button-header')
            </div>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-11">
                    <div class="content-body">
                        <section id="icon-tabs">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">{{ __('dashboard.create_product') }}</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-h font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                    <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content collapse show">
                                            <div class="card-body">
                                                @livewire('dashboard.create-product', ['categories' => $categories, 'brands' => $brands])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard') }}/vendors/css/forms/tags/tagging.css">
   <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/custom/product.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet">
@endpush

@push('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('showFullscreenModal', () => {
                $('#fullscreenModal').modal('show');
            });
        });
    </script>
    {{-- tags --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script> --}}
    {{-- <script>
        // Initialize Tagify
        const input = document.querySelector('#tagInput');
        new Tagify(input, {
            delimiters: ", ", // Tags separated by space, comma, or enter
            placeholder: "Type and press space or enter",
            maxTags: 10, // Maximum number of tags
        });
    </script> --}}

    {{-- product images file input --}}
    <script>
        // var lang = "{{ app()->getLocale() }}";
        // $(function() {
        //     $('#product-images').fileinput({
        //         theme: 'fa5',
        //         language: lang,
        //         ignore: 'button[type=submit]',
        //         allowedFileTypes: ['image'],
        //         maxFileCount: 5,
        //         enableResumableUpload: false,
        //         showUpload: false,
        //     });
        // });
    </script>
@endpush