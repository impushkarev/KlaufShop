@extends('layouts.app')

@push('title', 'О нас')

@section('content')
<section class="about">
    <div class="container">
        <div class="section_dt col-12">
            <h1 class="section_title">
                О нашем сервисе
            </h1>
        </div>
        <div class="section_stat">
            <div class="container">
                <div class="col-4">
                    <div class="stat_card">
                        <div class="container">
                            <img class="stat_card_icon" src="{{ asset('img/about/gem_icon.png') }}" alt="">
                            <div class="stat_card_desc">
                                <p class="stat_card_title">
                                    Потрачено:
                                </p>
                                <p class="stat_card_s">
                                    {{ number_format($payed, 0, '', ' ') }} ₽
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat_card">
                        <div class="container">
                            <img class="stat_card_icon" src="{{ asset('img/about/time_icon.png') }}">
                            <div class="stat_card_desc">
                                <p class="stat_card_title">
                                    Дней сайту:
                                </p>
                                <p class="stat_card_s">
                                    {{ $date }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat_card">
                        <div class="container">
                            <img class="stat_card_icon" src="{{ asset('img/about/user_icon.png') }}">
                            <div class="stat_card_desc">
                                <p class="stat_card_title">
                                    Пользователей:
                                </p>
                                <p class="stat_card_s">
                                    {{ number_format($users, 0, '', ' ') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat_card">
                        <div class="container">
                            <img class="stat_card_icon" src="{{ asset('img/about/cart_icon.png') }}">
                            <div class="stat_card_desc">
                                <p class="stat_card_title">
                                    Продано аккаунтов:
                                </p>
                                <p class="stat_card_s">
                                    {{ $as }} шт.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat_card stat_tr">
                        <div class="container">
                            <div class="stat_card_desc">
                                <p class="stat_card_title">
                                    <span class="c">Внимение!</span> Статистика сайта обновляется автоматически.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="stat_card">
                        <div class="container">
                            <img class="stat_card_icon" src="{{ asset('img/about/check_icon.png') }}">
                            <div class="stat_card_desc">
                                <p class="stat_card_title">
                                    Открыто кейсов:
                                </p>
                                <p class="stat_card_s">
                                    {{ $opened }} шт.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about_us">
    <div class="container">
        <div class="col-6 section_payments">
            <div class="section_dt col-12">
                <h1 class="section_title">
                    Мы принимаем к оплате
                </h1>
            </div>
            <div class="payments_list">
                <div class="payment_item">
                    <div class="container">
                        <p>1</p>
                        <img src="{{ asset('img/wm.png') }}" alt="">
                    </div>
                </div>
                <div class="payment_item">
                    <div class="container">
                        <p>2</p>
                        <img src="{{ asset('img/qiwi.png') }}" alt="">
                    </div>
                </div>
                <div class="payment_item">
                    <div class="container">
                        <p>3</p>
                        <img src="{{ asset('img/ya.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 section_cons">
            <div class="section_dt col-12">
                <h1 class="section_title">
                    Почему именно мы
                </h1>
            </div>
            <div class="cons_list">
                <p>1) <span class="c">«Быстро»</span> мы гарантируем моментальную доставку вашего товара.</p>
                <p>2) <span class="c">«Безопасно»</span> также наша команда гарантирут защищенно хранить и обрабатывать ваши данные, для это у нас есть все необходимое.</p>
                <p>3) <span class="c">«Уникальные»</span> стараемся соответсвовать всем вашим требованиям и желаниям.</p>
                <p>4) <span class="c">«Выгодно»</span> низкая цена на все предоставленные товары, дешевле только самому качать.</p>
                <p>5) <span class="c">«Уважаемые»</span> Мы дорожим своей репутацией! Для этого мы слушаем вас и даем обратную связть.</p>
            </div>
        </div>
    </div>
</section>
<section class="contacts">
    <div class="container">
        <div class="section_dt col-12">
            <h1 class="section_title">
                Связаться с нами
            </h1>
        </div>
        <div class="section_contacts col-12">
            <p>Email: <span class="c">support@klaufshop.ru</span></p>
            <p>Телефон: <span class="c">+7 (985)-451-59-38</span></p>
        </div>
    </div>
</section>
@endsection