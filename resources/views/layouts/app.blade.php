<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @stack('meta')

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://kit.fontawesome.com/d4e5f4a78e.js" crossorigin="anonymous"></script>

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <title>@stack('title') | KlaufShop</title>

    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <header>
        <div class="container">
            <div class="col-2 logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" alt="">
                </a>
            </div>
            <nav class="col-7 navigation">
                <ul class="nav_list">
                    <div class="container">
                        <a href="{{ route('accounts') }}">
                            <li class="nav_list_item 
                            {{ Request::is('accounts*') ? 'active' : '' }}"
                            >Аккаунты</li>
                        </a>
                        <a href="{{ route('cases') }}">
                            <li class="nav_list_item 
                            {{ Request::is('cases*') ? 'active' : '' }}"
                            >Кейсы</li>
                        </a>
                        <a href="{{ route('about') }}">
                            <li class="nav_list_item 
                            {{ Request::is('about-us*') ? 'active' : '' }}"
                            >О Нас</li>
                        </a>
                        <a href="{{ route('faq') }}">
                            <li class="nav_list_item 
                            {{ Request::is('faq*') ? 'active' : '' }}"
                            >FAQ</li>
                        </a>
                    </div>
                </ul>
            </nav>
            <div class="profile col-3">
                <div class="container">
                    @auth
                        <div class="profile_menu">
                            <div class="profile_header">
                                <div class="profile_dt">
                                    <div class="profile_name">{{ '@user'.Auth::user()->name }}</div>
                                    <div class="profile_money" id="account_money">{{ number_format(Auth::user()->money, 2, ',', ' ') }} ₽</div>
                                </div>
                                <div class="avatar">
                                    <img src="{{ Auth::user()->avatar }}" alt="">
                                </div>    
                            </div>
                            <div class="hidden_menu">
                                <ul class="menu_list">
                                    @if (Auth::check() && Auth::user()->role == 'admin')
                                        <a href="{{ route('admin') }}">
                                            <li class="menu_item">Админ панель</li>
                                        </a>
                                    @endif
                                    <a href="{{ route('profile') }}">
                                        <li class="menu_item">Мои товары</li>
                                    </a>
                                    <a href="{{ route('payment') }}">
                                        <li class="menu_item">Пополнить баланс</li>
                                    </a>
                                    <a href="https://vk.com/im?sel=-184196774" target="_blank">
                                        <li class="menu_item">Тех. поддержка</li>
                                    </a>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout').submit();">
                                        <li class="menu_item">Выйти</li>
                                        <form id="logout" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            @method('POST')
                                        </form>
                                    </a>
                                </ul>
                            </div>
                        </div>
                    @endauth
                    @guest
                        <a href="https://oauth.vk.com/authorize?client_id=7264964&display=page&redirect_uri=https://klaufshop.ru/vk&scope=groups&response_type=code&v=5.103" class="register_button vklogin pbutton"><p>Войти <i class="fab fa-vk"></i></p></a>
                    @endguest
                </div>
            </div>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="container">
            <div class="col-2 soc">
                <p class="f_text">Мы в соц сетях:</p>
                <ul class="list list_soc">
                    <a href="https://vk.com/ksbce" target="_blank"><li class="list_item soc_item"><i class="fab fa-vk"></i></li></a>
                    <a href="https://m.youtube.com/channel/UCEG5BHcL1trFzQwLKxj658w" target="_blank"><li class="list_item soc_item"><i class="fab fa-youtube"></i></li></a>
                    <a href="https://discord.gg/vZJ96d" target="_blank"><li class="list_item soc_item" ><i class="fab fa-discord"></i></li></a>
                    </ul>
            </div>
            <div class="col-8 payment">
                <p class="f_text">Платежные системы:</p>
                <ul class="list list_payments">
                    <li class="list_item payment_item"><img src="{{ asset('img/qiwi.png') }}" alt=""></li>
                    <li class="list_item payment_item"><img src="{{ asset('img/wm.png') }}" alt=""></li>
                    <li class="list_item payment_item"><img src="{{ asset('img/ya.png') }}" alt=""></li>
                    <li><a href="//showstreams.tv/"><img src="//www.free-kassa.ru/img/fk_btn/14.png" title="Бесплатный видеохостинг"></a></li>
                </ul>
            </div>
        </div>
    </footer>
    
</body>
</html>