<div class="section-slide--default">
    <div class="owl-carousel" data-owl-auto="false" data-owl-loop="true" data-owl-speed="5000" data-owl-gap="0"
        data-owl-nav="true" data-owl-dots="true" data-owl-item="1" data-owl-item-xs="1" data-owl-item-sm="1"
        data-owl-item-md="1" data-owl-item-lg="1" data-owl-duration="1000" data-owl-mousedrag="on">
        @if (!is_null($sliders))
        @foreach ($sliders as $slider)
            <div class="ps-banner">
                <img class="mobile-only" src="{{ asset('images/sliders/slide_01_mobile.png') }}" alt="alt" />
                <img class="desktop-only" src="{{ $slider->image }}" alt="alt" />
            </div>
        @endforeach
        @endif
    </div>
</div>
