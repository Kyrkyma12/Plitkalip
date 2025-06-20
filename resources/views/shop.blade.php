@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <section class="shop-main container d-flex pt-4 pt-xl-5">
            <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
                <div class="aside-header d-flex d-lg-none align-items-center">
                    <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                    <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
                </div>

                <div class="pt-4 pt-lg-0"></div>



                <div class="accordion accordion-flush" id="categories-filter" data-dependent-filters="true" data-filter-type="category">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-categories">
                            <button class="custom-accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#accordion-filter-categories"
                                    aria-expanded="true" aria-controls="accordion-filter-categories"
                            >
                                Категория
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"/>
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-categories" class="accordion-collapse collapse show border-0"
                             aria-labelledby="accordion-heading-categories" data-bs-parent="#categories-filter">
                            <div class="accordion-body px-0 pb-0">
                                <div class="d-flex flex-column gap-2">
                                    @foreach($categories as $category)
                                        <div class="category-item position-relative">
                                            <input type="checkbox" name="categories" value="{{ $category->id }}"
                                                   id="cat-{{ $category->id }}" class="category-checkbox visually-hidden"
                                                   @if(in_array($category->id, explode(',', $f_categories))) checked @endif>
                                            <label for="cat-{{ $category->id }}"
                                                   class="category-btn btn btn-outline-dark d-flex justify-content-between
                                      align-items-center w-100 rounded-2 p-3"
                                                   style="transition: all 0.2s ease;">
                                                <span class="category-name fw-medium">{{ $category->name }}</span>
                                                <span class="badge bg-dark rounded-pill ms-2">
                                {{ $category->products->count() }}
                            </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .category-btn {
                        border-width: 2px;
                        background: #f8f9fa;
                        text-align: left;
                    }

                    .category-btn:hover {
                        transform: translateX(5px);
                        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                    }

                    .category-checkbox:checked + .category-btn {
                        background: #212529;
                        border-color: #212529;
                        color: white;
                        transform: translateX(10px);
                    }

                    .category-checkbox:checked + .category-btn .badge {
                        background: #fff !important;
                        color: #212529;
                    }

                    .category-name {
                        flex-grow: 1;
                    }
                </style>

                <div class="secondary-filters" style="display: none;">

                <div class="accordion accordion-flush" id="size-filters" data-filter-type="size ">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-sizes">
                            <button class="custom-accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#accordion-filter-sizes"
                                    aria-expanded="true" aria-controls="accordion-filter-sizes">
                                Размеры
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"/>
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-sizes" class="accordion-collapse collapse show border-0"
                             aria-labelledby="accordion-heading-sizes" data-bs-parent="#size-filters">
                            <div class="accordion-body px-0 pb-0">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($sizes as $sizee)
                                        <div class="size-item position-relative">
                                            <input type="checkbox" name="sizes" value="{{ $sizee->id }}"
                                                   id="size-{{ $sizee->id }}" class="size-checkbox visually-hidden"
                                                   @if(in_array($sizee->id, explode(',', $f_sizes))) checked @endif>
                                            <label for="size-{{ $sizee->id }}"
                                                   class="size-btn btn btn-outline-dark d-flex align-items-center justify-content-center
                                      position-relative rounded-1 p-2"
                                                   style="min-width: 50px; transition: all 0.2s ease;">
                                                <span class="size-text">{{ $sizee->name }}</span>
                                                <span class="size-count position-absolute top-0 end-0 translate-middle badge bg-danger rounded-pill"
                                                      style="font-size: 0.6em; padding: 2px 4px;">
                                {{ $sizee->products->count() }}
                            </span>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .size-btn {
                        border-width: 2px;
                        background-color: #f8f9fa;
                        cursor: pointer;
                    }

                    .size-checkbox:checked + .size-btn {
                        background-color: #212529;
                        border-color: #212529;
                        color: white;
                        transform: scale(1.05);
                        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
                    }

                    .size-btn:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                    }

                    .size-count {
                        line-height: 1.2;
                        z-index: 1;
                    }
                </style>


                <div class="accordion accordion-flush" id="color-filters" >
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-color">
                            <button class="custom-accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#accordion-filter-color"
                                    aria-expanded="true" aria-controls="accordion-filter-color">
                                Цвет
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z"/>
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-color" class="accordion-collapse collapse show border-0"
                             aria-labelledby="accordion-heading-color" data-bs-parent="#color-filters">
                            <div class="accordion-body px-0 pb-0">
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($colors as $color)
                                        <div class="color-item position-relative" data-bs-toggle="tooltip"
                                             title="{{ $color->name }} ({{ $color->products->count() }})">
                                            <input type="checkbox" name="colors" value="{{ $color->id }}"
                                                   id="color-{{ $color->id }}" class="color-checkbox visually-hidden"
                                                   @if(in_array($color->id, explode(',', $f_colors))) checked @endif>
                                            <label for="color-{{ $color->id }}"
                                                   class="color-circle d-block rounded-circle position-relative"
                                                   style="background-color: {{ $color->code }};
                                      width: 40px;
                                      height: 40px;
                                      border: 2px solid {{ $color->is_light ? '#dee2e6' : 'transparent' }};">
                                                <div class="color-checked position-absolute top-50 start-50 translate-middle"
                                                     style="display: none;">
                                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                                         stroke="white" stroke-width="2">
                                                        <path d="M20 6L9 17l-5-5"/>
                                                    </svg>
                                                </div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .color-circle {
                        cursor: pointer;
                        transition: all 0.2s ease;
                        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                    }

                    .color-circle:hover {
                        transform: scale(1.1);
                        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
                    }

                    .color-checkbox:checked + .color-circle {
                        border-color: #000 !important;
                        box-shadow: 0 0 0 2px rgba(0,0,0,0.2);
                    }

                    .color-checkbox:checked + .color-circle .color-checked {
                        display: block !important;
                    }

                    .color-item {
                        margin: 3px;
                    }
                </style>








                <div class="border-bottom pb-3 mb-4">
                    <h6 class="text-uppercase mb-3">Тип товара</h6>
                    <div class="brand-list">
                        @foreach($brands as $brand)
                            <div class="brand-item position-relative py-1">
                                <input type="checkbox"
                                       name="brands[]"
                                       value="{{ $brand->id }}"
                                       id="brand_{{ $brand->id }}"
                                       class="brand-checkbox visually-hidden"
                                    @checked(in_array($brand->id, explode(',', $f_brands)))>
                                <label for="brand_{{ $brand->id }}"
                                       class="d-flex justify-content-between align-items-center text-decoration-none text-dark hover-bg-light rounded-2 p-2">
                                    <span class="fs-6">{{ $brand->name }}</span>
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-light text-dark">{{ $brand->products->count() }}</span>
                                        <div class="check-icon text-primary" style="opacity: 0;">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                                <path d="M20 6L9 17l-5-5"/>
                                            </svg>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <style>
                    .brand-item label {
                        transition: all 0.2s ease;
                        cursor: pointer;
                    }

                    .brand-item:hover label {
                        background-color: #f8f9fa;
                    }

                    .brand-checkbox:checked + label {
                        background-color: #f8f9fa;
                    }

                    .brand-checkbox:checked + label .check-icon {
                        opacity: 1 !important;
                    }

                    .brand-checkbox:checked + label .badge {
                        background-color: #e9ecef !important;
                    }
                </style>


