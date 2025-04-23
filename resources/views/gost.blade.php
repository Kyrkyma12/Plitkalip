@extends('layouts.app')

@section('content')
    <style>
        .certificates-page {
            padding: 60px 0;
            background-color: #f5f5f5;
        }

        .page-title {
            text-align: center;
            margin-bottom: 30px;
            color: #2c3e50;
            font-size: 2.2rem;
        }

        .intro {
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.2rem;
            color: #555;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }

        .certificates-container {
            display: flex;
            flex-direction: column;
            gap: 30px;
            margin-bottom: 50px;
        }

        .certificate-card {
            display: flex;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .certificate-image {
            flex: 1;
            min-height: 250px;
        }

        .certificate-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .certificate-info {
            flex: 1;
            padding: 30px;
            display: flex;
            flex-direction: column;
        }

        .certificate-info h3 {
            margin-top: 0;
            color: #2c3e50;
            font-size: 1.5rem;
        }

        .certificate-features {
            flex-grow: 1;
            padding-left: 20px;
            color: #666;
        }

        .certificate-features li {
            margin-bottom: 8px;
        }

        .price {
            font-size: 1.5rem;
            font-weight: bold;
            color: #e74c3c;
            margin: 15px 0;
        }

        .btn-primary {
            background: #3498db;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #2980b9;
        }

        .certificate-terms {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 40px;
        }

        .certificate-terms h3 {
            margin-top: 0;
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .terms-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .term-item {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .term-item i {
            font-size: 1.5rem;
            color: #3498db;
        }

        .certificate-faq {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .certificate-faq h3 {
            margin-top: 0;
            color: #2c3e50;
        }

        .faq-item {
            margin-bottom: 15px;
        }

        .faq-question {
            font-weight: bold;
            cursor: pointer;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }

        .faq-answer {
            padding: 15px;
            display: none;
        }

        @media (max-width: 768px) {
            .certificate-card {
                flex-direction: column;
            }

            .certificate-image {
                height: 200px;
            }

            .terms-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="certificates-page">
        <div class="container">
            <h1 class="page-title" data-aos="flip-up">Сертификаты на тротуарную плитку</h1>

            <div class="intro" data-aos="fade-up">
                <p>Дарите качество и долговечность! Наши сертификаты - это идеальный подарок для тех, кто ценит надежность и красоту двора.</p>
            </div>

            <div class="certificates-container">
                <!-- Сертификаты здесь -->
            </div>

            <!-- Условия и FAQ здесь -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
            integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out'
        });

        // Раскрытие FAQ
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const answer = question.nextElementSibling;
                answer.style.display = answer.style.display === 'block' ? 'none' : 'block';
            });
        });
    </script>
@endpush
