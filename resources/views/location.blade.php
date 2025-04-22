@extends('layouts.app')
@section('content')
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
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"
            integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="./js/main.js"></script>
@endpush
