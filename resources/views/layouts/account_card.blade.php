<div class="account_card col-3">
    <a href="{{ route('accounts_i', [$item->game, $item->id]) }}">
        <div class="account_thumb">
            <img src="{{ asset('img/accounts/'.$item->id.'/'.$item->images[0]->image) }}" alt="">
        </div>
        <div class="account_dt">
            <div class="account_md account_dt_title">
                <h5>Аккаунт "{{ $item->name }}"</h5>
            </div>
            <div class="account_md account_dt_rang">
                <div class="dt_r">{{ number_format($item->rang, 0, '', ' ') }} <span class="trophy"><i class="fas fa-trophy"></i></span></div>
                <div class="dt_rd">{{ $item->desc_rang }}</div>
            </div>
            <div class="account_md account_dt_lvl">
                {{ $item->lvl }}
            </div>
            <div class="account_md account_dt_money">            
                @if ($item->game == 'clash-of-clans')
                    <p class="gem"><span><i class="fas fa-gem"></i></span> {{ number_format($item->dres, 0, '', ' ') }}</p>
                    <p class="coin"><span><i class="fas fa-circle"></i></span> {{ number_format($item->mres, 0, '', ' ') }}</p>
                    <p class="liquid"><span><i class="fas fa-tint"></i></span> {{ number_format($item->ares, 0, '', ' ') }}</p>
                @elseif ($item->game == 'clash-royal')
                    <p class="gem"><span><i class="fas fa-gem"></i></span> {{ number_format($item->dres, 0, '', ' ') }}</p>
                    <p class="coin"><span><i class="fas fa-circle"></i></span> {{ number_format($item->mres, 0, '', ' ') }}</p>
                    <p class="liquid"><span><i class="fas fa-tint"></i></span> {{ number_format($item->ares, 0, '', ' ') }}</p>
                @else
                    <p class="gem"><span><i class="fas fa-gem"></i></span> {{ number_format($item->dres, 0, '', ' ') }}</p>
                    <p class="liquid"><span><i class="fas fa-star"></i></span> {{ number_format($item->mres, 0, '', ' ') }}</p>
                    <p class="coin"><span><i class="fas fa-circle"></i></span> {{ number_format($item->ares, 0, '', ' ') }}</p>
                @endif
            </div>
            @if ($item->isLinked)
                <div class="account_md account_dt_linked">Supercell ID</div>
            @endif
        </div>
    </a>
    <a href="" class="account_price">
        {{ number_format($item->price, 0, '', ' ') }} ₽
    </a>
</div>