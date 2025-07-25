@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-md-1 pb-md-3"></div>
        <section class="product-single container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                        <div class="product-single__image">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item">
                                        <img loading="lazy" class="h-auto" src="{{ asset('uploads/products') }}/{{$product->image}}" width="674"
                                             height="674" alt="" />
                                        <a data-fancybox="gallery" href="{{ asset('uploads/products') }}/{{ $product->image }}" data-bs-toggle="tooltip"
                                           data-bs-placement="left" title="Zoom">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_zoom" />
                                            </svg>
                                        </a>
                                    </div>

                                    @foreach(explode(',',$product->images) as $gimg)
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto" src="{{ asset('uploads/products') }}/{{$gimg}}" width="674"
                                                 height="674" alt="" />
                                            <a data-fancybox="gallery" href="{{ asset('uploads/products') }}/{{$gimg}}" data-bs-toggle="tooltip"
                                               data-bs-placement="left" title="Zoom">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_zoom" />
                                                </svg>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_sm" />
                                    </svg></div>
                                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_sm" />
                                    </svg></div>
                            </div>
                        </div>
                        <div class="product-single__thumbnail">
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide product-single__image-item">
                                        <img loading="lazy" class="h-auto" src="{{ asset('uploads/products/thumbnails') }}/{{$product->image}}" width="104" height="104" alt="" />
                                    </div>
                                    @foreach(explode(',', $product->images) as $gimg)
                                        <div class="swiper-slide product-single__image-item">
                                            <img loading="lazy" class="h-auto" src="{{ asset('uploads/products/thumbnails') }}/{{$gimg}}" width="104" height="104" alt="" />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Главная</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Каталог</a>
                        </div><!-- /.breadcrumb -->

