@extends('layouts.app')

@section('content')
<style>
    body header {
        margin-top: 0;
    }
</style>

<section class="login">
    <div class="container">
        <div class="section_dt col-12">
            <h1 class="section_title">
                Введите Email и пароль
            </h1>
            <p class="section_description">
                для авторизации на нашем сайте
            </p>
        </div>
        <form action="{{ route('login') }}" method="POST" class="form auth_form col-4">
            @csrf
            @method("POST")
            <div class="form_group">
                <input type="email" name="email" class="form_input @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="form_group">
                <input type="password" name="password" class="form_input @error('password') is-invalid @enderror" placeholder="Пароль">
            </div>
            <div class="form_group">
                <div class="container">
                    <button class="login pbutton">Войти</button>
                    <a href="https://oauth.vk.com/authorize?client_id=7264964&display=page&redirect_uri=https://klaufshop.ru/vk&scope=groups&response_type=code&v=5.103" class="vklogin pbutton"><p>Войти <i class="fab fa-vk"></i></p></a>
                </div>
            </div>
            <div class="form_group">
                <div class="container">
                    <a href="{{ route('register') }}" class="link"><p>Авторизация</p></a>
                </div>
            </div> 
        </form>
    </div>
</section>
@endsection
