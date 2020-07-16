@extends('layouts.app')

@push('title', 'Кейс "'.$case->name.'"')
@push('meta', "<meta name='csrf-token' content='".csrf_token()."'>")

@section('content')
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
<section class="case">
    <div class="container">
        <div class="section_dt col-12">
            <h1 class="section_title">
                Кейс {{ $case->name }}
            </h1>
        </div>
        <div class="section_main col-12">
            <div class="case_menu">
                <div class="container">
                    <div class="case_thumb col-3">
                        <img src="{{ asset('img/cases/'.$case->id.'/'.$case->image) }}" alt="">
                    </div>
                    <div class="case_roulete col-6">
                        <div class="roulete">
                            <div class="roulete_arrows">
                                <img src="{{ asset('img/cases/arrows.png') }}" alt="">
                                <img src="{{ asset('img/cases/arrows.png') }}" alt="" style="transform: rotate(180deg)">
                            </div>
                            <ul class="roulete_list">
                                <div class="rs" id="roulete_list">
                                    @Auth
                                        @if ($isAvail)
                                            @if ($isEnoughM)
                                                @if (($case->name == 'Бесплатный' && $isSubscribed) || $case->name != 'Бесплатный')
                                                    @if ($isTimeout)
                                                        <li class="roulete_start roulete_item" style="margin: 65px 0;">
                                                            Сегодня вы уже открывали, приходите завтра
                                                        </li>
                                                    @else
                                                        @if ($case->name == 'Бесплатный' && !$isLiked)
                                                            <a href="https://vk.com/wall-184196774_{{$post_id}}" target="_blank" style="color: inherit; text-decoration: none">
                                                                <li class="roulete_start roulete_item">
                                                                    Поставь лайк
                                                                </li>
                                                            </a>
                                                        @else
                                                            <li class="roulete_start roulete_item" id="roulete_start_btn">
                                                                Открыть
                                                                @if ($case->name != 'Бесплатный')
                                                                    <p class="price">{{ number_format($case->price, 0, '', ' ') }} ₽</p>
                                                                @endif
                                                            </li>
                                                        @endif
                                                    @endif
                                                @else
                                                    <a href="https://vk.com/ksbce" target="_blank" style="color: inherit; text-decoration: none">
                                                        <li class="roulete_start roulete_item">
                                                            Подпишись на группу
                                                        </li>
                                                    </a>
                                                @endif
                                            @else
                                                <li class="roulete_start roulete_item">Не достаточно средств</li>
                                            @endif
                                        @else 
                                            <li class="roulete_start roulete_item">В данный момент кейс недоступен</li>
                                        @endif
                                    @else
                                        <li class="roulete_start roulete_item">Войдите что-бы открыть кейс</li>
                                    @endauth
                                </div>
                            </ul>
                        </div>
                        <script>
                            $(document).ready(function() {
                                var p = [];
                                for (let index = 0; index < $("#wins_list .win_item").length; index++) {
                                    p[index] = $("#wins_list .win_item")[index].dataset.name;
                                }
                                var money;
                                var isFree = false;
                                $("#roulete_start_btn").click(function() {
                                    if (!isFree) {
                                        $.ajax({
                                            url: "{{ url()->current().'/s' }}",
                                            type: "POST",
                                            data: {_method: 'POST', _token: $('meta[name="csrf-token"]').attr('content') },
                                            success: function(data) {
                                                if (data !== null) {
                                                    $('#account_money').html(data[1]+' ₽');
                                                    money = data[3];
                                                    roulete_create_list(data);
                                                    if (data[4] == 'Бесплатный') {
                                                        setTimeout(() => {
                                                            $("#roulete_start_btn").css('margin', '65px 0');
                                                            $("#roulete_start_btn").html('Сегодня вы уже открывали, приходите завтра');
                                                            isFree = true;
                                                        }, 18000);
                                                    }
                                                }
                                            },
                                        });
                                    }
                                });

                                function roulete_create_list(data) {
                                    for (let index = 0; index < 99; index++) {
                                        var r = Math.floor(Math.random() * p.length);
                                        var ri = $('<li>', {
                                            class: "roulete_item",
                                            html: p[r],
                                        });
                                        $("#roulete_list").append(ri);
                                    }

                                    ri = $('<li>', {
                                        class: "roulete_item",
                                        html: data[0],
                                    });
                                    ri.insertBefore($("#roulete_list")[0].lastChild);

                                    roulete_spin();

                                    setTimeout(() => {
                                        $("#roulete_list li")[$("#roulete_list li").length - 2].classList.add('win');
                                        $('#account_money').html(money+' ₽');

                                        setTimeout(() => {
                                            $("#roulete_list").css({'transition-duration': '1s', 'transform': 'translateY(0)'});

                                            setTimeout(() => {
                                                $("#roulete_list").css('transition-duration', '15s');
                                                $("#roulete_list li:not(.roulete_start)").remove();
                                            }, 1000);

                                        }, 3000);

                                    }, 15000);
                                }

                                function roulete_spin() {
                                    let heightW = 0;
                                    $('.roulete_list li:nth-child(-n + 98)').map(function() {
                                        heightW = heightW + $(this).outerHeight(true);
                                        heightW = heightW - 10;
                                    });
                                    $("#roulete_list").css('transform', 'translateY(-' + heightW + 'px)');
                                }
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="wins_list">
    <div class="container" id="wins_list">
        @foreach($case->prizes as $prize)
            <div class="col-4 win_item" data-name="{{ $prize->name }}">
                <p>{{ $prize->name }}</p>
            </div>
        @endforeach
    </div>
</section>
@endsection