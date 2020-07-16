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
                Заполните все поля
            </h1>
            <p class="section_description">
                для регистрации на нашем сайте
            </p>
        </div>
        <form action="{{ route('register') }}" method="POST" class="form auth_form col-4">
            @csrf
            @method("POST")
            <div class="form_group">
                <input type="email" name="email" class="form_input @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="form_group" hidden>
                <input type="text" name="referral" class="form_input" placeholder="Реферал" value="{{ $referral }}" readonly>
            </div>
            <div class="form_group">
                <input type="password" name="password" class="form_input @error('password') is-invalid @enderror" placeholder="Пароль">
            </div>
            <div class="form_group">
                <input type="password" name="password_confirmation" class="form_input @error('password') is-invalid @enderror" placeholder="Повторите пароль">
            </div>
            <div class="form_group">
                <div class="container">
                    <button class="login pbutton">Зарегистрироваться</button>
                </div>
            </div>
            <div class="form_group">
                <div class="container">
                    <a href="{{ route('login') }}" class="link"><p>Авторизироваться</p></a>
                </div>
            </div> 
        </form>
    </div>
</section>
@endsection
