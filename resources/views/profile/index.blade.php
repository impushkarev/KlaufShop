@extends('layouts.app')

@push('title', 'Профиль')

@section('content')
<section class="history">
    <div class="container">
        <div class="section_dt col-12">
            <h1 class="section_title">
                Мои покупки
            </h1>
        </div>
    </div>
    <div class="history_list">
        @if ($items->count() != 0)
            @foreach($items as $item)
                <div class="h_item ">
                    <div class="container">
                        <div class="col-3 item_logo">
                            @if ($item->getTable() == 'accounts')
                                <img src="{{ asset('img/'.$item->game.'/'.$item->game.'-logo.png') }}" alt="">
                            @else 
                                <img src="{{ asset('img/cases/'.$item->getCase->id.'/'.$item->getCase->image) }}" alt="">
                            @endif
                        </div>
                        <div class="col-5 item_dt">
                            <h2 class="item_title">
                                @if ($item->getTable() == 'accounts')                        
                                    Аккаунт "{{ $item->name }}"
                                @else 
                                    Кейс "{{ $item->getCase->name }}"
                                @endif
                            </h2>
                            <p>
                                @if ($item->getTable() == 'accounts')                        
                                    Аккаунт {{ str_replace('-', ' ', $item->game) }}
                                @else 
                                    {{ $item->getPrize->name }}
                                @endif
                            </p>
                        </div>
                        <div class="col-4 item_data">
                            <div class="container">
                                @if ($item->getTable() == 'accounts')   
                                    <input class="item_input" type="text" value="{{ $item->login }}" disabled>
                                    <input class="item_input" type="text" value="{{ $item->password }}" disabled>
                                @elseif ($item->getPrize->type == 'accounts')
                                    <input class="item_input" type="text" value="{{ explode(';', $item->data)[0] }}" disabled>
                                    <input class="item_input" type="text" value="{{ explode(';', $item->data)[1] }}" disabled>
                                @else
                                    <input class="item_input input_physical" type="text" value="{{ $item->data }}" disabled>
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
@endsection