@extends('layouts.app')

@push('title', 'История баланса')

@section('content')
<section class="payment">
    <div class="container">
        <div class="section_dt col-12">
            <h1 class="section_title">
                Пополнение баланса
            </h1>
        </div>
        <div class="payment_form col-8">
            <form action="http://www.free-kassa.ru/merchant/cash.php" method="GET" class="payment">
                <div class="container">
                    <div class="form_container col-12" hidden>
                        <input type="text" name="m" value="179178" class="payment_input">
                    </div>
                    <div class="form_container col-12" hidden>
                        <input type="text" name="s" value="" class="payment_input">
                    </div>
                    <div class="form_container col-12" hidden>
                        <input type="text" name="o" value="" class="payment_input">
                    </div>
                    <div class="form_section col-6">
                        <input type="number" step="1" name="oa" class="payment_input" placeholder="Введите сумму">
                    </div>
                    <div class="form_section col-6">
                        <button class="payment_button">Пополнить</button>
                    </div>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    $(".payment .payment_button").click(function(e) {
                        e.preventDefault();
                        $.ajax({
                            url: "{{ route('pay_c') }}",
                            type: "POST",
                            data: {_token: '<?php echo csrf_token() ?>', _method: 'POST', amount: $(".payment input[name='oa']").val()},
                            success: function(data) {
                                $(".payment input[name='s']").val(data[0]);
                                $(".payment input[name='o']").val(data[1]);
                                $(".payment input[name='oa']").val(Math.abs(Math.floor($(".payment input[name='oa']").val())));
                                $(".payment").submit();
                            },
                        });
                    });
                });
            </script>
        </div>    
    </div>
</section>
<section class="payment_history">
    <div class="container">
        <div class="section_dt col-12">
            <h1 class="section_title">
                История баланса
            </h1>
        </div>
        <div class="col-12 payments_list">
            @if ($items->count() != 0)
                @foreach ($items as $item)
                    <div class="h_item ">
                        <div class="container">
                            <div class="col-3 item_logo">
                                @if ($item->getTable() == 'accounts')  
                                    <img src="{{ asset('img/'.$item->game.'/'.$item->game.'-logo.png') }}" alt="">
                                @elseif ($item->getTable() == 'payment_histories')
                                    <img src="{{ asset('img/gem.png') }}" alt="">
                                @else
                                    <img src="{{ asset('img/cases/'.$item->getCase->id.'/'.$item->getCase->image) }}" alt="">
                                @endif
                            </div>
                            <div class="col-5 item_dt">
                                <h2 class="item_title">
                                    @if ($item->getTable() == 'accounts')                        
                                        Аккаунт "{{ $item->name }}"
                                    @elseif ($item->getTable() == 'payment_histories')
                                        Пополнение счета
                                    @else 
                                        Кейс "{{ $item->getCase->name }}"
                                    @endif
                                </h2>
                                <p>
                                    @if ($item->getTable() == 'accounts')                        
                                        Аккаунт {{ str_replace('-', ' ', $item->game) }}
                                    @elseif ($item->getTable() == 'payment_histories')

                                    @else 
                                        {{ $item->getPrize->name }}
                                    @endif
                                </p>
                            </div>
                            <div class="col-4 item_data">
                                <div class="container">
                                    @if ($item->getCase != null && $item->getCase->name == 'Бесплатный')
                                        <p class="item_money">{{ number_format($item->price, 0, '', ' ') }} ₽</p>    
                                    @elseif ($item->getTable() == 'accounts')  
                                        <p class="item_money r">- {{ number_format($item->price, 0, '', ' ') }} ₽</p>
                                    @elseif ($item->getTable() == 'payment_histories')
                                        <p class="item_money g">+ {{ number_format($item->amount, 0, '', ' ') }} ₽</p>
                                    @else
                                        <p class="item_money r">- {{ number_format($item->getCase->price, 0, '', ' ') }} ₽</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 item_status">
                                <div class="container">
                                    <p>Сатус: <span class="g">Приобретено</span></p>
                                    <p class="date">{{ date("d.m.Y G:i", strtotime($item->updated_at)) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="not">Вы еще ничего не приобретали</p>
            @endif
        </div>
    </div>
</section>
@endsection