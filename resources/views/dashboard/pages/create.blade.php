@extends('layouts.dashboard.app')
@section('title', __('dashboard.create_page'))

@push('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-9 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.pages_table') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.pages.index') }}">
                                        {{ __('dashboard.pages') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="">
                                        {{ __('dashboard.create_page') }}</a>
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
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-colored-form-control">
                                    {{ __('dashboard.pages') }}
                                </h4>
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
                                    {{-- alert --}}
                                    @include('dashboard.includes.validation-errors')
                                    @include('dashboard.includes.alert')

                                    {{-- <p class="card-text">{{ __('dashboard.form_store') }}.</p> --}}
                                    <form class="form" action="{{ route('dashboard.pages.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-body">
                                            <div class="form-group">
                                                <label for="eventRegInput1">{{ __('dashboard.title_en') }}</label>
                                                <input type="text" value="{{ old('title[en]') }}" class="form-control"
                                                    placeholder="{{ __('dashboard.title_en') }}" name="title[en]">
                                            </div>
                                            <div class="form-group">
                                                <label for="eventRegInput1">{{ __('dashboard.title_ar') }}</label>
                                                <input type="text" value="{{ old('title[ar]') }}" class="form-control"
                                                    placeholder="{{ __('dashboard.title_ar') }}" name="title[ar]">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="eventRegInput1">{{ __('dashboard.content_en') }}</label>
                                                <textarea type = "text" name="content[en]" id="summernote2" class="form-control">{{ old('content[en]') }}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for="eventRegInput1">{{ __('dashboard.content_ar') }}</label>
                                                <textarea type = "text" name="content[ar]" id="summernote" class="form-control">{{ old('content[ar]') }}</textarea>

                                            </div>
                                            

                                            <div class="form-group">
                                                <label for="image">{{ __('dashboard.image') }}</label>
                                                <input type="file" name="image" class="form-control" id="single-image"
                                                    placeholder="{{ __('dashboard.image') }}">
                                            </div>




                                            
                                        </div>
                                        <div class="form-actions left">
                                            <a href="{{ url()->previous() }}" type="button" class="btn btn-warning mr-1">
                                                <i class="ft-x"></i> {{ __('dashboard.cancel') }}
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

<script>
    $('#summernote').summernote({
      placeholder: 'اكتب المحتوي هنا...',
      tabsize: 2,
      height: 150,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });

    $('#summernote2').summernote({
      placeholder: 'ُEnter Content Here...',
      tabsize: 2,
      height: 150,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>

@endpush