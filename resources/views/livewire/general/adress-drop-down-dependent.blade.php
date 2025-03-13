<div>
    <div class="form-group">
        <label for="countryId">{{ __('dashboard.country') }}</label>
        <select name="country_id" wire:model.live="countryId" class="form-control" id="countryId">
            <option value="" selected>select country</option>
          @foreach ($countries as $country)
          <option value="{{ $country->id }}" >{{ $country->name }}</option>
          @endforeach
        </select>
        @error('country_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="governorate">{{ __('dashboard.governorate') }}</label>
        <select name="governorate_id" wire:model.live="governorateId" class="form-control" id="governorateId">
            <option value="" selected>select governorate</option>
            @foreach ($governorates as $governorate)
            <option value="{{ $governorate->id }}" >{{ $governorate->name }}</option>
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
            <option value="{{ $city->id }}" >{{ $city->name }}</option>
            @endforeach
          </select>
          @error('city_id')
              <span class="text-danger">{{ $message }}</span>
          @enderror
    </div>
</div>