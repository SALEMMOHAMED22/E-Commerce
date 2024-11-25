@if ($errors->has('error'))
<div class="row mt-2">
  <button type="button" class="btn btn-lg btn-block btn-outline-danger mb-2"
      id="type-error">{{ $errors->first('error') }}</button>
</div>
@endif