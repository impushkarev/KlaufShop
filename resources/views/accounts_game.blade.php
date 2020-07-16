@extends('layouts.app')

@push('title', 'Аккаунты '.$name)

@section('content')
<section class="title_page">
    <div class="section_dt col-12">
        <h1 class="section_title">
            Аккаунты {{ $name }}
        </h1>
        <p class="section_description">
            «Ломаем деревья используя молот»
        </p>
    </div>
</section>
<section class="wd game game_coc">
    <div class="container">
        <div class="section_logo col-10">
            <div class="container">
                <hr>
                <img src="{{ asset('img/'.$game.'/'.$game.'-logo.png') }}" alt="">
                <hr>
            </div>
        </div>
        <div class="section_main">
            <div class="container">
                @each('layouts.account_card', $items, 'item')
            </div>
        </div>
    </div>
</section>
@endsection