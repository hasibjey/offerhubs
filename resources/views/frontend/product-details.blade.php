@extends('layouts.app')

@section('content')
    <main class="no-main">
        <section class="section--product-type section-product--default"> 
            <div class="container">
                <div class="product__header">
                    <h3 class="product__name">{{ $product->name }}</h3>
                </div>
                <div class="product__detail">
                    <div class="row">
                        <div class="col-12 col-lg-9">
                            <div class="ps-product--detail">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="ps-product__variants">
                                            <div class="ps-product__gallery">
                                                @foreach ($images as $image)
                                                    <div class="ps-gallery__item active">
                                                        <img src="{{ asset($image->image) }}" alt="{{ $product->name }}" />
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="ps-product__thumbnail">
                                                <div class="ps-product__zoom"><img id="ps-product-zoom"
                                                        src="{{ asset($product->thumbnail_image) }}"
                                                        alt="{{ $product->name }}" />
                                                    <ul class="ps-gallery--poster" id="ps-lightgallery-videos"
                                                        data-video-url="#">
                                                        <li data-html="#video-play"><span></span><i
                                                                class="fa fa-play-circle"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="ps-product__price">{{ $product->name }}</div>
                                        <div class="product__name">{{ $product->name }}</div>
                                        <div class="ps-product__sale">
                                            @if(is_null($product->discount))
                                                <span class="price-sale">{{ Custom::CURRENCY($product->unit_price) }}</span>
                                            @else
                                                <span class="price-sale">{{ Custom::CURRENCY(Custom::DISCOUNT($product->unit_price, $product->discount_type, $product->discount)) }}</span>
                                                <span class="price">{{ Custom::CURRENCY($product->unit_price) }}</span>
                                                @if($product->discount_type == 'flat')
                                                    <span class="ps-product__off">{{$product->discount}}TK Off</span>
                                                @else
                                                    <span class="ps-product__off">{{$product->discount}}% Off</span>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="ps-product__avai alert__success">Availability: <span>{{ $product->quantity - $product->sold_out_quantity}} in stock</span>
                                        </div>
                                        <div class="ps-product__category">
                                            <ul>
                                                <li>Brand: <a href='shop-all-brands.html'
                                                        class='text-success'>FarmMatket</a></li>
                                                <li>Vendor: <a href='shop-all-brands.html' class='text-success'>Local
                                                        Argus</a></li>
                                                <li>Categories: <a href='shop-all-brands.html'
                                                        class='text-success'>Fresh</a>, <a href='shop-all-brands.html'
                                                        class='text-success'>Vegetales</a>, <a href='shop-all-brands.html'
                                                        class='text-success'>Olives & Selection Platters</a></li>
                                                <li>Tags: <a href='shop-all-brands.html' class='text-primary'>meat organic
                                                        food</a>, <a href='shop-all-brands.html'
                                                        class='text-success'>beet</a>, <a href='shop-all-brands.html'
                                                        class='text-success'>healthy</a>, <a href='shop-all-brands.html'
                                                        class='text-success'>foody</a></li>
                                            </ul>
                                        </div>
                                        <div class="ps-product__shopping">
                                            <a class="ps-product__addcart ps-button">
                                                <i class="fa-solid fa-book-open-reader"></i>
                                                Read
                                            </a>
                                            <a class="ps-product__addcart ps-button add-to-card" data-toggle="modal"
                                                data-target="{{ $product->id }}">
                                                <i class="icon-cart"></i>
                                                Add to cart
                                            </a>
                                            <a class="ps-product__icon" href="wishlist.html">
                                                <i class="icon-heart"></i>
                                            </a>
                                        </div>
                                        <div class="ps-product__footer"><a class="ps-product__shop"
                                                href="shop-view-grid.html"><i
                                                    class="icon-store"></i><span>Store</span></a><a
                                                class="ps-product__addcart ps-button" data-toggle="modal"
                                                data-target="#popupAddToCart"><i class="icon-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3">
                            <div class="ps-product--extention">
                                <div class="extention__block">
                                    <div class="extention__item">
                                        <div class="extention__icon"><i class="icon-truck"></i></div>
                                        <div class="extention__content"> <b class="text-black">Free Shipping </b>apply to
                                            all orders over <span class="text-success">$100</span></div>
                                    </div>
                                </div>
                                <div class="extention__block">
                                    <div class="extention__item">
                                        <div class="extention__icon"><i class="icon-leaf"></i></div>
                                        <div class="extention__content">Guranteed <b class="text-black">100% Organic
                                            </b>from natural farmas </div>
                                    </div>
                                </div>
                                <div class="extention__block">
                                    <div class="extention__item border-none">
                                        <div class="extention__icon"><i class="icon-repeat-one2"></i></div>
                                        <div class="extention__content"> <b class="text-black">1 Day Returns </b>if you
                                            change your mind</div>
                                    </div>
                                </div>
                                <div class="extention__block extention__contact">
                                    <p> <span class="text-black">Hotline Order: </span>Free 7:00-21:30</p>
                                    {{-- <h4 class="extention__phone">{{ $company->phone }}</h4>
                                    <h4 class="extention__phone">970343-8888</h4> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="product__content">
                    <ul class="nav nav-pills" role="tablist" id="productTabDetail">
                        <li class="nav-item"><a class="nav-link active" id="description-tab" data-toggle="tab"
                                href="#description-content" role="tab" aria-controls="description-content"
                                aria-selected="true">Description</a></li>
                        <li class="nav-item"><a class="nav-link" id="nutrition-tab" data-toggle="tab"
                                href="#nutrition-content" role="tab" aria-controls="nutrition-content"
                                aria-selected="false">Nutrition</a></li>
                        <li class="nav-item"><a class="nav-link" id="reviews-tab" data-toggle="tab"
                                href="#reviews-content" role="tab" aria-controls="reviews-content"
                                aria-selected="false">Reviews(4)</a></li>
                        <li class="nav-item"><a class="nav-link" id="qa-tab" data-toggle="tab" href="#qa-content"
                                role="tab" aria-controls="qa-content" aria-selected="false">Q&A</a></li>
                        <li class="nav-item"><a class="nav-link" id="vendor-tab" data-toggle="tab"
                                href="#vendor-content" role="tab" aria-controls="vendor-content"
                                aria-selected="false">Vendor Info</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="description-content" role="tabpanel"
                            aria-labelledby="description-tab">
                            <p class="block-content">Raised without antibiotics and full of flavor, this beef is the base
                                of big, juicy burgers, savory meat loaf and rich Bolognese sauce. You can enjoy this
                                delicious local ground beef for your meatloaf, burgers, meatballs, shepherd's pie, spicy
                                taco meat and so much more.</p>
                            <p class="block-content">As one of Farmart's premium beef suppliers, <b
                                    class='text-black'>Local Angus</b> works with a coalition of small family farms
                                throughout the Mid-Atlantic region *who feed theri cattle a diet of primarily grass,
                                supplemented by grain throughout the finishing months. Every farm in this program is
                                independently audited for animal welfare practices to ensure the best standards of care.</p>
                            <img class="mb-3" src="img/products/product-default-content.jpg" alt>
                            <p class="text-center pb-4"><i>Every farm in this program is independently audited for
                                    animal.</i></p>
                            <div class="heading-1">Preparation and Usage</div>
                            <p class="block-content">For perfectly cooked beef, our head chef recommends:</p>
                            <div class="heading-2">Storage</div>
                            <p class="block-content">Keep refrigerated 0-5<sup>o</sup>C. Consume within the use by date.
                                Once pack is opened use on the same day. Suitable for free zing on day of purchase. Use
                                within one month. Defrost fully before use. Do not re-freeze once defrosted.</p>
                            <div class="heading-2">Pan Fry</div>
                            <p class="block-content">Pour a little oil into a frying pan and cook for 4-6 minutes until
                                browned. If preferred, drain off excess fat. Add a good beef stock, seasonal vegetables and
                                a sprinkling of sea salt and freshly ground black pepper. Bring to the boil and reduce heat
                                to simmer for 20 minutes until the meat is thoroughly cooked and your kitchen smells
                                delicious. Wash hands, knives and surfaxes thoroughly before and after preparing raw meat.
                            </p>
                            <div class="heading-2">Return To Address</div>
                            <p class="block-content"><span class='text-success'>Daylesford near Kingham, Gloucestershire
                                    GL56 OYG</span></p>
                            <p class="block-content">We choose British breeds who thrive in their native landscape and
                                encourage healthy biodiversity on our farm. We avoid waste of any kind, so manure and
                                kitchen waste compost are returned to the soil as rich natural fertilisers. We have built
                                our own abattoir to ensure the highest animal welfare and reduced food miles, which results
                                in better tasting meat, and we spread our message far beyond the boundaries of our own
                                fields.</p>
                            <p class="block-content">Each step of our journey is made with a conscience, and a love for
                                food.</p>
                        </div>
                        <div class="tab-pane fade" id="nutrition-content" role="tabpanel"
                            aria-labelledby="nutrition-tab">
                            <div class="heading-2">Ingredients </div>
                            <p class="block-content">Allergy Advice: For allergens see highlighted ingredients</p>
                            <p class="block-content">Beef, Preservatives (Potassium Lactate, Sodium Acetates, Sodium
                                Nitrite, Potassium Nitrite), Salt, Sugar, Maize Starch, Spices, Caramelised Sugar Powder,
                                Smoked Paprika, Garlic Powder, Onion Powder, Rapeseed Oil, Thyme, Parsley, Prepared with
                                109g of Beef per 100g of finished product.</p>
                            <div class="heading-2">Dietary Information </div>
                            <p class="block-content">May Contain Celery, May Contain Cereals Containing Gluten, May
                                Contain Eggs, May Contain Fish, May Contain Milk, May Contain Mustard, May Contain Soya.</p>
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th><b class="text-black">Typical Values(*)</b></th>
                                        <th><b class="text-black">per 100g</b></th>
                                        <th><b class="text-black">per slice (20g)</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Energy</td>
                                        <td>536kj</td>
                                        <td>107kj</td>
                                    </tr>
                                    <tr>
                                        <td>Fat</td>
                                        <td>127kcal</td>
                                        <td>25kcal</td>
                                    </tr>
                                    <tr>
                                        <td>Of which saturates</td>
                                        <td>0.9g</td>
                                        <td>0.2g</td>
                                    </tr>
                                    <tr>
                                        <td>Carbohydrate</td>
                                        <td>0.7g</td>
                                        <td>0.1g</td>
                                    </tr>
                                    <tr>
                                        <td>Of which sugars</td>
                                        <td>0.5g</td>
                                        <td>0.1g</td>
                                    </tr>
                                    <tr>
                                        <td>Fibre</td>
                                        <td>0.5g</td>
                                        <td>0.1g</td>
                                    </tr>
                                    <tr>
                                        <td>Protein</td>
                                        <td>24.2g</td>
                                        <td>4.8g</td>
                                    </tr>
                                    <tr>
                                        <td>Salt</td>
                                        <td>1.82g</td>
                                        <td>0.36g</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="text-center pb-4"><i>* Based on a 2,000 calorie diet. Your daily values may be
                                    higher or lower depending on your calorie needs:</i></p>
                        </div>
                        <div class="tab-pane fade" id="reviews-content" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="ps-product--reviews">
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="review__box">
                                            <div class="product__rate">4.5</div>
                                            <select class="rating-stars">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4" selected="selected">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            <p>Avg. Star Rating: <b class="text-black">(4 reviews)</b></p>
                                            <div class="review__progress">
                                                <div class="progress-item"><span class="star">5 Stars</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 80%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div><span class="percent">80%</span>
                                                </div>
                                                <div class="progress-item"><span class="star">4 Stars</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 20%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div><span class="percent">20%</span>
                                                </div>
                                                <div class="progress-item"><span class="star">3 Stars</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 0%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div><span class="percent">0%</span>
                                                </div>
                                                <div class="progress-item"><span class="star">2 Stars</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 0%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div><span class="percent">0%</span>
                                                </div>
                                                <div class="progress-item"><span class="star">1 Stars</span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-warning" role="progressbar"
                                                            style="width: 0%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div><span class="percent">0%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="review__title">Add A Review</div>
                                        <p class="mb-0">Your email will not be published. Required fields are marked
                                            <span class="text-danger">*</span>
                                        </p>
                                        <form>
                                            <div class="form-row">
                                                <div class="col-12 form-group--block">
                                                    <div class="input__rating">
                                                        <label>Your rating: <span>*</span></label>
                                                        <select class="rating-stars">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4" selected="selected">4</option>
                                                            <option value="5">5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 form-group--block">
                                                    <label>Review: <span>*</span></label>
                                                    <textarea class="form-control"></textarea>
                                                </div>
                                                <div class="col-12 col-lg-6 form-group--block">
                                                    <label>Name: <span>*</span></label>
                                                    <input class="form-control" type="text" required>
                                                </div>
                                                <div class="col-12 col-lg-6 form-group--block">
                                                    <label>Email:</label>
                                                    <input class="form-control" type="email">
                                                </div>
                                                <div class="col-12 form-group--block">
                                                    <button class="btn ps-button ps-btn-submit">Submit Review</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="ps--comments">
                                    <h5 class="comment__title">4 Comments</h5>
                                    <ul class="comment__list">
                                        <li class="comment__item">
                                            <div class="item__avatar"><img src="img/blogs/comment_avatar1.png"
                                                    alt="alt" /></div>
                                            <div class="item__content">
                                                <div class="item__name">Elyn Y.</div>
                                                <div class="item__date">- June 14, 2020</div>
                                                <div class="item__check"> <i class="icon-checkmark-circle"></i>Verified
                                                    Purchase</div>
                                                <div class="item__rate">
                                                    <select class="rating-stars">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4" selected="selected">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <p class="item__des">Farmart is great. Farmart is the most valuable
                                                    business resource we have EVER purchased. I have gotten at least 50
                                                    times the value from Farmart. I just can't get enough of Farmart. I want
                                                    to get a T-Shirt with Farmart on it so I can show it off to everyone.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="comment__item">
                                            <div class="item__avatar"><img src="img/blogs/comment_avatar2.png"
                                                    alt="alt" /></div>
                                            <div class="item__content">
                                                <div class="item__name">Rick E.</div>
                                                <div class="item__date">- June 14, 2020</div>
                                                <div class="item__check"> <i class="icon-checkmark-circle"></i>Verified
                                                    Purchase</div>
                                                <div class="item__rate">
                                                    <select class="rating-stars">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4" selected="selected">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                                <p class="item__des">Farmart is great. Farmart is the most valuable
                                                    business resource we have EVER purchased. I have gotten at least 50
                                                    times the value from Farmart. I just can't get enough of Farmart. I want
                                                    to get a T-Shirt with Farmart on it so I can show it off to everyone.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="comment__item">
                                            <div class="item__avatar"><img src="img/blogs/comment_no_avatar.png"
                                                    alt="alt" /></div>
                                            <div class="item__content">
                                                <div class="item__name">Timmi Y.</div>
                                                <div class="item__date">- June 13, 2020</div>
                                                <div class="item__check"> <i class="icon-checkmark-circle"></i>Verified
                                                    Purchase</div>
                                                <div class="item__rate">
                                                    <select class="rating-stars">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5" selected="selected">5</option>
                                                    </select>
                                                </div>
                                                <p class="item__des">Farmart is great. Farmart is the most valuable
                                                    business resource we have EVER purchased. I have gotten at least 50
                                                    times the value from Farmart. I just can't get enough of Farmart. I want
                                                    to get a T-Shirt with Farmart on it so I can show it off to everyone.
                                                </p>
                                            </div>
                                        </li>
                                        <li class="comment__item">
                                            <div class="item__avatar"><img src="img/blogs/comment_no_avatar.png"
                                                    alt="alt" /></div>
                                            <div class="item__content">
                                                <div class="item__name">Jack F.</div>
                                                <div class="item__date">- June 05, 2020</div>
                                                <div class="item__check"> <i class="icon-checkmark-circle"></i>Verified
                                                    Purchase</div>
                                                <div class="item__rate">
                                                    <select class="rating-stars">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5" selected="selected">5</option>
                                                    </select>
                                                </div>
                                                <p class="item__des">Farmart is great. Farmart is the most valuable
                                                    business resource we have EVER purchased. I have gotten at least 50
                                                    times the value from Farmart. I just can't get enough of Farmart. I want
                                                    to get a T-Shirt with Farmart on it so I can show it off to everyone.
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="qa-content" role="tabpanel" aria-labelledby="qa-tab">Q&A
                        </div>
                        <div class="tab-pane fade" id="vendor-content" role="tabpanel" aria-labelledby="vendor-tab">
                            Vendor Info</div>
                    </div>
                </div>
                <div class="product__related">
                    <h3 class="product__name">Related Products</h3>
                    <div class="owl-carousel" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000"
                        data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="5"
                        data-owl-item-xs="2" data-owl-item-sm="2" data-owl-item-md="3" data-owl-item-lg="5"
                        data-owl-item-xl="5" data-owl-duration="1000" data-owl-mousedrag="on">
                        <div class="ps-post--product">
                            <div class="ps-product--standard"><a href="product-default.html"><img
                                        class="ps-product__thumbnail" src="img/products/01-Fresh/01_29a.jpg"
                                        alt="alt" /></a><a class="ps-product__expand" href="javascript:void(0);"
                                    data-toggle="modal" data-target="#popupQuickview"><i class="icon-expand"></i></a>
                                <div class="ps-product__content">
                                    <p class="ps-product__type"><i class="icon-store"></i>Farmart</p>
                                    <h5><a class="ps-product__name" href="product-default.html">Michelob Ultra Cans</a>
                                    </h5>
                                    <p class="ps-product__unit">1.5L</p>
                                    <div class="ps-product__rating">
                                        <select class="rating-stars">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4" selected="selected">4</option>
                                            <option value="5">5</option>
                                        </select><span>(2)</span>
                                    </div>
                                    <p class="ps-product-price-block">
                                        @if(is_null($product->discount))
                                            <span class="ps-product__sale">{{ Custom::CURRENCY($product->unit_price) }}</span>
                                        @else
                                            <span class="ps-product__price">{{ Custom::CURRENCY(Custom::DISCOUNT($product->unit_price, $product->discount_type, $product->discount)) }}</span>
                                            <span class="ps-product__sale">{{ Custom::CURRENCY($product->unit_price) }}/span>
                                            <span class="ps-product__off">23% Off</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="ps-product__footer">
                                    <div class="def-number-input number-input safari_only">
                                        <button class="minus"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"><i
                                                class="icon-minus"></i></button>
                                        <input class="quantity" min="0" name="quantity" value="1"
                                            type="number" />
                                        <button class="plus"
                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"><i
                                                class="icon-plus"></i></button>
                                    </div>
                                    <div class="ps-product__total">Total: <span>$15.90</span>
                                    </div>
                                    <button class="ps-product__addcart" data-toggle="modal"
                                        data-target="#popupAddToCart"><i class="icon-cart"></i>Add to cart</button>
                                    <div class="ps-product__box"><a class="ps-product__wishlist"
                                            href="wishlist.html">Wishlist</a><a class="ps-product__compare"
                                            href="wishlist.html">Compare</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-recent--default ps-home--block">
            <div class="container">
                <div class="ps-block__header">
                    <h3 class="ps-block__title">Your Recent Viewed</h3><a class="ps-block__view"
                        href="shop-categories.html">View all <i class="icon-chevron-right"></i></a>
                </div>
                <div class="recent__content">
                    <div class="owl-carousel" data-owl-auto="true" data-owl-loop="false" data-owl-speed="5000"
                        data-owl-gap="0" data-owl-nav="true" data-owl-dots="true" data-owl-item="8"
                        data-owl-item-xs="3" data-owl-item-sm="3" data-owl-item-md="5" data-owl-item-lg="8"
                        data-owl-item-xl="8" data-owl-duration="1000" data-owl-mousedrag="on">
                        <a class="recent-item" href="index.html">
                            <img src="img/products/01-Fresh/01_1a.jpg" alt="alt" />
                        </a>
                    </div>
                </div>
            </div>
        </section>
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
                        const base_url = $(location).attr('protocol') + "//" + $(location).attr('host') + '/';
                        $('.list-cart').html('');
                        $.each(res.data.items, function(index, value) {
                            $('.list-cart').append(`<li class="cart-item">
                                <div class="ps-product--mini-cart"><a href="product-default/${value.slug}"><img
                                            class="ps-product__thumbnail" src="${base_url}${value.image}"
                                            alt="alt" /></a>
                                    <div class="ps-product__content"><a class="ps-product__name"
                                            href="product-default.html">${value.name}</a>
                                        <p class="ps-product__meta"> <span class="ps-product__price">${value.subPrice}</span><span
                                                class="ps-product__quantity">(x${value.quantity})</span>
                                        </p>
                                    </div>
                                    <div class="ps-product__remove"><i class="icon-trash2"></i>
                                    </div>
                                </div>
                            </li>`);
                        });
                        $('#total').html(res.data.total);
                    }

                })
        });
    </script>
@endpush
