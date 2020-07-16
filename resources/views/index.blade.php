@extends('layouts.app')

@push('title', 'Главная страница')

@section('content')
<section class="games">
    <div class="container">
        <div class="section_dt col-12">
            <h1 class="section_title">
                Выбери игру на свой вкус!
            </h1>
            <p class="section_description">
                Clash of clans, Brawl stars или же Clash royal? Решать тебе!
            </p>
        </div>
        <div class="section_main">
            <div class="card_game" >
                <div class="container">
                    <div class="game_thumb col-5">
                        <img src="{{ asset('img/clash-of-clans/clash-of-clans.png') }}" alt="">
                    </div>
                    <div class="game_dt col-6">
                        <h1 class="game_title">Clash of clans</h1>
                        <p>Clash of Clans - многопользовательская, тактическая, онлайн стратегия, завоевавшая миллионы поклонников по всему миру. До недавнего времени, доступная только на гаджетах, под управлением iOS и Android.</p>
                        <a href="{{ route('accounts_g', ['clash-of-clans']) }}" class="gbutton">
                            <p>Выбрать</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_game">
                <div class="container">
                    <div class="game_thumb col-5">
                        <img src="{{ asset('img/clash-royal/clash-royal.png') }}" alt="">
                    </div>
                    <div class="game_dt col-6">
                        <h1 class="game_title">Clash royale</h1>
                        <p>Соберите и улучшите десятки карт с войсками, заклинаниями и оборонительными сооружениями Clash of Clans, которые уже полюбились вам, а также новинками Royale: принцами, рыцарями, маленькими драконами и многими другими. Ведите семью Clash Royale к победе!</p>
                        <a href="{{ route('accounts_g', ['clash-royal']) }}" class="gbutton">
                            <p>Выбрать</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_game">
                <div class="container">
                    <div class="game_thumb col-5">
                        <img src="{{ asset('img/brawl-stars/brawl-stars.png') }}" alt="">
                    </div>
                    <div class="game_dt col-6">
                        <h1 class="game_title">Brawl stars</h1>
                        <p>Сражайтесь соло или c друзьями в разнообразных игровых режимах длительностью до трех минут. Открывайте и улучшайте десятки бойцов c мощными суперспособностями. Покупайте и собирайте уникальные скины, чтобы выделяться в игре и эффектно выглядеть на арене.</p>
                        <a href="{{ route('accounts_g', ['brawl-stars']) }}" class="gbutton">
                            <p>Выбрать</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card_game" hidden>
                <div class="container">
                    <div class="game_thumb col-5">
                        <img src="{{ asset('img/standoff.png') }}" alt="">
                    </div>
                    <div class="game_dt col-6">
                        <h1 class="game_title">Standoff 2</h1>
                        <p>Легендарный "Standoff" возвращается в виде динамичного экшн-шутера от первого лица! Вас ждут новые карты, новые виды вооружения, новые режимы, в которых команды террористов и отряды сил спецназначения сойдутся в битве не на жизнь, а насмерть.</p>
                        <a href="" class="gbutton">
                            <p>Выбрать</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bg">
        <img src="{{ asset('img/clashofclansbg.png') }}" alt="">
        <img src="{{ asset('img/clashroyalbg.png') }}" alt="">
        <img src="{{ asset('img/brawlstarsbg.png') }}" alt="" hidden>
    </div>
</section>
@endsection