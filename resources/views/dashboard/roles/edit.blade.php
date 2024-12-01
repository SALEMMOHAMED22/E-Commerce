@extends('layouts.dashboard.app')
@section('title')
    Edite Role
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.welcome') }}">{{ __('static.home') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.roles.index') }}">{{ __('static.roles') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a
                                        href="{{ route('dashboard.roles.edit', $role->id) }}">{{ __('static.edite_role') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12">


                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('static.create_role') }}</h4>
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
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('dashboard.includes.validation-errors')

                            <form action="{{ route('dashboard.roles.update', $role->id) }}" method="POST" class="form">

                                @csrf
                                @method('PUT')

                                <div class="form-body">
                                    <input hidden name="id" value="{{ $role->id }}">
                                    <div class="row">
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="userinput1">{{ __('static.role_english') }}</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                    value="{{ $role->gettranslation('role', 'en') }}" placeholder="Name"
                                                    name="role[en]">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">{{ __('static.role_arabic') }}</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                    value="{{ $role->gettranslation('role', 'ar') }}" placeholder="Name"
                                                    name="role[ar]">
                                            </div>
                                        </div>


                                    </div>
                                    <div class="row">
                                        @if (Config::get('app.locale') == 'ar')
                                            @foreach (config('permissions_ar') as $key => $value)
                                                <div class="col-md-2">
                                                    <input value="{{ $key }}" name="permissions[]" type="checkbox"
                                                        class="checkbox" @checked(in_array( $key , $role->permission))>
                                                    <label>{{ $value }}</label>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach (config('permissions_en') as $key => $value)
                                                <div class="col-md-2">
                                                    <input value="{{ $key }}" name="permissions[]" type="checkbox"
                                                        class="checkbox" @checked(in_array($key, $role->permission))>
                                                    <label>{{ $value }}</label>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>


                                </div>
                                <div class="form-actions right">
                                    <button type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> {{ __('static.cancel') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> {{ __('static.save') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
