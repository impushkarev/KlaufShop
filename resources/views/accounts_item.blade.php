@extends('layouts.app')

@push('title', 'Аккаунт "'.$item->name.'"')

@section('content')
<section class="account">
    <div class="container">
        <div class="col-5 slider" id="slider">
            <div class="slider_main_slide">
                <div class="slide_dt">
                    <p><b id="slider_cur_slide">1</b>/{{ $item->images->count() }}</p>
                </div>
                <img src="{{ asset('img/accounts/'.$item->id.'/'.$item->images[0]->image) }}" id="image_cur_slide" alt="">
            </div>
            <div class="slider_slides">
                <div class="container slides" id="slider_slides">
                    @foreach ($item->images as $image)
                        <img @if ($loop->first) class="active" @endif src="{{ asset('img/accounts/'.$item->id.'/'.$image->image) }}" alt="">
                    @endforeach
                </div>
            </div>
            <p class="help">
                Если у вас возникли проблемы с аккаунтом, <br> то обратитесь в службу <a href="https://vk.com/im?sel=-184196774">технической поддержки</a>
            </p>
        </div>
        <div class="col-7 account_i">
            <h1 class="account_name">
                Аккаунт "{{ $item->name }}"
            </h1>
            <p class="account_d col-8">
                {{ $item->description }}
            </p>
            <div class="account_dt">
                <div class="account_md account_dt_rang">
                    <div class="dt_r">{{ number_format($item->rang, 0, '', ' ') }} <span class="trophy"><i class="fas fa-trophy"></i></span></div>
                    <div class="dt_rd">{{ $item->desc_rang }}</div>
                </div>
                <div class="account_md account_dt_lvl">
                    {{ $item->lvl }}
                </div>
                <div class="account_md account_dt_money">
                    @if ($item->game == 'clash-of-clans')
                        <p class="gem"><span class="ic"><i class="fas fa-gem"></i></span> {{ number_format($item->dres, 0, '', ' ') }}</p>
                        <p class="coin"><span class="ic"><i class="fas fa-circle"></i></span> {{ number_format($item->mres, 0, '', ' ') }}</p>
                        <p class="liquid"><span class="ic"><i class="fas fa-tint"></i></span> {{ number_format($item->ares, 0, '', ' ') }}</p>
                    @elseif ($item->game == 'clash-royal')
                        <p class="gem"><span class="ic"><i class="fas fa-gem"></i></span> {{ number_format($item->dres, 0, '', ' ') }}</p>
                        <p class="coin"><span class="ic"><i class="fas fa-circle"></i></span> {{ number_format($item->mres, 0, '', ' ') }}</p>
                        <p class="liquid"><span class="ic"><i class="fas fa-tint"></i></span> {{ number_format($item->ares, 0, '', ' ') }}</p>
                    @else
                        <p class="gem"><span class="ic"><i class="fas fa-gem"></i></span> {{ number_format($item->dres, 0, '', ' ') }}</p>
                        <p class="liquid"><span class="ic"><i class="fas fa-star"></i></span> {{ number_format($item->mres, 0, '', ' ') }}</p>
                        <p class="coin"><span class="ic"><i class="fas fa-circle"></i></span> {{ number_format($item->ares, 0, '', ' ') }}</p>
                    @endif
                </div>
                @if ($item->isLinked)
                    <div class="account_md account_dt_linked">Android, Supercell ID</div>
                @endif
            </div>
            <div class="account_price">
                <div class="container">
                    <p class="price">{{ number_format($item->price, 0, '', ' ') }} ₽</p>
                    <a id="bbutton" class="button_price"><p>Купить</p></a>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    
                    $("#bbutton").click(function() {
                        $("#alert_form").toggle();
                    });
                    $("#cl").click(function() {
                        $("#alert_form").toggle();
                    })
                    
                });
            </script>
        </div>
    </div>
    <div class="bg" style="transform: scale(-1, 1)">
        <img src="{{ asset('img/clashofclansbg.png') }}" alt="" style="margin-top: -150px">
    </div>
</section>
<div class="alert_bg" id="alert_form" style="display: none">
    <div class="alert_form">
        <form action="{{ route('accounts_i_b', [$item->game, $item->id]) }}" method="POST">
            @csrf 
            @method('POST')
            <h2>Вы уверены что хотите приобрести</h2>
            <p>Аккаунт <b>«{{ $item->name }}»</b></p>
            <div class="container">
                <button class="button">Да</button>
                <div class="close button" id="cl">Отказаться</div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#slider_slides img").click(function() {
            $("#slider_slides .active")[0].classList.remove('active');
            this.classList.add('active');
            $("#slider_cur_slide").html($(this).index() + 1);
            $("#image_cur_slide").attr("src", $(this).attr("src"));
        })
    })
</script>
@endsection