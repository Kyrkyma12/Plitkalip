@extends('layouts.app')
@section('content')
    <div class="vacancy-page">
        <!-- Hero Section -->
        <div class="vacancy-hero">
            <div class="container">
                <div class="hero-content">
                    <h1>Работа на производстве</h1>
                    <p class="lead">Станьте частью нашей команды! Мы предлагаем стабильную работу, достойную зарплату и все необходимые условия.</p>
                    <div class="hero-buttons">
                        <a href="#vacancies" class="btn btn-primary btn-lg">Смотреть вакансии</a>
                        <a href="#benefits" class="btn btn-outline-light btn-lg">Наши преимущества</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Benefits Section -->
        <section id="benefits" class="section-benefits">
            <div class="container">
                <h2 class="section-title">Почему стоит работать у нас</h2>
                <div class="benefits-grid">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Конкурентная зарплата</h3>
                        <p>Своевременные выплаты, премии за переработку, ежегодная индексация</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-medal"></i>
                        </div>
                        <h3>Карьерный рост</h3>
                        <p>Возможность обучения и повышения квалификации</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3>График работы</h3>
                        <p>Гибкий график, возможность сверхурочной работы</p>
                    </div>
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <h3>Хороший коллектив</h3>
                        <p>Коллектив в котором все рады и готовы дриуг другу помочь</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vacancies Section -->
        <section id="vacancies" class="section-vacancies">
            <div class="container">
                <h2 class="section-title">Актуальные вакансии</h2>

                <!-- Loader Vacancy -->
                <div class="vacancy-card">
                    <div class="vacancy-header">
                        <h3>Грузчик</h3>
                        <span class="salary">от 45 000 ₽</span>
                    </div>
                    <div class="vacancy-body">
                        <div class="vacancy-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Склад готовой продукции</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <span>Сменный график (5/2)</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-briefcase"></i>
                                <span>Опыт не требуется</span>
                            </div>
                        </div>
                        <div class="vacancy-description">
                            <h4>Обязанности:</h4>
                            <ul>
                                <li>Погрузка/разгрузка строительных материалов</li>
                                <li>Укладка продукции на паллеты</li>
                                <li>Участие в инвентаризации</li>
                                <li>Поддержание порядка на складе</li>
                            </ul>
                            <h4>Требования:</h4>
                            <ul>
                                <li>Физическая выносливость</li>
                                <li>Ответственность</li>
                                <li>Трудолюбие</li>
                            </ul>
                            <h4>Условия:</h4>
                            <ul>
                                <li>Официальное трудоустройство</li>
                                <li>Спецодежда за счет компании</li>
                                <li>Возможность перехода на более квалифицированные позиции</li>
                            </ul>
                        </div>
                    </div>
                    <div class="vacancy-footer">
                        <button class="btn-apply" data-vacancy="Грузчик">Откликнуться</button>
                    </div>
                </div>

                <!-- Concrete Worker Vacancy -->
                <div class="vacancy-card">
                    <div class="vacancy-header">
                        <h3>Формовщик бетонных изделий</h3>
                        <span class="salary">от 55 000 ₽</span>
                    </div>
                    <div class="vacancy-body">
                        <div class="vacancy-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Основной цех</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <span>Сменный график (2/2)</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-briefcase"></i>
                                <span>Опыт приветствуется</span>
                            </div>
                        </div>
                        <div class="vacancy-description">
                            <h4>Обязанности:</h4>
                            <ul>
                                <li>Формовка бетонных изделий по технологическим картам</li>
                                <li>Контроль качества продукции</li>
                                <li>Подготовка форм и оборудования</li>
                                <li>Ведение документации</li>
                            </ul>
                            <h4>Требования:</h4>
                            <ul>
                                <li>Опыт работы на производстве (желательно)</li>
                                <li>Внимательность к деталям</li>
                                <li>Готовность к физическому труду</li>
                            </ul>
                            <h4>Условия:</h4>
                            <ul>
                                <li>Обучение на рабочем месте</li>
                                <li>Доплаты за вредные условия труда</li>
                                <li>Карьерный рост до мастера смены</li>
                            </ul>
                        </div>
                    </div>
                    <div class="vacancy-footer">
                        <button class="btn-apply" data-vacancy="Формовщик бетонных изделий">Откликнуться</button>
                    </div>
                </div>

                <!-- Forklift Driver Vacancy -->
                <div class="vacancy-card">
                    <div class="vacancy-header">
                        <h3>Водитель погрузчика (вилочный)</h3>
                        <span class="salary">от 60 000 ₽</span>
                    </div>
                    <div class="vacancy-body">
                        <div class="vacancy-info">
                            <div class="info-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Склад сырья и готовой продукции</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <span>Сменный график (2/2)</span>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-briefcase"></i>
                                <span>Опыт от 1 года</span>
                            </div>
                        </div>
                        <div class="vacancy-description">
                            <h4>Обязанности:</h4>
                            <ul>
                                <li>Погрузочно-разгрузочные работы</li>
                                <li>Перемещение грузов по территории склада</li>
                                <li>Укладка продукции</li>
                                <li>Контроль технического состояния погрузчика</li>
                            </ul>
                            <h4>Требования:</h4>
                            <ul>
                                <li>Действующее удостоверение водителя погрузчика</li>
                                <li>Опыт работы на погрузчике от 1 года</li>
                                <li>Аккуратность при работе с грузами</li>
                            </ul>
                            <h4>Условия:</h4>
                            <ul>
                                <li>Современная техника (погрузчики Toyota, Still)</li>
                                <li>Доплата за квалификацию</li>
                                <li>Возможность работы сверхурочно</li>
                            </ul>
                        </div>
                    </div>

                    <div class="vacancy-footer">
                        <button class="btn-apply" data-vacancy="Водитель погрузчика (вилочный)">Откликнуться</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Application Form Modal -->
        <div class="modal fade" id="applicationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Отклик на вакансию: <span id="vacancyTitle"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('contact.store') }}" name="contact-us-form" class="needs-validation" novalidate="" method="POST">
                            @csrf
                            <h3 class="mb-5">Введите данные и мы с вами свяжемся!</h3>
                            <div class="form-floating my-4">
                                <input type="text" class="form-control" name="name" placeholder="Name *" value="{{ old('name') }}" required="">
                                <label for="contact_us_name">Имя *</label>
                                @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                            </div>
                            <div class="form-floating my-4">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                       placeholder="Phone *" value="{{ old('phone') }}" required>
                                <label for="contact_us_name">Телефон *</label>
                                @error('phone')
                                <span class="text-danger">Введите номер в формате: +7 (XXX) XXX-XX-XX</span>
                                @enderror
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
            </div>
        </div>

        <!-- Contacts Section -->
        <section class="section-contacts">
            <div class="container">
                <div class="contacts-wrapper">
                    <div class="contacts-info">
                        <h2>Контакты отдела кадров</h2>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <h4>Телефон</h4>
                                <a href="tel:71-45-33">71-45-33</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>Email</h4>
                                <a href="mailto:penobeton08@mail.ru">penobeton08@mail.ru</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>Адрес</h4>
                                <p>Полевая улица, 2, село Крутогорье, Липецкий муниципальный округ, 398526</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <h4>Часы работы</h4>
                                <p>Пн-Пт: 8:00 - 17:00</p>
                                <p>Cб: 8:00 - 12:00</p>
                            </div>
                        </div>
                    </div>
                    <div class="location">
                        <div class="container">
                            <h2 class="location-title" data-aos="flip-up">Где мы находимся</h2>
                            <p class="sub-title" data-aos="flip-up">Липецкая обл. (с. Крутогорье), ул. Полевая 2</p>
                            <script  data-aos="flip-up" type="text/javascript" charset="utf-8" async
                                     src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A6be40999ca496d8c1a872a36696f40016d08850335e4e8c740c4cc788fa228d5&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>

                        </div>
                    </div>
                    <hr class="mt-2 text-secondary " />
                    <div class="mb-4 pb-4"></div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
    <style>
        /* Base Styles */
        .vacancy-page {
            font-family: 'Roboto', sans-serif;
            color: #333;
            line-height: 1.6;
        }

        /* Hero Section */
        .vacancy-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1605152276897-4f618f831968?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero-content h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-content .lead {
            font-size: 1.5rem;
            margin-bottom: 30px;
        }

        .hero-buttons .btn {
            margin: 0 10px;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
        }

        /* Section Titles */
        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 60px;
            font-weight: 700;
            color: #2c3e50;
            position: relative;
        }

        .section-title:after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: #3498db;
            margin: 15px auto 0;
        }

        /* Benefits Section */
        .section-benefits {
            padding: 80px 0;
            background-color: #f9f9f9;
        }

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 50px;
        }

        .benefit-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }

        .benefit-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .benefit-icon {
            font-size: 2.5rem;
            color: #3498db;
            margin-bottom: 20px;
        }

        .benefit-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #2c3e50;
        }

        /* Vacancies Section */
        .section-vacancies {
            padding: 80px 0;
            background: white;
        }

        .vacancy-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
            background: white;
        }

        .vacancy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .vacancy-header {
            background: #3498db;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .vacancy-header h3 {
            margin: 0;
            font-size: 1.5rem;
        }

        .salary {
            font-size: 1.3rem;
            font-weight: 700;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 50px;
        }

        .vacancy-body {
            padding: 25px;
        }

        .vacancy-info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #7f8c8d;
        }

        .info-item i {
            color: #3498db;
        }

        .vacancy-description h4 {
            color: #2c3e50;
            margin: 20px 0 10px;
            font-size: 1.2rem;
        }

        .vacancy-description ul {
            padding-left: 20px;
            margin-bottom: 15px;
        }

        .vacancy-description li {
            margin-bottom: 8px;
        }

        .vacancy-footer {
            padding: 0 25px 25px;
            text-align: center;
        }

        .btn-apply {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-apply:hover {
            background: #2980b9;
        }

        /* Contacts Section */
        .section-contacts {
            padding: 80px 0;
            background: #f9f9f9;
        }

        .contacts-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
        }

        .contacts-info h2 {
            font-size: 2rem;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .contact-item {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            align-items: flex-start;
        }

        .contact-item i {
            font-size: 1.5rem;
            color: #3498db;
            margin-top: 5px;
        }

        .contact-item h4 {
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .contact-item a {
            color: #3498db;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-item a:hover {
            color: #2980b9;
            text-decoration: underline;
        }

        .contacts-map {
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .contacts-map iframe {
            width: 100%;
            height: 100%;
            border: none;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            border: none;
        }

        .modal-header {
            background: #3498db;
            color: white;
            border-bottom: none;
        }

        .modal-title {
            font-weight: 600;
        }

        .btn-close {
            filter: invert(1);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .contacts-wrapper {
                grid-template-columns: 1fr;
            }

            .contacts-map {
                height: 300px;
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.2rem;
            }

            .hero-content .lead {
                font-size: 1.2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .vacancy-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
@endpush

@push('scripts')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Добавляем библиотеку Inputmask -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
        $(document).ready(function() {
            // Применяем маску для телефона
            $('input[name="phone"]').inputmask({
                mask: '+7 (999) 999-99-99',
                placeholder: '_',
                showMaskOnHover: false,
                showMaskOnFocus: true,
                clearIncomplete: true
            });
        });
    </script>
    <!-- Добавляем Font Awesome для иконок -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Inputmask for phone input -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize phone mask
            $('#phone').inputmask('+7 (999) 999-99-99');

            // Handle apply buttons
            $('.btn-apply').click(function() {
                const vacancy = $(this).data('vacancy');
                $('#vacancyTitle').text(vacancy);
                $('#vacancyField').val(vacancy);
                $('#applicationModal').modal('show');
            });

            // Form submission
            $('#applicationForm').submit(function(e) {
                e.preventDefault();

                // Here you would typically make an AJAX request
                // For demo, we'll just show a success message
                $('#applicationModal').modal('hide');

                // Show success alert
                alert('Ваша заявка на вакансию "' + $('#vacancyField').val() + '" успешно отправлена!');

                // Reset form
                this.reset();
            });
        });

    </script>
@endpush
