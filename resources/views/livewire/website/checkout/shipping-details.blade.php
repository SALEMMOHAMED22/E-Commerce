<div>
    <form action="{{ route('website.checkout.post') }}" method="POST">
        @csrf
        <div class="checkout-wrapper">

            <div class="account-section billing-section">
                <h5 class="wrapper-heading text-center">{{ __('website.billing_details') }}</h5>
                <div class="review-form">
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="fname" class="form-label">First Name* </label>
                            <input name="first_name" type="text" id="fname" class="form-control" placeholder="First Name">
                               @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="lname" class="form-label">Last Name*</label>
                            <input name="last_name" type="text" id="lname" class="form-control" placeholder="Last Name">
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">Email*</label>
                            <input name="user_email" type="email" id="email" class="form-control" placeholder="user@gmail.com">
                              @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="review-form-name">
                            <label for="user_phone" class="form-label">Phone*</label>
                            <input name="user_phone" type="tel" id="phone" class="form-control" placeholder="+880388**0899">
                              @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="countryId">{{ __('dashboard.country') }}</label>
                        <select   name="country_id" wire:model.live="countryId" class="form-control" id="countryId">
                            <option value="" selected>select country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                        @error('country_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="governorate">{{ __('dashboard.governorate') }}</label>
                        <select name="governorate_id" wire:model.live="governorateId" class="form-control"
                            id="governorateId">
                            <option value="" selected>select governorate</option>
                            @foreach ($governorates as $governorate)
                                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach
                        </select>
                        @error('governorate_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">{{ __('dashboard.city') }}</label>
                        <select name="city_id" wire:model.live="cityId" class="form-control" id="cityId">
                            <option value="" selected>select city</option>
                            @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="form-group">
                        <label for="street">{{ __('website.street') }}</label>
                        <input type="text" name="street"  id="streetId" class="form-control" placeholder="Enter Street">
                        @error('street')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                     <div class="form-group">
                        <label for="notice">{{ __('website.notice') }}</label>
                        <input type="text" name="note"  id="noticeId" class="form-control" placeholder="Enter notice">
                        @error('notice')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    


                    <br>
                    <div class="form-group mt-3 " style="text-align: center">
                        <button class="shop-btn">{{ __('website.place_order_now') }}</button>
                    </div>
                   
                </div>
            </div>
        </div>
    </form>
</div>
