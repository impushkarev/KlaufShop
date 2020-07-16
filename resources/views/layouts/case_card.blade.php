<div class="@if ($case->name == 'Бесплатный') col-6 @endif col-3 case_card">
    <a href="{{ route('cases_i', [$case]) }}">
        <div class="case_thumb">
            <img src="{{ asset('img/cases/'.$case->id.'/'.$case->image) }}" alt="">
        </div>
        <div class="case_dt">
            <div class="case_name">
                <p>Кейс <b>{{ $case->name }}</b></p>
            </div>
            <div class="case_price"><p>@if ($case->name == 'Бесплатный') Бесплатно @else {{ $case->price }} ₽ @endif</p></div>
        </div>
    </a>
</div>