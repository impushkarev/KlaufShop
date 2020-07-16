@extends('layouts.app')

@push('title', 'Каталог аккаунтов')

@section('content')
<section class="title_page">
    <div class="section_dt col-12">
        <h1 class="section_title">
            Выберите нужный вам аккаунт
        </h1>
        <p class="section_description">
            Все же просто, не так ли?
        </p>
    </div>
</section>

@if ($items_coc->count() > 0)
    <section class="wd game game_coc">
        <div class="container">
            <div class="section_logo col-10">
                <div class="container">
                    <hr>
                    <img src="{{ asset('img/clash-of-clans/clash-of-clans-logo.png') }}" alt="">
                    <hr>
                </div>
            </div>
            <div class="section_main">
                <div class="container">        
                    @each('layouts.account_card', $items_coc, 'item')
                </div>
                <a href="{{ route('accounts_g', ['clash-of-clans']) }}" class="more">Больше аккаунтов</a>
            </div>
        </div>
    </section>
@endif

@if ($items_cr->count() > 0)
    <section class="wd game game_cr">
        <div class="container">
            <div class="section_logo col-10">
                <div class="container">
                    <hr>
                    <img src="{{ asset('img/clash-royal/clash-royal-logo.png') }}" alt="">
                    <hr>
                </div>
            </div>
            <div class="section_main">
                <div class="container">        
                    @each('layouts.account_card', $items_cr, 'item')
                </div>
                <a href="{{ route('accounts_g', ['clash-royal']) }}" class="more">Больше аккаунтов</a>
            </div>
        </div>
    </section>
@endif

@if ($items_bs->count() > 0)
    <section class="wd game game_bs">
        <div class="container">
            <div class="section_logo col-10">
                <div class="container">
                    <hr>
                    <img src="{{ asset('img/brawl-stars/brawl-stars-logo.png') }}" alt="">
                    <hr>
                </div>
            </div>
            <div class="section_main">
                <div class="container">        
                    @each('layouts.account_card', $items_bs, 'item')
                </div>
                <a href="{{ route('accounts_g', ['brawl-stars']) }}" class="more">Больше аккаунтов</a>
            </div>
        </div>
    </section>
@endif

<section class="wd game game_so" hidden>
    <div class="container">
        <div class="section_logo col-10">
            <div class="container">
                <hr>
                <img src="{{ asset('img/standofflogo.png') }}" alt="">
                <hr>
            </div>
        </div>
    </div>
</section>
@endsection