@extends('layouts.app')

@section('content')
    <main class="no-main ps-home--dark pb-3">
        @include('layouts.slider')
        {{-- <div class="ps-promotion--default">
                <div class="container">
                    <div class="row m-0">
                        <div class="col-6 col-lg-3"><a href="shop-view-grid.html"><img
                                    src="img/promotion/promotion_01.jpg" alt="alt" /></a></div>
                        <div class="col-6 col-lg-3"><a href="shop-view-grid.html"><img
                                    src="img/promotion/promotion_02.jpg" alt="alt" /></a></div>
                        <div class="col-6 col-lg-3"><a href="shop-view-grid.html"><img
                                    src="img/promotion/promotion_03.jpg" alt="alt" /></a></div>
                        <div class="col-6 col-lg-3"><a href="shop-view-grid.html"><img
                                    src="img/promotion/promotion_04.jpg" alt="alt" /></a></div>
                    </div>
                </div>
            </div> --}}
        {{-- product section --}}
        @foreach ($categories as $category)
            @php
                $product_id = \App\Models\ProductCategory::where('category_id', $category->id)
                    ->select('product_id')
                    ->get();
            @endphp
            @if (count($product_id) > 0)
                <section class="ps-component ps-component--selling">
                    <div class="container">
                        <div class="component__header">
                            <h3 class="component__title">{{ $category->category_bn }}</h3>
                            <div class="component__view">View all <i class="icon-chevron-right"></i></div>
                        </div>
                        <div class="component__content">
                            <div class="owl-carousel" data-owl-auto="true" data-owl-loop="false" data-owl-speed="12000"
                                data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5"
                                data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5"
                                data-owl-duration="1000" data-owl-mousedrag="on">
                                @php
                                    $products = null;
                                    if (!is_null($product_id)) {
                                        $products = \App\Models\Product::select('id', 'name', 'slug', 'thumbnail_image', 'unit_price', 'discount', 'discount_type')->find($product_id);
                                    }
                                @endphp
                                @if (!is_null($products))
                                    @foreach ($products as $product)
                                        <div class="ps-sell__product">
                                            <div class="ps-product--standard"><a
                                                    href="product-details/{{ $product->slug }}">
                                                    <img class="ps-product__thumbnail"
                                                        src="{{ asset($product->thumbnail_image) }}" alt="alt" /></a>
                                                <a class="ps-product__expand" href="javascript:void(0);" data-toggle="modal"
                                                    data-target="#popupQuickview"><i class="icon-expand"></i></a>
                                                @if (!is_null($product->discount))
                                                    <span
                                                        class="ps-badge ps-product__offbadge">{{ $product->discount }}{{ $product->descount_type == 'flat' ? 'TK' : '%' }}
                                                        Off </span>
                                                @endif
                                                <div class="ps-product__content">
                                                    <h5><a class="ps-product__name"
                                                            href="product-details/{{ $product->slug }}">{{ $product->name }}</a>
                                                    </h5>
                                                    <p class="ps-product-price-block">
                                                        @if (is_null($product->discount))
                                                            <span
                                                                class="ps-product__sale">{{ Custom::CURRENCY($product->unit_price) }}</span>
                                                        @else
                                                            <span
                                                                class="ps-product__sale">{{ Custom::CURRENCY(Custom::DISCOUNT($product->unit_price, $product->discount_type, $product->discount)) }}</span>
                                                            <span
                                                                class="ps-product__price">{{ Custom::CURRENCY($product->unit_price) }}</span>
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="ps-product__footer">
                                                    {{-- <div class="def-number-input number-input safari_only">
                                                        <button class="minus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                                class="icon-minus"></i></button>
                                                        <input class="quantity" min="0" name="quantity" value="1"
                                                            type="number" />
                                                        <button class="plus"
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                                class="icon-plus"></i></button>
                                                    </div>
                                                    <div class="ps-product__total">
                                                        Total: <span>$3.90</span>
                                                    </div> --}}
                                                    <button class="ps-product__addcart add-to-card" data-toggle="modal"
                                                        data-target="{{ $product->id }}">
                                                        <i class="icon-cart"></i>
                                                        Add to cart
                                                    </button>
                                                    <div class="ps-product__box"><a class="ps-product__wishlist"
                                                            href="wishlist.html">Wishlist</a><a class="ps-product__compare"
                                                            href="wishlist.html">Compare</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    </main>
@endsection

@push('js')
    <script>
        $('.add-to-card').on('click', function() {
            const product_id = $(this).attr('data-target');
            axios.post('/add-to-cart', {
                    product_id: product_id
                })
                .catch(errors => console.log(error))
                .then(res => {
                    const count = res.data.count;
                    // console.log(res.data);
                    if (count == 'error') {
                        Toast.fire({
                            icon: 'error',
                            position: 'top-end',
                            title: 'Item is already added to cart'
                        })
                    } else {
                        Toast.fire({
                            icon: 'success',
                            position: 'top-end',
                            timer: 1500,
                            title: 'Item has been added to cart'
                        })
                        $('.cart-count').text(count);
                    }
                    const base_url = $(location).attr('protocol') + "//" + $(location).attr('host') + '/';
                    $('.list-cart').html('');
                    $.each(res.data.items, function(index, value) {
                        $('.list-cart').append(`<li class="cart-item">
                                <div class="ps-product--mini-cart"><a href="product-details/${value.slug}"><img
                                            class="ps-product__thumbnail" src="${base_url}${value.image}"
                                            alt="alt" /></a>
                                    <div class="ps-product__content"><a class="ps-product__name"
                                            href="product-details/${value.slug}">${value.name}</a>
                                        <p class="ps-product__meta"> <span class="ps-product__price">${value.subPrice}</span><span
                                                class="ps-product__quantity">(x${value.quantity})</span>
                                        </p>
                                    </div>
                                    <div class="ps-product__remove"><i class="icon-trash2"></i>
                                    </div>
                                </div>
                            </li>`);
                    });
                })
        });
    </script>
@endpush
