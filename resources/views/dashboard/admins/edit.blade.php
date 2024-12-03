@extends('layouts.dashboard.app')

@section('title')
    Edit Admin
@endsection

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.admins') }}</h3> 
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.welcome') }}">{{ __('dashboard.home') }}</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.admins.index') }}">{{ __('dashboard.admins') }}</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">{{ __('dashboard.edit_admin') }}</a>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            @include('dashboard.includes.button-header')

        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.edit_admin') }}</h4>
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
                        <form class="form" action="{{ route('dashboard.admins.update', $admin->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input name="id" type="hidden" value="{{ $admin->id }}">
                            <div class="form-body">
                                <h4 class="form-section"><i class="la la-new"></i>{{ __('dashboard.edit_admin') }}</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userinput1"> {{ __('dashboard.admin_name') }}</label>
                                            <input type="text" id="userinput1" class="form-control border-primary"
                                               value="{{ $admin->name }}"  placeholder="{{ __('dashboard.enter_name') }}" name="name">
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userinput1"> {{ __('dashboard.admin_email') }}</label>
                                            <input type="text" id="userinput1" class="form-control border-primary"
                                            value="{{ $admin->email }}" placeholder="{{ __('dashboard.enter_email') }}" name="email">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userinput1"> {{ __('dashboard.password') }}</label>
                                            <input type="passwrod" id="userinput1" class="form-control border-primary"
                                                placeholder="{{ __('dashboard.enter_password') }}" name="password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="userinput1">  {{ __('dashboard.password_confirmation') }}</label>
                                            <input type="password" id="userinput1" class="form-control border-primary"
                                                placeholder="{{ __('dashboard.enter_password_confirmation') }}" name="password_confirmation">
                                        </div>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('dashboard.select_role') }}</label>
                                            <select class="form-control" name="role_id">
                                                <optgroup label="Select Role">
                                                    @foreach ($roles as $role)
                                                        <option @selected($role->id  == $admin->role_id) value="{{ $role->id }}">{{ $role->role }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mt-1">
                                            <label>{{ __('dashboard.select_status') }}</label>
                                            <select class="form-control" name="status">
                                                <optgroup label="Select Role">
                                                   
                                                    <option  @selected( $admin->status == 'Active' ) value="1">Active</option>
                                                    <option  @selected( $admin->status == 'Inactive' )  value="0">Inactive</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions right">
                                <button type="reset" class="btn btn-warning mr-1">
                                    <i class="ft-x"></i> {{ __('dashboard.cancel')}}
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="la la-check-square-o"></i> {{ __('dashboard.save')}}
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