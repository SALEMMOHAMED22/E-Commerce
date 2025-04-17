@extends('layouts.website.app')
@section('title')
    Register
@endsection

@section('content')
    <section class="login account footer-padding">
        <div class="container">
           <form action="{{ route('website.register.post') }}" method="POST" id="registerForm">
            @csrf
            <div class="login-section account-section">
                <div class="review-form">
                    <h5 class="comment-title">{{ __('dashboard.create_account') }}</h5>
                     @if ($errors->any())
                         <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                         </div>
                     @endif
                     {{-- Name --}}
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="fname" class="form-label">{{ __('dashboard.name') }}</label>
                            <input type="text" name="name" id="fname" class="form-control" placeholder="{{ __('dashboard.name') }}">
                        </div>
                        
                    </div>
                    {{-- Email --}}
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">{{ __('dashboard.email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('dashboard.email') }}">
                        </div>
                    </div>
                    <div class="review-form-name">
                        @livewire('general.adress-drop-down-dependent')
                    </div>
                    {{-- password --}}
                    <div class="review-form-name password-form">
                        <label for="password" class="form-label">{{ __('dashboard.password') }}*</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('dashboard.password') }}">
                    </div>
                    {{-- Terms --}}
                    <div class="review-form-name checkbox">
                        <div class="checkbox-item">
                            <input type="checkbox" name="terms">
                            <p class="remember">
                               {{__('dashboard.agree_all_terms')}}<span class="inner-text">{{ $setting->site_name }}</span></p>
                        </div>
                    </div>
                    <div class="login-btn text-center">
                        <button type="submit" class="shop-btn">{{ __('dashboard.create_account') }}</button>
                        <span class="shop-account">{{ __('dashboard.have_account') }} ?<a href="{{ route('website.login.get') }}">Log In</a></span>
                    </div>
                </div>
            </div>
           </form>
        </div>
    </section>
@endsection
