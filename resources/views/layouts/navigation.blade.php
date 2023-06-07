<nav class="navigation">
    <div class="container">
        <ul class="menu">
            <li class="menu-item-has-children has-mega-menu"><a class="nav-link" href="{{ route('welcome') }}">হোম</a></li>
            @foreach (Layouts::NAVIGATION() as $nav)
                @if (count($nav->category))
                    <li class="menu-item-has-children has-mega-menu active"><a class="nav-link active"
                            href="javascript:void(0);">{{ $nav->nav_bn }}</a><span class="sub-toggle"><i
                                class="icon-chevron-down"></i></span>
                        <div class="mega-menu">
                            <div class="mega-anchor"></div>

                            @php
                                $total_category = count($nav->category);
                                $category1[] = [];
                                $category2[] = [];
                                $category3[] = [];
                                $cat_2_start = 0;
                                $cat_3_start = 0;
                                for ($i = 0; $i < $total_category; $i++) {
                                    if ($i > 5 && $i < 12) {
                                        $category2[$cat_2_start] = $nav->category[$cat_2_start];
                                        $cat_2_start++;
                                    } elseif ($i > 11 && $i < 18) {
                                        $category3[$cat_3_start] = $nav->category[$cat_3_start];
                                        $cat_3_start++;
                                    } else {
                                        $category1[$i] = $nav->category[$i];
                                    }
                                }
                            @endphp
                            @if (count($category1) > 1)
                                <div class="mega-menu__column">
                                    <ul class="sub-menu--mega">
                                        @foreach ($category1 as $cat1)
                                            <li><a href="/categories/products/{{$cat1->slug}}">{{ $cat1->category_bn }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (count($category2) > 1)
                                <div class="mega-menu__column">
                                    <ul class="sub-menu--mega">
                                        @foreach ($category2 as $cat2)
                                            <li><a href="/categories/products/{{$cat2->slug}}">{{ $cat2->category_bn }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (count($category3) > 1)
                                <div class="mega-menu__column">
                                    <ul class="sub-menu--mega">
                                        @foreach ($category3 as $cat3)
                                            <li><a href="/categories/products/{{$cat3->slug}}">{{ $cat3->category_bn }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </li>
                @else
                    <li class="menu-item-has-children has-mega-menu"><a class="nav-link"
                            href="{{ route('welcome') }}?slug={{ $nav->slug }}">{{ $nav->nav_bn }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
</nav>
