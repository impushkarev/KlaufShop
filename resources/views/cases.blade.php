@extends('layouts.app')

@push('title', 'Кейсы')

@section('content')
<section class="title_page">
    <div class="section_dt col-12">
        <h1 class="section_title">
            Выберите нужный вам кейс
        </h1>
        <p class="section_description">
            Удача на вашей стороне
        </p>
    </div>
</section>
<section class="stats">
    <div class="container">
        <div class="col-4">
            <div class="stat">
                <div class="container">
                    <p>Открыто кейсов:</p>
                    <p class="count">{{ number_format($opened, 0, '', ' ') }}</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="stat">
                <div class="container">
                    <p>Открыто недавно:</p>
                    <p class="count">{{ number_format($lopened, 0, '', ' ') }}</p>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="stat">
                <div class="container">
                    <p>Онлайн:</p>
                    <p class="count">{{ number_format($online, 0, '', ' ') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="cases">
    <div class="section_main">
        <div class="container">
            @each('layouts.case_card', $cases_regular, 'case')
            <div class="col-3 case_card">
                <a>
                    <div class="case_thumb">
                        <img src="{{ asset('img/cases/dev.png') }}" alt="">
                    </div>
                    <div class="case_dt">
                        <div class="case_name">
                            <p>Кейс <b>В Разработке</b></p>
                        </div>
                        <div class="case_price"><p>Бесценно</p></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<section class="wd cases">
    <div class="container">
        <div class="section_logo col-10">
            <div class="container">
                <hr>
                <img src="{{ asset('img/ytlogo.png') }}" alt="">
                <hr>
            </div>
        </div>
        <div class="section_main">
            <div class="container">
                @each('layouts.case_card', $cases_youtube, 'case') 
            </div>
        </div>
    </div>
</section>
@endsection