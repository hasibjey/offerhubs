@extends('layouts.app')

@section('content')
    <main class="no-main">
        <section class="section--checkout">
            <div class="container">
                <h2 class="page__title">Checkout</h2>
                <div class="checkout__content">
                    <div class="row">
                        @if (Auth::check())
                            <div class="col-12 col-lg-7">
                                <h3 class="checkout__title">Billing Details</h3>
                                <div class="row m-0">
                                    @foreach ($addresses as $key => $address)
                                        <div class="col-md-6 p-1">
                                            <div class="bg-white">
                                                <button class="btn btn-sm btn-info edit" style="font-size:12px"
                                                    data-bs-toggle="modal" data-bs-target="#address-form"
                                                    data-target="{{ $address->id }}">
                                                    Edit
                                                </button>
                                                <a href="{{ url('address/delete/' . $address->id) }}"
                                                    class="btn btn-sm btn-info" style="font-size:12px">Delete</a>
                                                <div class="address-card p-1 d-flex"
                                                    style="border: 1px solid green; border-radius: 3px;">
                                                    <div class="check-box text-center" style="width: 10%">
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input address"
                                                                value="{{ $address->id }}"
                                                                @if ($key == 0) checked @endif
                                                                name="delivery_address_id">
                                                        </div>
                                                    </div>
                                                    <div class="address">
                                                        <p class="m-0">Reciver Name: {{ $address->name }}</p>
                                                        <p class="m-0">Address: {{ $address->address }}</p>
                                                        <p class="m-0">Postal Code: {{ $address->post }}</p>
                                                        <p class="m-0">City: {{ $address->city }}</p>
                                                        <p class="m-0">Country: {{ $address->country }}</p>
                                                        <p class="m-0">Phone: {{ $address->phone }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="checkout__form">
                                    <div class="text-center mt-2">
                                        <button class="address-btn" data-bs-toggle="modal" data-bs-target="#address-form"><i
                                                class="fa-solid fa-plus pr-1"></i> Add New Address</button>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-12 col-lg-7">
                                <h3 class="checkout__title">Billing Details</h3>
                                <div class="checkout__form">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-12 col-lg-6 form-group--block">
                                                <label>First name: <span>*</span></label>
                                                <input class="form-control" type="text" required>
                                            </div>
                                            <div class="col-12 col-lg-6 form-group--block">
                                                <label>Last name<span>*</span></label>
                                                <input class="form-control is-invalid" type="text" required>
                                                <div class="invalid-feedback">Please enter last name!</div>
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Company name (optional)</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Country: <span>*</span></label>
                                                <select class="single-select2" name="state">
                                                    <option value="uk">United Kingdom</option>
                                                    <option value="vn">Viet Nam</option>
                                                </select>
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Street address: <span>*</span></label>
                                                <input class="form-control" type="text"
                                                    placeholder="House number and street name">
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Postcode/ ZIP (optional)</label>
                                                <input class="form-control" type="text">
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Town/ City: <span>*</span></label>
                                                <input class="form-control" type="text" required>
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Phone: <span>*</span></label>
                                                <input class="form-control" type="text" required>
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Email address: <span>*</span></label>
                                                <input class="form-control" type="email" required>
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="label-checkbox">Create an account?</label>
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="label-checkbox"><b>Ship to a different address?</b></label>
                                            </div>
                                            <div class="col-12 form-group--block">
                                                <label>Order notes (optional)</label>
                                                <textarea class="form-control" placeholder="Note about your orders, e.g special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                        <div class="col-12 col-lg-5">
                            <h3 class="checkout__title">Your Order</h3>
                            <div class="checkout__products">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="checkout__label">PRODUCT</div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="checkout__label">TOTAL</div>
                                    </div>
                                </div>
                                <div class="checkout__list">
                                    @if (session()->has('cart.items'))
                                        @foreach (Cart::ITEMS() as $item)
                                            <div class="checkout__product__item">
                                                <div class="checkout-product">
                                                    <div class="product__name">
                                                        {{ $item['name'] }}<span>(x{{ $item['quantity'] }})</span>
                                                    </div>
                                                </div>
                                                <div class="checkout-price">{{ $item['subPrice'] }}</div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="checkout__label">Subtotal</div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="checkout__label">{{ Custom::CURRENCY(Cart::SUBTOTAL()) }}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="checkout__label">Tax</div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="checkout__label">{{ Custom::CURRENCY(Cart::GET_TAX()) }}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="checkout__label">Shipping Cost</div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="checkout__label">{{ Custom::CURRENCY(Cart::GET_SHIPPING()) }}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="checkout__label">Discount</div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="checkout__label">{{ Custom::CURRENCY(Cart::GET_DISCOUNT()) }}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-8">
                                        <div class="checkout__total">Total</div>
                                    </div>
                                    <div class="col-4 text-right">
                                        <div class="checkout__money">
                                            {{ Custom::CURRENCY(Cart::TOTAL() + Cart::GET_TAX() + Cart::GET_SHIPPING() - Cart::GET_DISCOUNT()) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__payment">
                                <div class="checkout__label mb-3">SELECT PAYMENT</div>
                                <div class="form-group--block">
                                    <input class="form-check-input" type="checkbox" id="checkboxBank" value="bank">
                                    <label class="label-checkbox" for="checkboxBank"><b class="text-heading">Direct bank
                                            transfer</b></label>
                                </div>
                                <div class="form-group--block">
                                    <input class="form-check-input" type="checkbox" value="cash" id="checkboxCash"
                                        checked="checked">
                                    <label class="label-checkbox" for="checkboxCash"><b class="text-heading">Cash on
                                            delivery</b></label>
                                </div>
                                <div class="checkout__payment__detail">Pay with cash upon delivery
                                    <div class="triangle-box">
                                        <div class="triangle"></div>
                                    </div>
                                </div>
                                <div class="form-group--block">
                                    <input class="form-check-input" type="checkbox" id="checkboxPaypal" value="paypal">
                                    <label class="label-checkbox" for="checkboxPaypal"><b class="text-heading">PayPal
                                        </b><img src="img/promotion/payment_visa.jpg" alt><img
                                            src="img/promotion/payment_mastercart.jpg" alt><img
                                            src="img/promotion/payment_electron.jpg" alt><a>What is PayPal?</a></label>
                                </div>
                            </div>
                            <p>Your personal data will be used to process your order, support your experience throughout
                                this website, and for other purposes described in our <span class="text-success">privacy
                                    policy.</span></p>
                            <div class="form-group--block">
                                <input class="form-check-input" type="checkbox" id="checkboxAgree" value="agree">
                                <label class="label-checkbox" for="checkboxAgree"><b class="text-heading">I have read and
                                        agree to the website
                                        <u class="text-success">terms and conditions </u><span>*</span></b></label>
                            </div><a class="checkout__order" href="order-tracking.html">Place an order</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('frontend.address')
@endsection
