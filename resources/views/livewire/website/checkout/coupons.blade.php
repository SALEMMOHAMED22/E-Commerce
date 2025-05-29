<div>
    @if ($couponInfo != null)
    <div class="alert alert-success d-flex align-items-center" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        <div>
            {{ $couponInfo }}
        </div>
    </div>
@endif
    {{-- @if ($cartItemCount > 0 && $cart->coupon == null)
        <div class="account-inner-form">
            <div class="review-form-name">
                <input wire:model="code" class="form-control" placeholder="Enter Coupon Code">
                <button class="shop-btn" wire:click="applyCoupon" type="button">Apply</button>
            </div>
        </div>
    @endif --}}

    @if ($cartItemCount > 0 && $cart->coupon == null)
    <div class="card mb-4">
        <div class="card-body">
            <form wire:submit.prevent="applyCoupon">
                <div class="row g-2 align-items-center">
                    <div class="col-md-8 col-sm-12">
                        <input wire:model="code" type="text" class="form-control" placeholder="Enter Coupon Code">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <button type="submit" class="btn btn-success w-100">
                            Apply
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endif

</div>

@script
    <script>
        $wire.on('couponApplied', (event) => {
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: event,
                showConfirmButton: false,
                timer: 3500
            });
        });
        $wire.on('couponNotValid', (event) => {
            Swal.fire({
                position: 'top-center',
                icon: 'error',
                title: event,
                showConfirmButton: false,
                timer: 3500
            });
        });
    </script>
@endscript
