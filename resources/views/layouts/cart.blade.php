<div class="button-icon btn-cart-header"><i class="icon-cart icon-shop5"></i><span class="badge bg-warning cart-count">{{ Cart::COUNT() }}</span>
    <div class="mini-cart">
        <div class="mini-cart--content">
            <div class="mini-cart--overlay"></div>
            <div class="mini-cart--slidebar cart--box">
                <div class="mini-cart__header">
                    <div class="cart-header-title">
                        <h5>Shopping Cart(add)</h5><a class="close-cart" href="javascript:void(0);"><i
                                class="icon-arrow-right"></i></a>
                    </div>
                </div>
                <div class="mini-cart__products">
                    <div class="out-box-cart">
                        <div class="triangle-box">
                            <div class="triangle"></div>
                        </div>
                    </div>
                    <ul class="list-cart">
                        @if(session()->has('cart.items'))
                        @foreach (Cart::ITEMS() as $item)
                            <li class="cart-item">
                                <div class="ps-product--mini-cart"><a href=""product-details/{{ $item['slug'] }}""><img
                                            class="ps-product__thumbnail" src="{{ asset($item['image']) }}"
                                            alt="alt" /></a>
                                    <div class="ps-product__content"><a class="ps-product__name"
                                            href=""product-details/{{ $item['slug'] }}"">{{ $item['name'] }}</a>
                                        {{-- <p class="ps-product__unit">500g</p> --}}
                                        <p class="ps-product__meta"> <span class="ps-product__price">{{ $item['price']}}</span><span
                                                class="ps-product__quantity">(x{{ $item['quantity']}})</span>
                                        </p>
                                    </div>
                                    <div class="ps-product__remove"><i class="icon-trash2"></i>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="mini-cart__footer row">
                    <div class="col-6 title">TOTAL</div>
                    <div class="col-6 text-right total" id="total">{{ Cart::TOTAL() }}</div>
                    <div class="col-12 d-flex">
                        <a class="view-cart" href="{{ route('cart') }}">View cart</a>
                        <a class="checkout" href="{{ route('checkout') }}">Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
