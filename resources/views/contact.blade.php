@extends('layouts.app')
@section('content')
    <style>
        .text-danger{
            color: #e72010 !important;
        }

        /* Стили для контактных карточек */
        .contact-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 50px;
        }

        .contact-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
            text-align: center;
            border-top: 4px solid #000000;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            font-size: 1.5rem;
            color: #000000;
            margin-bottom: 15px;
        }

        .contact-card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .contact-info {
            font-size: 1rem;
            margin-bottom: 15px;
            color: #555;
        }

        .contact-link {
            display: inline-block;
            padding: 8px 20px;
            background: #000000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }

        .contact-link:hover {
            background: #3a56d4;
            color: white;
        }

        @media (max-width: 768px) {
            .contact-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="contact-us container">
            <div class="mw-930">
                <h2 class="page-title">Связь с нами</h2>
            </div>
        </section>

        <hr class="mt-2 text-secondary " />
        <div class="mb-4 pb-4"></div>

        <section class="contact-us container">
            <div class="mw-930">
                <!-- Контактные карточки -->
                <div class="contact-cards">
                    <!-- Адрес -->


                    <!-- Телефон -->
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fas fa-phone-alt"></i>
                        </div>
                        <h3>Телефон</h3>
                        <div class="contact-info">
                            +7 (4742) 71-45-33
                            <br>
                            Пн-Пт: 8:00 - 17:00
                        </div>
                        <a href="tel:+79005953439" class="contact-link">
                            <i class="fas fa-phone"></i> Позвонить
                        </a>
                    </div>

                    <!-- Telegram -->
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fab fa-telegram"></i>
                        </div>
                        <h3>Telegram</h3>
                        <div class="contact-info">
                            Напишите нам<br>
                            Быстрый ответ
                        </div>
                        <a href="https://t.me/Plitkalip" class="contact-link" target="_blank">
                            <i class="fab fa-telegram"></i> Написать
                        </a>
                    </div>

                    <!-- WhatsApp -->
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="fab fa-whatsapp"></i>
                        </div>
                        <h3>WhatsApp</h3>
                        <div class="contact-info">
                            Чат поддержки<br>
                            Пн-Пт: 8:00 - 17:00


                        </div>
                        <a href="https://wa.me/79005953439" class="contact-link" target="_blank">
                            <i class="fab fa-whatsapp"></i> Чат
                        </a>
                    </div>
                </div>

                <!-- Форма -->
                <div class="contact-us__form">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <h2>Ваше сообщение отправлено!</h2>
                        </div>
                    @endif
                    <form action="{{ route('contact.store') }}" name="contact-us-form" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        <h3 class="mb-5">Введите данные и мы с вами свяжемся!</h3>
                        <div class="form-floating my-4">
                            <input type="text" class="form-control" name="name" placeholder="Name *" value="{{ old('name') }}" required="">
                            <label for="contact_us_name">Имя *</label>
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-floating my-4">
                            <input type="text" class="form-control" name="phone" placeholder="Phone *" value="{{ old('phone') }}" required="">
                            <label for="contact_us_name">Телефон *</label>
                            @error('phone')<span class="text-danger">Неправильный формат номера</span>@enderror
                        </div>
                        <div class="form-floating my-4">
                            <input type="email" class="form-control" name="email" placeholder="Email address *" value="{{ old('email') }}" required="">
                            <label for="contact_us_name">Email *</label>
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="my-4">
                            <textarea class="form-control form-control_gray" name="comment" placeholder="Что вас интересует?" cols="30" rows="8" required="">{{ old('comment') }}</textarea>
                            @error('comment')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="my-4">
                            <button type="submit" class="btn btn-primary">Отправить</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>

@endsection

@push('scripts')
    <!-- Добавляем Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
