<div>
    <div class="checkout-wrapper">
       
        <div class="account-section billing-section">
            <h5 class="wrapper-heading text-center">{{ __('website.order_summary') }}</h5>
            <div class="order-summery">
                <div class="subtotal product-total">
                    <h5 class="wrapper-heading">{{ __('website.product') }}</h5>
                    <h5 class="wrapper-heading">{{ __('website.quantity') }}</h5>
                    <h5 class="wrapper-heading">{{ __('website.total') }}</h5>
                </div>
                <hr>
                <div class="subtotal product-total">
                    <ul class="product-list">
                        @foreach ($cart->items as $item)
                            <li>
                                <div class="product-info">
                                    <h5 class="wrapper-heading">{{ $item->product->name }}</h5>
                                    <p class="paragraph">
                                        @if ($item->product_variant_id != null)
                                            @foreach ($item->attributes as $key => $attr)
                                                {{ $key . ':' . $attr }}
                                            @endforeach
                                        @else
                                            {{ __('website.no_attributes') }}
                                        @endif
                                    </p>
                                </div>
                                <div class="quantity">
                                    <h5 class="wrapper-heading">{{ $item->quantity }}</h5>
                                </div>
                                <div class="price">
                                    <h5 class="wrapper-heading">${{ $item->price }} EGP</h5>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <hr>
                <div class="subtotal product-total">
                    <h5 class="wrapper-heading">{{ __('website.subtotal') }}</h5>
                    <h5 class="wrapper-heading">{{ $cart->items->sum(fn($item) => $item->quantity * $item->price) }}</h5>
                </div>
                <div class="subtotal product-total">
                    <ul class="product-list">   
                        <li>
                            <div class="product-info">
                                <p class="paragraph">SHIPPING</p>
                                <h5 class="wrapper-heading">Free Shipping</h5>
                            </div>
                            <div class="price">
                                <h5 class="wrapper-heading">{{ $shippingPrice }}</h5>
                            </div>
                        </li>
                    </ul>
                </div>

                <hr>


                <div class="subtotal total">
                    <h5 class="wrapper-heading">{{ __('website.total') }}</h5>
                    <h5 class="wrapper-heading price">
                        {{ $cart->items->sum(fn($item) => $item->quantity * $item->price) + $shippingPrice }}</h5>
                </div>
              
            </div>
        </div>
    </div>
</div>
