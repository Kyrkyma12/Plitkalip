@extends('layouts.app')
@section('content')
    <style>
        .text-success{
            color: #278c04;
        }

        .text-danger{
            color: #d61808;
        }
    </style>
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Корзина</h2>
            <div class="checkout-steps">
                <a href="javascript:void(0)" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
            <span>Список покупок</span>
            <em>Управляй своими покупками</em>
          </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
            <span>Доставка и оформление заказа</span>
            <em>Проверьте свой список товара</em>
          </span>
                </a>
                <a href="javascript:void(0)" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
            <span>Подтверждение</span>
            <em>Проверте свой заказ</em>
          </span>
                </a>
            </div>
            <div class="shopping-cart">
                @if($items->count() > 0)
                    <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                        <tr>
                            <th>Продукт</th>
                            <th></th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Итог</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            <img loading="lazy" src="{{ asset('uploads/products/thumbnails') }}/{{$item->model->image}}" width="120" height="120" alt="{{$item->name}}" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>{{ $item->name }}</h4>
                                            <ul class="shopping-cart__product-item__options">
                                                <li>{{ $item->color }}</li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__product-price">$ {{ $item->price }}</span>
                                    </td>
                                    <td>
                                        <div class="qty-control position-relative">
                                            <input type="number" name="quantity" value="{{ $item->qty }}" min="1" class="qty-control__number text-center">
                                            <form method="POST" action="{{ route('cart.decrease.quantity', ['rowId' => $item->rowId]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="qty-control__reduce">-</div>
                                            </form>

                                            <form method="POST" action="{{ route('cart.increase.quantity', ['rowId'=>$item->rowId]) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="qty-control__increase">+</div>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__subtotal">₽ {{ $item->subTotal() }}</span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('cart.remove', ['rowId'=>$item->rowId]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" class="remove-cart">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                    <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                </svg>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="cart-table-footer">

{{--                        @if(!Session::has('coupon'))--}}
{{--                            <form method="POST" action="{{ route('cart.apply.coupon') }}" class="position-relative bg-body">--}}
{{--                                @csrf--}}
{{--                                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code" value="">--}}
{{--                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="APPLY COUPON">--}}
{{--                            </form>--}}
{{--                        @else--}}
{{--                            <form method="POST" action="{{ route('cart.remove.coupon') }}" class="position-relative bg-body">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code" value="@if(Session::has('coupon')) {{ Session::get('coupon')['code'] }} Applied! @endif">--}}
{{--                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit" value="REMOVE COUPON">--}}
{{--                            </form>--}}
{{--                        @endif--}}
                        <form method="POST" action="{{ route('cart.clear') }}" class="position-relative bg-body">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-light" type="submit">Очистить корзину</button>
                        </form>
                    </div>
                <div>
                    @if(Session::has('success'))
                        <p class="text-success">{{ Session::get('success') }}</p>
                    @elseif(Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
                </div>
                    <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>Общая сумма</h3>
                            @if(Session::has('discounts'))
                                <table class="cart-totals">
                                    <tbody>
                                    <tr>
                                        <th>Итог</th>
                                        <td>₽ {{ Cart::instance('cart')->subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Перевозка {{ Session::get('coupon')['code'] }}</th>
                                        <td>₽ {{ Session::get('discounts')['discount'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Subtotal After Discount</th>
                                        <td>₽ {{ Session::get('discounts')['subtotal'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode2" value="paypal">
                                                <label class="form-check-label" for="mode2">
                                                    Доставка
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode3" value="cod">
                                                <label class="form-check-label" for="mode3">
                                                    Самовывоз
                                                </label>
                                            </div>


                                        </td>
                                    </tr>
                                    <tr>
                                        <th>VAT</th>
                                        <td>₽ {{ Session::get('discounts')['tax'] }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>₽ {{ Session::get('discounts')['total'] }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            @else
                                <table class="cart-totals">
                                    <tbody>
                                    <tr>
                                        <th>Итог</th>
                                        <td>₽ {{ Cart::instance('cart')->subtotal() }}</td>
                                    </tr>
                                    <tr>
                                        <th>Перевозка</th>
                                        <td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode2" value="paypal">
                                                <label class="form-check-label" for="mode2">
                                                    Доставка
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode3" value="cod">
                                                <label class="form-check-label" for="mode3">
                                                    Самовывоз
                                                </label>
                                            </div>


                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <a href="{{ route('checkout') }}" class="btn btn-primary btn-checkout">Продолжить</a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                    <div class="row">
                        <div class="col-md-12 text-center pt-5 bp-5">
                            <p> В вашей корзине ничего не найдено </p>
                            <a href="{{ route('shop.index') }}" class="btn btn-info">Купить сейчас</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </main>
@endsection

@push('scripts')
    <script>
        $(function() {
            $(".qty-control__increase").on("click", function(){
                $(this).closest('form').submit();
            });

            $(".qty-control__reduce").on("click", function(){
                $(this).closest('form').submit();
            });

            $('.remove-cart').on("click", function(){
                $(this).closest('form').submit();
            })
        })
    </script>
@endpush
