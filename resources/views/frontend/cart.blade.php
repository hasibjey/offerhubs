@extends('layouts.app')

@section('content')
    <main class="no-main">
        <section class="section--shopping-cart">
            <div class="container shopping-container">
                <h2 class="page__title">Shopping Cart</h2>
                <div class="shopping-cart__content">
                    <div class="row m-0">
                        <div class="col-12 col-lg-9">
                            <div class="shopping-cart__products">
                                <div class="shopping-cart__table">
                                    <div class="shopping-cart-light">
                                        <div class="shopping-cart-row">
                                            <div class="cart-product">Product</div>
                                            <div class="cart-price">Price</div>
                                            <div class="cart-quantity">Quantity</div>
                                            <div class="cart-total">Total</div>
                                            <div class="cart-action"> </div>
                                        </div>
                                    </div>
                                    @foreach (Cart::ITEMS() as $item)
                                        <div class="shopping-cart-body">
                                            <div class="shopping-cart-row">
                                                <div class="cart-product">
                                                    <div class="ps-product--mini-cart">
                                                        <input type="text" value="{{ $item['pro_id'] }}" hidden>
                                                        <a href="product-default.html">
                                                            <img class="ps-product__thumbnail" src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" />
                                                        </a>
                                                        <div class="ps-product__content">
                                                            <h5><a class="ps-product__name" href="product-details/{{ $item['slug']}}">{{ $item['name'] }}</a></h5>
                                                            <p class="ps-product__meta">Price: <span
                                                                    class="ps-product__price">{{ Custom::CURRENCY($item['price']) }}</span></p>
                                                            <div class="def-number-input number-input safari_only">
                                                                <button class="minus" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                                    <i class="icon-minus"></i>
                                                                </button>
                                                                <input class="quantity" min="0" name="quantity"
                                                                    value="{{ $item['quantity'] }}" type="number" />
                                                                <button class="plus" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                                    <i class="icon-plus"></i>
                                                                </button>
                                                            </div>
                                                            <span class="ps-product__total">Total:
                                                                <span>{{ Custom::CURRENCY($item['subPrice']) }}</span>
                                                            </span>
                                                        </div>
                                                        <div class="ps-product__remove"><i class="icon-trash2"></i></div>
                                                    </div>
                                                </div>
                                                <div class="cart-price">
                                                    <span class="ps-product__price">{{ Custom::CURRENCY($item['price']) }}</span>
                                                </div>
                                                <div class="cart-quantity">
                                                    <div class="def-number-input number-input safari_only">
                                                        <button class="minus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                class="icon-minus"></i></button>
                                                        <input class="quantity" min="0" name="quantity" value="{{ $item['quantity'] }}"
                                                            type="number" />
                                                        <button class="plus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                class="icon-plus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="cart-total"> <span class="ps-product__total sub-total-{{$item['pro_id']}}">{{ Custom::CURRENCY($item['subPrice']) }}</span>
                                                </div>
                                                <a href="{{ url('cart/delete/' . Crypt::encryptString($item['pro_id'])) }}" class="cart-action"> <i class="icon-trash2"></i></a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="shopping-cart__step">
                                    <a class="clear-item" href="{{ route('cart.clear') }}">Clear all items</a>
                                    {{-- <a class="button right" href="javascript:void(0);">
                                        <i class="icon-sync"> </i>
                                        Update Cart
                                    </a> --}}
                                    <a class="button left" href="{{ route('welcome') }}"><i class="icon-arrow-left"></i>Continue Shopping</a>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="shopping-cart__block">
                                            <h3 class="block__title">Using A Promo Code?</h3>
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Coupon code">
                                                <div class="input-group-append">
                                                    <button class="btn">Apply</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="shopping-cart__block">
                                            <h3 class="block__title">Calculate Shipping</h3>
                                            <div class="input-group">
                                                <select class="single-select2" name="state">
                                                    <option value="uk">United Kingdom</option>
                                                    <option value="vn">Viet Nam</option>
                                                </select>
                                            </div>
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Town/ City">
                                            </div>
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Postcode/ ZIP">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="shopping-cart__right">
                                <div class="shopping-cart__total">
                                    <p class="shopping-cart__subtotal">
                                        <span>Subtotal</span>
                                        <span class="price" id="sub-total">{{Custom::CURRENCY(Cart::SUBTOTAL())}}</span>
                                    </p>
                                    <hr>
                                    <p class="shopping-cart__subtotal">
                                        <span>Tax</span>
                                        <span class="price" id="tax">{{Custom::CURRENCY(Cart::GET_TAX())}}</span>
                                    </p>
                                    <hr>
                                    <p class="shopping-cart__subtotal">
                                        <span>Shipping Cost</span>
                                        <span class="price" id="shippin_cost">{{Custom::CURRENCY(Cart::GET_SHIPPING())}}</span>
                                    </p>
                                    <hr>
                                    <p class="shopping-cart__subtotal">
                                        <span>Discount</span>
                                        <span class="price" id="discount">{{ Custom::CURRENCY(Cart::GET_DISCOUNT()) }}</span>
                                    </p>
                                    <hr>
                                    <p class="shopping-cart__subtotal">
                                        <span><b>TOTAL</b></span>
                                        <span class="price-total" id="net-total">{{ Custom::CURRENCY(Cart::TOTAL() + Cart::GET_TAX() + Cart::GET_SHIPPING() - Cart::GET_DISCOUNT()) }}</span>
                                    </p>
                                </div><a class="btn shopping-cart__checkout" href="{{ route('checkout') }}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('frontend.address')
@endsection

@push('js')
    <script>
        $('.minus, .plus').on('click', function(){
            let qty = $(this).parent().children('input').val();
            let pro_id = $(this).parent('.safari_only').parent().parent().children().children().children('input').val();
            if (qty == 0) {
                $(this).parent().children('input').val(1);
                qty = 1;
            }

            axios.post('/cart/qty/update', {
                    pro_id: pro_id,
                    qty: qty
                })
                .catch(errors => console.log(error))
                .then(res => {
                    $(this).parent().children('input').val(res.data.quantity)
                    $('.sub-total-'+pro_id).html(CURRENCY(res.data.sub_price))
                    $('#sub-total').html(CURRENCY(res.data.sub_total))
                    $('#tax').html(CURRENCY(res.data.tax))
                    $('#shipping_cost').html(CURRENCY(res.data.shipping_cost))
                    $('#discount').html(CURRENCY(res.data.discount))
                    $('#net-total').html(CURRENCY(res.data.total))
                })
        })
    </script>
@endpush