{{--                <div class="accordion accordion-flush" id="price-filters">--}}
{{--                    <div class="accordion-item mb-4">--}}
{{--                        <h5 class="accordion-header mb-2" id="accordion-heading-price">--}}
{{--                            <button class="custom-accordion-button p-0 border-0 fs-5 text-uppercase" type="button" data-bs-toggle="collapse"--}}
{{--                                    data-bs-target="#accordion-filter-price" aria-expanded="true" aria-controls="accordion-filter-price">--}}
{{--                                Price--}}
{{--                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">--}}
{{--                                        <path--}}
{{--                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />--}}
{{--                                    </g>--}}
{{--                                </svg>--}}
{{--                            </button>--}}
{{--                        </h5>--}}
{{--                        <div id="accordion-filter-price" class="accordion-collapse collapse show border-0"--}}
{{--                             aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">--}}
{{--                            <input class="price-range-slider" type="text" name="price_range" value="" data-slider-min="1"--}}
{{--                                   data-slider-max="500" data-slider-step="5" data-slider-value="[{{$min_price}},{{$max_price}}]" data-currency="$" />--}}
{{--                            <div class="price-range__info d-flex align-items-center mt-2">--}}
{{--                                <div class="me-auto">--}}
{{--                                    <span class="text-secondary">Мин: </span>--}}
{{--                                    <span class="price-range__min">$1</span>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <span class="text-secondary">Макс: </span>--}}
{{--                                    <span class="price-range__max">$500</span>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>

            </div>

            <div class="shop-list flex-grow-1">
                <div class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split" data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 1,
            "effect": "fade",
            "loop": true,
            "pagination": {
              "el": ".slideshow-pagination",
              "type": "bullets",
              "clickable": true
            }
          }'>
                    <div class="swiper-wrapper">
                        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="assets/images/shop/3770775.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/images/shop/промо.png" class="d-block w-100" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="assets/images/shop/ассаортимент.png" class="d-block w-100" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container p-5 p-xl-9">
                        <div class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-9 pb-xl-2"></div>

                    </div>
                </div>

                <div class="mb-3 pb-2 pb-xl-3"></div>

                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="{{ route('home.index') }}" class="menu-link menu-link_us-s text-uppercase fw-medium">Главная</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Каталог</a>
                    </div>

                    <div class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                        <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0" aria-label="Page Size" id="pagesize" name="pagesize">
                            <option value="12" {{ $size==12 ? 'selected':'' }}>Смотреть</option>
                            <option value="24" {{ $size==24 ? 'selected':'' }}>24</option>
                            <option value="48" {{ $size==48 ? 'selected':'' }}>48</option>
                            <option value="102" {{ $size==102 ? 'selected':'' }}>102</option>
                        </select>

                        <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0" aria-label="Sort Items" name="orderBy" id="orderBy">
                            <option value="-1" {{ $order == -1 ? 'selected':'' }}>Сортировка по умолчанию</option>
                            <option value="1" {{ $order == 1 ? 'selected':'' }}>Дата, новые → старые</option>
                            <option value="2" {{ $order == 2 ? 'selected':'' }}>Дата, старые → новые</option>
                            <option value="3" {{ $order == 3 ? 'selected':'' }}>Цена, низкая → высокая</option>
                            <option value="4" {{ $order == 4 ? 'selected':'' }}>Цена, высокая → низкая</option>
                        </select>

                        <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div>

                        <div class="col-size align-items-center order-1 d-none d-lg-flex">
                            <span class="text-uppercase fw-medium me-2">Вид</span>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="2">2</button>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid" data-cols="3">3</button>
                            <button class="btn-link fw-medium js-cols-size" data-target="products-grid" data-cols="4">4</button>
                        </div>

                        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                            <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside" data-aside="shopFilter">
                                <svg class="d-inline-block align-middle me-2" width="14" height="10" viewBox="0 0 14 10" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_filter" />
                                </svg>
                                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                    @foreach($products as $product)
                        <div class="product-card-wrapper">
                        <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                            <div class="pc__img-wrapper">
                                <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <a href="{{ route('shop.product.details', ['product_slug'=>$product->slug]) }}">
                                                <img loading="lazy" src="{{ asset('uploads/products') }}/{{$product->image}}" width="330" height="400" alt="{{ $product->name }}" class="pc__img">
                                            </a>
                                        </div>
                                        <div class="swiper-slide">
                                            @foreach(explode(",", $product->images) as $gimg)
                                                <a href="{{ route('shop.product.details', ['product_slug'=>$product->slug]) }}">
                                                    <img loading="lazy" src="{{ asset('uploads/products') }}/{{ $gimg }}" width="330" height="400" alt="{{ $product->name }}" class="pc__img">
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <span class="pc__img-prev"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_prev_sm" />
                    </svg></span>
                                    <span class="pc__img-next"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                      <use href="#icon_next_sm" />
                    </svg></span>
                                </div>
                                @if(Cart::instance('cart')->content()->where('id', $product->id)->count() > 0)
                                    <a href="{{ route('cart.index') }}" class="btn-warning mb-3 pc__atc btn anim_appear-bottom btn position-absolute border border-secondary text-uppercase fw-medium "> В корзину</a>
                                @else
                                    <form name="addtocart-form" method="post" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}" />
                                        <input type="hidden" name="quantity" value="1" />
                                        <input type="hidden" name="name" value="{{ $product->name }}" />
                                        <input type="hidden" name="price" value="{{ $product->sale_price == '' ? $product->regular_price : $product->sale_price }}" />
                                        <button type="submit" class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium" data-aside="cartDrawer" title="Add To Cart">Добавит в корзину</button>
                                    </form>
                                @endif

                            </div>

                            <div class="pc__info position-relative">
                                <p class="pc__category">{{ $product->category->name }}</p>
                                <h6 class="pc__title"><a href="{{ route('shop.product.details', ['product_slug'=>$product->slug]) }}">{{ $product->name }}</a></h6>
                                <div class="product-card__price d-flex">
                                    <span class="money price ">
                                        @if($product->is_on_sale >= 1)
                                            <s>₽{{ $product->regular_price }} </s>  ₽{{ $product->sale_price }}
                                        @else
                                            ₽{{ $product->regular_price }}
                                        @endif
                                    </span>
                                </div>
                                <div class="product-card__price d-flex  gx-5">
                                    <span class="money price">
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
        @case(28) 12 мм@break
        @case(29) 10 мм@break
        @case(30) 8 мм@break
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
{{--                                    <span class="money price mx-5">--}}
{{--                                        {{ $product->width }}--}}
{{--                                    </span>--}}
                                </div>


{{--                                <div class="product-card__review d-flex align-items-center">--}}
{{--                                    <div class="reviews-group d-flex">--}}
{{--                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <use href="#icon_star" />--}}
{{--                                        </svg>--}}
{{--                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <use href="#icon_star" />--}}
{{--                                        </svg>--}}
{{--                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <use href="#icon_star" />--}}
{{--                                        </svg>--}}
{{--                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <use href="#icon_star" />--}}
{{--                                        </svg>--}}
{{--                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">--}}
{{--                                            <use href="#icon_star" />--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
{{--                                    <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>--}}
{{--                                </div>--}}

                                @if(Cart::instance('wishlist')->content()->where('id', $product->id)->count() > 0)
                                    <form method="POST" action="{{ route('wishlist.item.remove', ['rowId' => Cart::instance('wishlist')->content()->where('id', $product->id)->first()->rowId]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist filled-heart" title="Remove from Wishlist">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_heart" />
                                            </svg>
                                        </button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('wishlist.add') }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$product->id}}" />
                                        <input type="hidden" name="name" value="{{$product->name}}" />
                                        <input type="hidden" name="price" value="{{$product->sale_price == '' ? $product->regular_price : $product->sale_price}}" />
                                        <input type="hidden" name="quantity" value="1" />

                                        <button type="submit" class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist" title="Add To Wishlist">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_heart" />
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    @isset($products) {{-- Проверяем наличие переменной $products --}}
                    @if ($products->hasPages())
                        <div class="text-sm text-gray-600 mr-4">
                            @if ($products->total() > 0)
                                Показано с {{ $products->firstItem() }} по {{ $products->lastItem() }} из {{ $products->total() }} товаров
                            @else
                                Товары не найдены
                            @endif
                        </div>

                        <ul class="pagination">
                            {{-- Кнопка "Назад" --}}
                            @if ($products->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link">Назад</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->previousPageUrl() }}&{{ http_build_query(request()->except('page')) }}" rel="prev">Назад</a>
                                </li>
                            @endif

                            {{-- Номера страниц --}}
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}&{{ http_build_query(request()->except('page')) }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach

                            {{-- Кнопка "Вперед" --}}
                            @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $products->nextPageUrl() }}&{{ http_build_query(request()->except('page')) }}" rel="next">Вперед</a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link">Вперед</span>
                                </li>
                            @endif
                        </ul>
                    @endif
                    @endisset
                </div>
            </div>
        </section>
    </main>

    <form id="frmfilter" method="GET" action="{{route('shop.index')}}">
        @csrf
        <input type="hidden" name="page" value="{{$products->currentPage()}}">
        <input type="hidden" name="size" id="size" value="{{$size}}">
        <input type="hidden" name="order" id="order" value="{{$order}}">
        <input type="hidden" name="brands" id="hdnBrands" value="{{ $f_brands }}">
        <input type="hidden" name="categories" id="hdnCategories" value="{{ $f_categories }}">
        <input type="hidden" name="colors" id="hdnColors" value="{{ $f_colors }}">
        <input type="hidden" name="sizes" id="hdnSizes" value="{{ $f_sizes }}">
        <input type="hidden" name="min" id="hdnMinPrice" value="{{$min_price}}">
        <input type="hidden" name="max" id="hdnMaxPrice" value="{{$max_price}}">
    </form>
    <style>
        .secondary-filters {
            transition: opacity 0.3s ease;
            opacity: 0;
            display: none;
        }

        .secondary-filters.show {
            display: block;
            opacity: 1;
        }
    </style>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            document.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                   
                    const params = new URLSearchParams(window.location.search);

                    Получаем URL страницы пагинации
                    const pageUrl = new URL(this.href);

                   
                    const newParams = new URLSearchParams(pageUrl.search);
                    params.forEach((value, key) => {
                        if (key !== 'page' && !newParams.has(key)) {
                            newParams.append(key, value);
                        }
                    });

                    
                    window.location.href = `${pageUrl.pathname}?${newParams.toString()}`;
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
            const colorFilterSection = document.querySelector('#color-filters');
            const colorFilterCheckboxes = document.querySelectorAll('.color-checkbox');

            
            const categoriesToHideColor = ['3', '6', '4', '8', '9']; 

            
            function shouldHideColorFilter() {
                const selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked'))
                    .map(cb => cb.value);

                
                if (selectedCategories.length === 1 && categoriesToHideColor.includes(selectedCategories[0])) {
                    return true;
                }

                
                return false;
            }

            
            function updateColorFilterVisibility() {
                if (shouldHideColorFilter()) {
                    
                    colorFilterSection.style.opacity = '0';
                    setTimeout(() => {
                        colorFilterSection.style.display = 'none';

                        
                        colorFilterCheckboxes.forEach(checkbox => {
                            checkbox.checked = false;
                        });

                        
                        document.getElementById('hdnColors').value = '';
                    }, 300);
                } else {
                    
                    colorFilterSection.style.display = 'block';
                    setTimeout(() => {
                        colorFilterSection.style.opacity = '1';
                    }, 10);
                }
            }

            
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    
                    const selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked'))
                        .map(c => c.value)
                        .join(',');
                    document.getElementById('hdnCategories').value = selectedCategories;

                    
                    updateColorFilterVisibility();

                    
                    document.getElementById('frmfilter').submit();
                });
            });

            
            updateColorFilterVisibility();

            
            colorFilterSection.style.transition = 'opacity 0.3s ease';
        });
        document.addEventListener('DOMContentLoaded', function() {
            
            const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
            const secondaryFilters = document.querySelector('.secondary-filters');

            
            function initFilters() {
                const hasCategories = document.querySelectorAll('.category-checkbox:checked').length > 0;
                secondaryFilters.style.display = hasCategories ? 'block' : 'none';
                secondaryFilters.style.opacity = hasCategories ? '1' : '0';
            }

            // 
            function handleCategoryChange() {
                const selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked'))
                    .map(c => c.value).join(',');
                document.getElementById('hdnCategories').value = selectedCategories;
                initFilters();
                submitForm();
            }

            
            function handleFilterChange() {
                document.getElementById('hdnSizes').value =
                    Array.from(document.querySelectorAll('.size-checkbox:checked')).map(c => c.value).join(',');
                document.getElementById('hdnColors').value =
                    Array.from(document.querySelectorAll('.color-checkbox:checked')).map(c => c.value).join(',');
                document.getElementById('hdnBrands').value =
                    Array.from(document.querySelectorAll('.brand-checkbox:checked')).map(c => c.value).join(',');
                submitForm();
            }

            
            function handlePriceChange() {
                const [min, max] = this.value.split(',');
                document.getElementById('hdnMinPrice').value = min;
                document.getElementById('hdnMaxPrice').value = max;
                submitForm();
            }

            
            function submitForm() {
                document.getElementById('frmfilter').submit();
            }

            
            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', handleCategoryChange);
            });

            document.querySelectorAll('.size-checkbox, .color-checkbox, .brand-checkbox').forEach(element => {
                element.addEventListener('change', handleFilterChange);
            });

            $("[name='price_range']").on("change", handlePriceChange);

            
            initFilters();
        });
        document.addEventListener('DOMContentLoaded', function() {
            
            const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
            const secondaryFilters = document.querySelector('.secondary-filters');

            function toggleSecondaryFilters() {
                const anyCategorySelected = Array.from(categoryCheckboxes).some(cb => cb.checked);
                if(anyCategorySelected) {
                    secondaryFilters.style.display = 'block';
                    setTimeout(() => secondaryFilters.style.opacity = '1', 10);
                } else {
                    secondaryFilters.style.opacity = '0';
                    setTimeout(() => secondaryFilters.style.display = 'none', 300);
                    resetSecondaryFilters();
                }
            }

            function resetSecondaryFilters() {
                document.querySelectorAll('.secondary-filters input:checked').forEach(input => {
                    input.checked = false;
                });
                document.getElementById('hdnSizes').value = '';
                document.getElementById('hdnColors').value = '';
                document.getElementById('hdnBrands').value = '';
            }

            categoryCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    document.getElementById('hdnCategories').value =
                        Array.from(document.querySelectorAll('.category-checkbox:checked'))
                            .map(c => c.value).join(',');
                    toggleSecondaryFilters();
                    submitForm();
                });
            });

            
            function handleFilterChange() {
                document.getElementById('hdnSizes').value =
                    Array.from(document.querySelectorAll('.size-checkbox:checked')).map(c => c.value).join(',');
                document.getElementById('hdnColors').value =
                    Array.from(document.querySelectorAll('.color-checkbox:checked')).map(c => c.value).join(',');
                document.getElementById('hdnBrands').value =
                    Array.from(document.querySelectorAll('.brand-checkbox:checked')).map(c => c.value).join(',');
                submitForm();
            }

            
            document.querySelectorAll('.size-checkbox, .color-checkbox, .brand-checkbox').forEach(element => {
                element.addEventListener('change', handleFilterChange);
            });

            
            $("[name='price_range']").on("change", function(){
                const [min, max] = this.value.split(',');
                document.getElementById('hdnMinPrice').value = min;
                document.getElementById('hdnMaxPrice').value = max;
                submitForm();
            });

            
            function submitForm() {
                document.getElementById('frmfilter').submit();
            }

            
            toggleSecondaryFilters();
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.brand-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selected = Array.from(document.querySelectorAll('.brand-checkbox:checked'))
                        .map(cb => cb.value).join(',');
                    document.getElementById('hdnBrands').value = selected;
                    document.getElementById('frmfilter').submit();
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.category-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selectedCategories = Array.from(document.querySelectorAll('.category-checkbox:checked'))
                        .map(c => c.value)
                        .join(',')
                    document.getElementById('hdnCategories').value = selectedCategories
                    document.getElementById('frmfilter').submit()
                })
            })
        })
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.size-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selectedSizes = Array.from(document.querySelectorAll('.size-checkbox:checked'))
                        .map(c => c.value)
                        .join(',')
                    document.getElementById('hdnSizes').value = selectedSizes
                    document.getElementById('frmfilter').submit()
                })
            })
        })
        document.addEventListener('DOMContentLoaded', function() {
            // Инициализация тултипов
            const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]')
            tooltips.forEach(t => new bootstrap.Tooltip(t))

            // Обработка изменения чекбоксов
            document.querySelectorAll('.color-checkbox').forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const selectedColors = Array.from(document.querySelectorAll('.color-checkbox:checked'))
                        .map(c => c.value)
                        .join(',')
                    document.getElementById('hdnColors').value = selectedColors
                    document.getElementById('frmfilter').submit()
                })
            })
        })
        $(function(){
            
            $("#pagesize").on("change", function(){
                $("#size").val($("#pagesize option:selected").val());
                $("#frmfilter").submit();
            });

            $("#orderBy").on("change", function(){
                $("#order").val($("#orderBy option:selected").val());
                $("#frmfilter").submit();
            });

            $("input[name='brands']").on("change", function(){
                var brands = "";
                $("input[name='brands']:checked").each(function(){
                    if(brands == "") {
                        brands += $(this).val();
                    } else {
                        brands += "," + $(this).val();
                    }
                });
                $("#hdnBrands").val(brands);
                $("#frmfilter").submit();
            });

            $("input[name='categories']").on("change", function(){
                var categories = "";
                $("input[name='categories']:checked").each(function(){
                    if(categories == "") {
                        categories += $(this).val();
                    } else {
                        categories += "," + $(this).val();
                    }
                });
                $("#hdnCategories").val(categories);
                $("#frmfilter").submit();
            });

            $("input[name='colors']").on("change", function(){
                var colors = "";
                $("input[name='colors']:checked").each(function(){
                    if(colors == "") {
                        colors += $(this).val();
                    } else {
                        colors += "," + $(this).val();
                    }
                });
                $("#hdnColors").val(colors);
                $("#frmfilter").submit();
            });

            $("input[name='sizes']").on("change", function(){
                var sizes = "";
                $("input[name='sizes']:checked").each(function(){
                    if(sizes == "") {
                        sizes += $(this).val();
                    } else {
                        sizes += "," + $(this).val();
                    }
                });
                $("#hdnSizes").val(sizes);
                $("#frmfilter").submit();
            });

            $("[name='price_range']").on("change", function(){
                var min = $(this).val().split(',')[0];
                var max = $(this).val().split(',')[1];

                $("#hdnMinPrice").val(min);
                $("#hdnMaxPrice").val(max);
                setTimeout(() => {
                    $("#frmfilter").submit();
                }, 2000);
            });
        });
        $(function(){
            $("#pagesize").on("change", function(){
                $("#size").val($("#pagesize option:selected").val());
                $("#frmfilter").submit();
            });

            $("#orderBy").on("change", function(){
                $("#order").val($("#orderBy option:selected").val());
                $("#frmfilter").submit();
            });

            $("input[name='brands']").on("change", function(){
                var brands = "";
                $("input[name='brands']:checked").each(function(){
                    if(brands == "")
                    {
                        brands += $(this).val();
                    }
                    else
                    {
                        brands += "," + $(this).val();
                    }
                });
                $("#hdnBrands").val(brands);
                $("#frmfilter").submit();
            });

            $("input[name='categories']").on("change", function(){
                var categories = "";
                $("input[name='categories']:checked").each(function(){
                    if(categories == "")
                    {
                        categories += $(this).val();
                    }
                    else
                    {
                        categories += "," + $(this).val();
                    }
                });
                $("#hdnCategories").val(categories);
                $("#frmfilter").submit();
            });
        });

        $("[name='price_range']").on("change", function(){
            var min = $(this).val().split(',')[0];
            var max = $(this).val().split(',')[1];

            $("#hdnMinPrice").val(min);
            $("#hdnMaxPrice").val(max);
            setTimeout(() => {
                $("#frmfilter").submit();
            }, 2000)
        })
    </script>
@endpush