{{--                        <div--}}
{{--                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">--}}
{{--                            <a href="#" class="text-uppercase fw-medium"><svg width="10" height="10" viewBox="0 0 25 25"--}}
{{--                                                                              xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <use href="#icon_prev_md" />--}}
{{--                                </svg><span class="menu-link menu-link_us-s">Предыдущая</span></a>--}}
{{--                            <a href="#" class="text-uppercase fw-medium"><span class="menu-link menu-link_us-s">Next</span><svg--}}
{{--                                    width="10" height="10" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <use href="#icon_next_md" />--}}
{{--                                </svg></a>--}}
{{--                        </div><!-- /.shop-acs -->--}}
                    </div>
                    <h1 class="product-single__name">{{ $product->name }}</h1>

                    <div class="product-single__price">
                        <span class="current-price">
                            @if($product->is_one_sale > 0)
                                <s>₽{{$product->regular_price}} </s> ₽ {{ $product->sale_price }}
                            @else
                                ₽{{ $product->regular_price }}
                            @endif
                        </span>
                    </div>
                    <div class="product-single__short-desc">
                        <p>{{ $product->short_description }}</p>
                    </div>

                    @if(Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                        <a href="{{ route('cart.index') }}" class="btn btn-warning mb-3"> В корзину</a>
                    @else
                        <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                            @csrf
                            <div class="product-single__addtocart">
                                <div class="qty-control position-relative">
                                    <input type="number" name="quantity" value="1" min="1" class="qty-control__number text-center">
                                    <div class="qty-control__reduce">-</div>
                                    <div class="qty-control__increase">+</div>
                                </div><!-- .qty-control -->
                                <input type="hidden" name="id" value="{{ $product->id }}" />
                                <input type="hidden" name="name" value="{{ $product->name }}" />
                                <input type="hidden" name="price" value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}" />

                                <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">Добавить в корзину</button>
                            </div>
                        </form>
                    @endif
                    <div class="product-single__addtolinks">
                        @if(Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0 )
                            <form method="POST" action="{{ route('wishlist.item.remove', ['rowId' => Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId]) }}" id="frm-remove-item">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0)" class="menu-link menu-link_us-s add-to-wishlist filled-heart" onclick="document.getElementById('frm-remove-item').submit();"><svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_heart" />
                                </svg><span>      Удалить из избранного</span></a>
                            </form>
                        @else
                            <form method="POST" action="{{ route('wishlist.add') }}" id="wishlist-form">
                                @csrf
                                <input type="hidden" name="id" value="{{$product->id}}" />
                                <input type="hidden" name="name" value="{{$product->name}}" />
                                <input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->regular_price : $product->sale_price}}" />
                                <input type="hidden" name="quantity" value="1" />
                                <a href="javascript:void(0)" class="menu-link menu-link_us-s add-to-wishlist" onclick="document.getElementById('wishlist-form').submit();"><svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" >
                                        <use href="#icon_heart" />
                                    </svg><span>Добавить избранное</span></a>
                            </form>
                        @endif
                        <share-button class="share-button">

                            <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                <div id="Article-share-template__main"
                                     class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                                    <div class="field grow mr-4">
                                        <label class="field__label sr-only" for="url">Link</label>
                                        <input type="text" class="field__input w-full" id="url"
                                               value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                               placeholder="Link" onclick="this.select();" readonly="">
                                    </div>
                                    <button class="share-button__copy no-js-hidden">
                                        <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13" fill="none"
                                             xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" viewBox="0 0 11 13">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                  fill="currentColor"></path>
                                        </svg>
                                        <span class="sr-only">Copy link</span>
                                    </button>
                                </div>
                            </details>
                        </share-button>
                        <script src="js/details-disclosure.html" defer="defer"></script>
                        <script src="js/share.html" defer="defer"></script>
                    </div>
                    <div class="product-single__meta-info">
                        <div class="meta-item">
                            <label>Количество:</label>
                            <span>{{ $product->SKU }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Категория:</label>
                            <span>{{ $product->category->name }}</span>
                        </div>
                        <div class="meta-item">
                            <label>Цвет:</label>
                            @switch($product->color_id)
                                @case(1) Красный@break
                                @case(2) Серый@break
                                @case(3) Желтый@break
                                @case(4) Коричневый@break
                            @endswitch
                        </div>
                        <div class="meta-item">
                                <div class="meta-item">
                                    <label>Размер:</label>
                                    <span>
    @switch($product->size_id)
                                            @case(1) 250x250x25 @break
                                            @case(2) 300x300x30 @break
                                            @case(3) 400x400x50 @break
                                            @case(4) 300x300x35 @break
                                            @case(5) 500x300x200 @break
                                            @case(6) 500x210x40 @break
                                            @case(7) 500x300x200 @break
                                            @case(8) 500x210x50 @break
                                            @case(9) 350x150x60 @break
                                            @case(10) 500x150x60 @break
                                            @case(11) 80 @break
                                            @case(12) 200x100x60 @break
                                            @case(13) 1000x200x80 @break
                                            @case(14) 1000x300x150 @break
                                            @case(15) 390x190x190 @break
                                            @case(16) 80x80x3 @break
                                            @case(18) 80x60x3 @break
                                            @case(19) 80x40x2 @break
                                            @case(20) 60x60x2 @break
                                            @case(21) 50x50x2 @break
                                            @case(22) 40x40x1.5 @break
                                            @case(23) 40x20x2 @break
                                            @case(24) 40x20x1.5 @break
                                            @case(25) 75x75x5 @break
                                            @case(26) 63x63x5 @break
                                            @case(27) 40x40x4 @break
                                            @case(28) 12 @break
                                            @case(29) 10 @break
                                            @case(30) 8 @break
                                            @case(31) 1000x220x75 @break
                                            @case(32) 10x9 @break
                                            @case(33) 15x9 @break
                                            @case(34) 20x9 @break
                                            @case(35) 7x9 @break
                                            @case(36) 7x6 @break
                                            @case(37) 7x3 @break
                                            @case(38) 10x15 @break
                                            @case(39) 15x15 @break
                                            @case(40) 20x16 @break
                                            @case(41) 60x40x2 @break
                                            @case(42) 630 @break
                                            @case(43) 50 кг @break
                                            @case(44) 25 кг @break
                                            @case(45) 35 кг @break
                                        @endswitch
</span>
                                </div>
                        <div class="meta-item">
                            <label>Вес:</label>
                            {{$product->width}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-single__details-tab">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                           href="#tab-description" role="tab" aria-controls="tab-description" aria-selected="true">Описание</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                           href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                           aria-selected="false">Дополнительная информация</a>
                    </li>
{{--                    <li class="nav-item" role="presentation">--}}
{{--                        <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab" href="#tab-reviews"--}}
{{--                           role="tab" aria-controls="tab-reviews" aria-selected="false">Reviews (2)</a>--}}
{{--                    </li>--}}
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                         aria-labelledby="tab-description-tab">
                        <div class="product-single__description">
                            <h1 class="block-title mb-4">{{ $product->name }}</h1>
                            <p class="content">{{ $product->description }}</p>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="block-title">Почему стоит выбрать именно этот продукт?</h3>
                                    <ul class="list text-list">
                                        <li>Высокая прочность и долговечность – устойчива к механическим нагрузкам, перепадам температур и воздействию влаги.</li>
                                        <li>Простота укладки – удобная форма и точные размеры облегчают монтаж.</li>
                                        <li>Эстетичный внешний вид – разнообразие цветов и текстур позволяет подобрать плитку под любой стиль.</li>
                                    </ul>
                                </div>
{{--                                <div class="col-lg-6">--}}
{{--                                    <h3 class="block-title">Sample Number List</h3>--}}
{{--                                    <ol class="list text-list">--}}
{{--                                        <li>Create Store-specific attrittbutes on the fly</li>--}}
{{--                                        <li>Simple, Configurable (e.g. size, color, etc.), bundled</li>--}}
{{--                                        <li>Downloadable/Digital Products, Virtual Products</li>--}}
{{--                                    </ol>--}}
{{--                                </div>--}}
                            </div>
{{--                            <h3 class="block-title mb-0">Lining</h3>--}}
{{--                            <p class="content">100% Polyester, Main: 100% Polyester.</p>--}}
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel" aria-labelledby="tab-additional-info-tab">
                        <div class="product-single__addtional-info">
                            <div class="item">
                                <label class="h6">Вес</label>
                                <span>{{$product->width}} кг</span>
                            </div>
                            <div class="item">
                                <label class="h6">Размер</label>
                                @if($product->size_id = 1) @endif
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                        <h2 class="product-single__reviews-title">Reviews</h2>
                        <div class="product-single__reviews-list">
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Janice Miller</h6>
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod
                                            maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                            <div class="product-single__reviews-item">
                                <div class="customer-avatar">
                                    <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                                </div>
                                <div class="customer-review">
                                    <div class="customer-name">
                                        <h6>Benjam Porter</h6>
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="review-date">April 06, 2023</div>
                                    <div class="review-text">
                                        <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod
                                            maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-single__review-form">
                            <form name="customer-review-form">
                                <h5>Be the first to review “Message Cotton T-Shirt”</h5>
                                <p>Your email address will not be published. Required fields are marked *</p>
                                <div class="select-star-rating">
                                    <label>Your rating *</label>
                                    <span class="star-rating">
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                    <svg class="star-rating__star-icon" width="12" height="12" fill="#ccc" viewBox="0 0 12 12"
                         xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M11.1429 5.04687C11.1429 4.84598 10.9286 4.76562 10.7679 4.73884L7.40625 4.25L5.89955 1.20312C5.83929 1.07589 5.72545 0.928571 5.57143 0.928571C5.41741 0.928571 5.30357 1.07589 5.2433 1.20312L3.73661 4.25L0.375 4.73884C0.207589 4.76562 0 4.84598 0 5.04687C0 5.16741 0.0870536 5.28125 0.167411 5.3683L2.60491 7.73884L2.02902 11.0871C2.02232 11.1339 2.01563 11.1741 2.01563 11.221C2.01563 11.3951 2.10268 11.5558 2.29688 11.5558C2.39063 11.5558 2.47768 11.5223 2.56473 11.4754L5.57143 9.89509L8.57813 11.4754C8.65848 11.5223 8.75223 11.5558 8.84598 11.5558C9.04018 11.5558 9.12054 11.3951 9.12054 11.221C9.12054 11.1741 9.12054 11.1339 9.11384 11.0871L8.53795 7.73884L10.9688 5.3683C11.0558 5.28125 11.1429 5.16741 11.1429 5.04687Z" />
                    </svg>
                  </span>
                                    <input type="hidden" id="form-input-rating" value="" />
                                </div>
                                <div class="mb-4">
                  <textarea id="form-input-review" class="form-control form-control_gray" placeholder="Your Review"
                            cols="30" rows="8"></textarea>
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-name" class="form-label">Name *</label>
                                    <input id="form-input-name" class="form-control form-control-md form-control_gray">
                                </div>
                                <div class="form-label-fixed mb-4">
                                    <label for="form-input-email" class="form-label">Email address *</label>
                                    <input id="form-input-email" class="form-control form-control-md form-control_gray">
                                </div>
                                <div class="form-check mb-4">
                                    <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="remember_checkbox">
                                    <label class="form-check-label" for="remember_checkbox">
                                        Save my name, email, and website in this browser for the next time I comment.
                                    </label>
                                </div>
                                <div class="form-action">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="products-carousel container">
            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Рекомендуемая <strong>продукция</strong></h2>

            <div id="related_products" class="position-relative">
                <div class="swiper-container js-swiper-slider" data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
                    <div class="swiper-wrapper">
                        @foreach($rproducts as $rproduct)
                            <div class="swiper-slide product-card">
                                <div class="pc__img-wrapper">
                                    <a href="{{ route('shop.product.details', ['product_slug'=>$rproduct->slug]) }}">
                                        <img loading="lazy" src="{{ asset('uploads/products') }}/{{$rproduct->image}}" width="330" height="400" alt="{{$rproduct->name}}" class="pc__img">
                                        @foreach(explode(',', $rproduct->images) as $gimg)
                                            <img loading="lazy" src="{{ asset('uploads/products') }}/{{$gimg}}" width="330" height="400" alt="{{$rproduct->name}}" class="pc__img pc__img-second">
                                        @endforeach
                                    </a>
                                    @if(Cart::instance('cart')->content()->where('id', $rproduct->id)->count() > 0)
                                        <a href="{{ route('cart.index') }}" class="btn-warning mb-3 pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium"> Go to Cart</a>
                                    @else
                                        <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $rproduct->id }}" />
                                            <input type="hidden" name="quantity" value="1" />
                                            <input type="hidden" name="name" value="{{ $rproduct->name }}" />
                                            <input type="hidden" name="price" value="{{ $rproduct->sale_price == '' ? $rproduct->regular_price : $rproduct->sale_price }}" />
                                            <button type="submit" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                                        </form>
                                    @endif
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">{{ $rproduct->category->name }}</p>
                                    <h6 class="pc__title"><a href="{{ route('shop.product.details', ['product_slug'=>$product->slug]) }}">{{ $rproduct->name }}</a></h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">
                                            @if($product->sale_price)
                                                <s>${{ $product->regular_price }} </s> ${{ $rproduct->sale_price }}
                                            @else
                                                ${{ $product->regular_price }}
                                            @endif
                                        </span>
                                    </div>

                                    <button class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div><!-- /.swiper-wrapper -->
                </div><!-- /.swiper-container js-swiper-slider -->

                <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_prev_md" />
                    </svg>
                </div><!-- /.products-carousel__prev -->
                <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_next_md" />
                    </svg>
                </div><!-- /.products-carousel__next -->

                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                <!-- /.products-pagination -->
            </div><!-- /.position-relative -->

        </section><!-- /.products-carousel container -->
    </main>
@endsection
