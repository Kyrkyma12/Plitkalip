@extends('layouts.app')
@section('content')
    <main>
        <section class="swiper-container js-swiper-slider swiper-number-pagination slideshow" data-settings='{
    "autoplay": {
        "delay": 5000,
        "disableOnInteraction": false
    },
    "slidesPerView": 1,
    "effect": "fade",
    "loop": true,
    "speed": 1000
}'>
            <div class="swiper-wrapper">
                @foreach($slides as $slide)
                    <div class="swiper-slide">
                        <div class="overflow-hidden position-relative h-100">
                            <div class="slideshow-character position-absolute bottom-0 pos_right-center">
                                <img loading="lazy" src="{{ asset('uploads/slides') }}/{{ $slide->image }}" width="542" height="733"
                                     alt="Woman Fashion 1"
                                     class="slideshow-character__img animate animate_fade animate_btt animate_delay-9 w-auto h-auto" />
                                <div class="character_markup type2">
                                    <p class="text-uppercase font-sofia  animate animate_fade animate_btt animate_delay-10 mb-0">{{ $slide->tagline }}</p>
                                </div>
                            </div>
                            <div class="slideshow-texts container position-absolute start-50 top-50 translate-middle">
                                <h6 class="text_dash text_uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3"></h6>
                                <h2 class="h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">{{ $slide->title }}</h2>
                                <h2 class="h1 fw-bold mb-0 animate animate_fade animate_btt animate_delay-5">{{ $slide->subtitle }}</h2>
                                <a href="{{ $slide->link }}" class="btn-link btn-link_lg default-underline fw-medium animate animate_fade animate_btt animate_delay-7">{{__('Купить')}}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="container">
                <div
                    class="slideshow-pagination slideshow-number-pagination d-flex align-items-center position-absolute bottom-0 mb-5">
                </div>
            </div>
        </section>
        <div class="container mw-1620 bg-white border-radius-10">
            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
            <section class="category-carousel container">
                <h2 class="section-title text-center mb-3 pb-xl-2 mb-xl-4">{{__('Наша продукция')}}</h2>

                <div class="position-relative">
                    <div class="swiper-container js-swiper-slider" data-settings='{
                  "autoplay": {
                    "delay": 5000
                  },
                  "slidesPerView": 8,
                  "slidesPerGroup": 1,
                  "effect": "none",
                  "loop": true,
                  "navigation": {
                    "nextEl": ".products-carousel__next-1",
                    "prevEl": ".products-carousel__prev-1"
                  },
                  "breakpoints": {
                    "320": {
                      "slidesPerView": 2,
                      "slidesPerGroup": 2,
                      "spaceBetween": 15
                    },
                    "768": {
                      "slidesPerView": 4,
                      "slidesPerGroup": 4,
                      "spaceBetween": 30
                    },
                    "992": {
                      "slidesPerView": 6,
                      "slidesPerGroup": 1,
                      "spaceBetween": 45,
                      "pagination": false
                    },
                    "1200": {
                      "slidesPerView": 8,
                      "slidesPerGroup": 1,
                      "spaceBetween": 60,
                      "pagination": false
                    }
                  }
                }'>
                        <div class="swiper-wrapper">
                            @foreach($categories as $category)
                                <div class="swiper-slide">
                                    <a href="{{ route('shop.index', ['categories' => $category->id]) }}" class="menu-link fw-medium"><img loading="lazy" class="w-100 h-auto mb-3" src="{{ asset('uploads/categories') }}/{{ $category->image }}" width="124"
                                         height="124" alt="" /></a>
                                    <div class="text-center">
                                        <a href="{{ route('shop.index', ['categories' => $category->id]) }}" class="menu-link fw-medium">{{ $category->name }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div
                        class="products-carousel__prev products-carousel__prev-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_prev_md" />
                        </svg>
                    </div>
                    <div
                        class="products-carousel__next products-carousel__next-1 position-absolute top-50 d-flex align-items-center justify-content-center">
                        <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_next_md" />
                        </svg>
                    </div>
                </div>
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

            <section class="hot-deals container">
                <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">{{__('Акция')}}</h2>
                <div class="row">
                    <div
                        class="col-md-6 col-lg-4 col-xl-20per d-flex align-items-center flex-column justify-content-center py-4 align-items-md-start">
                        <h2>ВЕСЕННЯЯ РАСПРОДАЖА</h2>
                        <h2 class="fw-bold">До 40% скидки</h2>

                        <div class="position-relative d-flex align-items-center text-center pt-xxl-4 js-countdown mb-3"
                             data-date="18-3-2024" data-time="06:50">
                            <div class="day countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Days</span>
                            </div>

                            <div class="hour countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Hours</span>
                            </div>

                            <div class="min countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Mins</span>
                            </div>

                            <div class="sec countdown-unit">
                                <span class="countdown-num d-block"></span>
                                <span class="countdown-word text-uppercase text-secondary">Sec</span>
                            </div>
                        </div>

                        <a href="{{ route('shop.index') }}" class="btn-link default-underline text-uppercase fw-medium mt-3">{{__('СМОТРЕТЬ ВСЕ')}}</a>
                    </div>
                    <div class="col-md-6 col-lg-8 col-xl-80per">
                        <div class="position-relative">
                            <div class="swiper-container js-swiper-slider" data-settings='{
                      "autoplay": {
                        "delay": 5000
                      },
                      "slidesPerView": 4,
                      "slidesPerGroup": 4,
                      "effect": "none",
                      "loop": false,
                      "breakpoints": {
                        "320": {
                          "slidesPerView": 2,
                          "slidesPerGroup": 2,
                          "spaceBetween": 14
                        },
                        "768": {
                          "slidesPerView": 2,
                          "slidesPerGroup": 3,
                          "spaceBetween": 24
                        },
                        "992": {
                          "slidesPerView": 3,
                          "slidesPerGroup": 1,
                          "spaceBetween": 30,
                          "pagination": false
                        },
                        "1200": {
                          "slidesPerView": 4,
                          "slidesPerGroup": 1,
                          "spaceBetween": 30,
                          "pagination": false
                        }
                      }
                    }'>
                                <div class="swiper-wrapper">
                                    @foreach($sproducts as $sproduct)
                                        @if($sproduct->is_on_sale == 1)
                                        <div class="swiper-slide product-card product-card_style3">
                                            <div class="pc__img-wrapper">
                                                <a href="{{ route('shop.product.details', ['product_slug' => $sproduct->slug]) }}">
                                                    <img loading="lazy" src="{{ asset('uploads/products') }}/{{ $sproduct->image }}"
                                                         width="258" height="313" alt="{{ $sproduct->name }}" class="pc__img">
                                                </a>
                                            </div>

                                            <div class="pc__info position-relative">
                                                <h6 class="pc__title">
                                                    <a href="{{ route('shop.product.details', ['product_slug' => $sproduct->slug]) }}">
                                                        {{ $sproduct->name }}
                                                    </a>
                                                </h6>
                                                <div class="product-card__price d-flex">
                        <span class="money price text-secondary">
                            @if($sproduct->sale_price)
                                <s>${{ $sproduct->regular_price }}</s> ${{ $sproduct->sale_price }}
                            @else
                                ${{ $sproduct->regular_price }}
                            @endif
                        </span>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

            <section class="category-banner container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="category-banner__item border-radius-10 mb-5" >
                            <img loading="lazy" class="custom-height-box" src="{{ asset('assets/images/home/demo3/outdoors-cobblestone-texture.jpg') }}" width="690" height="665"
                                 alt="" />
                            <div class="category-banner__item-mark">
                                От 400₽
                            </div>
                            <div class="category-banner__item-content">
                                <h3 class="mb-0">Тротуарная плитка</h3>
                                <a href="{{ route('shop.index') }}" class="btn-link default-underline text-uppercase fw-medium">{{__('Смотреть')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="category-banner__item border-radius-10 mb-5">
                            <img loading="lazy" class="custom-height-box" src="{{ asset('assets/images/home/demo3/76c6c8d6_3612_11dd_86cb_005056c00008_5c348a30_934c_11ec_952d_00155da60401.jpeg') }}" width="690" height="665"
                                 alt="" />
                            <div class="category-banner__item-mark">
                                От 1000₽
                            </div>
                            <div class="category-banner__item-content">
                                <h3 class="mb-0">Железобетонные изделия</h3>
                                <a href="{{ route('shop.index') }}" class="btn-link default-underline text-uppercase fw-medium">{{__('Смотреть')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>

            <section class="products-grid container">
                <h2 class="section-title text-center mb-3 pb-xl-3 mb-xl-4">{{__('Что выбирают покупатели')}}</h2>
                <div class="row">
                    @foreach($fproducts as $fproduct)
                        <div class="col-6 col-md-4 col-lg-3">
                        <div class="product-card product-card_style3 mb-3 mb-md-4 mb-xxl-5">
                            <div class="pc__img-wrapper">
                                <a href="{{ route('shop.product.details', ['product_slug' => $fproduct->slug]) }}">
                                    <img loading="lazy" src="{{ asset('uploads/products') }}/{{ $fproduct->image }}" width="330" height="400"
                                         alt="{{ $fproduct->name }}" class="pc__img">
                                </a>
                            </div>

                            <div class="pc__info position-relative">
                                <h6 class="pc__title"><a href="{{ route('shop.product.details', ['product_slug' => $fproduct->slug]) }}">{{ $fproduct->name }}</a></h6>
                                <div class="product-card__price d-flex align-items-center">
                                    <span class="money price text-secondary">
                                                                                {{$fproduct->regular_price}}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="text-center mt-2">
                    <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium" href="{{route('shop.index')}}">{{__('Смотреть все')}}</a>
                </div>
            </section>
        </div>
        <style>
            .custom-height-box {
                height: 300px; 
            }
            @media (min-width: 768px) {
                .custom-height-box {
                    height: 500px; 
                }
            }
            .custom-height {
                height: 300px;
            }
        </style>
        <div class="mb-3 mb-xl-5 pt-1 pb-4"></div>
    </main>
@endsection
