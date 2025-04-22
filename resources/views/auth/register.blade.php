@extends('layouts.app')
@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore active" id="register-tab" data-bs-toggle="tab"
                       href="#tab-item-register" role="tab" aria-controls="tab-item-register" aria-selected="true">Регистрация</a>
                </li>
            </ul>
            <div class="tab-content pt-2" id="login_register_tab_content">
                <div class="tab-pane fade show active" id="tab-item-register" role="tabpanel" aria-labelledby="register-tab">
                    <div class="register-form">
                        <form method="POST" action="{{ route('register') }}" name="register-form" class="needs-validation" novalidate="">
                            @csrf
                            <div class="form-floating mb-3">
                                <input class="form-control form-control_gray @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="" autocomplete="name" autofocus="">
                                <label for="name">Имя</label>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Введите корректное имя</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="pb-3"></div>
                            <div class="form-floating mb-3">
                                <input id="email" type="email" class="form-control form-control_gray @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required="" autocomplete="email">
                                <label for="email">Email *</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> Введите корректный mail или он уже существует</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input id="mobile"
                                       type="tel"
                                       class="form-control form-control_gray @error('mobile') is-invalid @enderror"
                                       name="mobile"
                                       value="{{ old('mobile', '7-___-___-__-__') }}"
                                       required
                                       autocomplete="tel"
                                       placeholder="7-___-___-__-__"
                                       data-phone-mask
                                       pattern="7-\d{3}-\d{3}-\d{2}-\d{2}"
                                       title="Формат: 7-XXX-XXX-XX-XX">
                                <label for="mobile">Мобильный телефон *</label>

                                @error('mobile')
                                <span class="invalid-feedback" role="alert">
        <strong>Введите корректный телефон</strong>
    </span>
                                @enderror
                            </div>


                            <div class="pb-3"></div>

                            <div class="form-floating mb-3">
                                <input id="password" type="password" class="form-control form-control_gray @error('password') is-invalid @enderror" name="password" required="" autocomplete="new-password">
                                <label for="password">Пароль *</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Пароли не совпадают</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input id="password-confirm" type="password" class="form-control form-control_gray" name="password_confirmation" required="" autocomplete="new-password">
                                <label for="password">Подтвердите пароль *</label>
                            </div>

                            <div class="d-flex align-items-center mb-3 pb-2">
                                <p class="m-0">Ваши персональные данные будут использоваться для поддержки вашего опыта использования этого веб-сайта.</p>
                            </div>

                            <button class="btn btn-primary w-100 text-uppercase" type="submit">Регистрация</button>

                            <div class="customer-option mt-4 text-center">
                                <span class="text-secondary">Уже есть аккаунт?</span>
                                <a href="{{ route('login') }}" class="btn-text js-show-register">Войти в аккаунт</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.7/jquery.inputmask.min.js"></script>
        <script>
            $(document).ready(function() {
                $('[data-phone-mask]').inputmask({
                    mask: '9-999-999-99-99',
                    placeholder: '_',
                    showMaskOnHover: false,
                    showMaskOnFocus: true,
                    onBeforePaste: function (pastedValue, opts) {
                        // Оставляем только цифры при вставке
                        var processedValue = pastedValue.replace(/\D/g, '');

                        // Удаляем первую 7 если она уже есть (чтобы не было дублирования)
                        if (processedValue.startsWith('7')) {
                            processedValue = processedValue.substring(1);
                        }

                        return '7-' + processedValue;
                    }
                });
            });
        </script>
    @endpush
@endsection
