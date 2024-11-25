@extends('layouts.dashboard.auth')

@section('title')
    Confirm
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 px-2 py-2 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <img src="{{ asset('assets/dashboard') }}/images/logo/logo-dark.png"
                                            alt="branding logo">
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                        <span>We will send you a link to reset password.</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                       @include('dashboard.includes.alert-danger')
                                        <form method="POST" class="form-horizontal"
                                            action="{{ route('dashboard.password.verify.post') }}">
                                            @csrf
                                            <fieldset hidden class="form-group position-relative has-icon-left">
                                                <input hidden name="email" type="email"
                                                    class="form-control form-control-lg input-lg" id="user-email"
                                                    value="{{ $email }}">
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>
                                            <fieldset class="form-group position-relative has-icon-left">
                                                <input name="code" type="text"
                                                    class="form-control form-control-lg input-lg" id="user-email"
                                                    placeholder="Enter Your Code Here">
                                                @error('code')
                                                    <strong class="text-danger">
                                                        {{ $message }}
                                                    </strong>
                                                @enderror
                                                <div class="form-control-position">
                                                    <i class="ft-mail"></i>
                                                </div>
                                            </fieldset>
                                            <button type="submit" class="btn btn-outline-info btn-lg btn-block"><i
                                                    class="ft-unlock"></i> Recover Password</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="card-footer border-0">
                                    <p class="float-sm-left text-center"><a href="login-simple.html"
                                            class="card-link">Login</a></p>
                                    <p class="float-sm-right text-center">New to Modern ? <a href="register-simple.html"
                                            class="card-link">Create Account</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
