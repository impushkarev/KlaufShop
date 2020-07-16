<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <title>Document</title>
</head>
<style>
* {
    box-sizing: border-box;
}
body {
    margin: 0 auto;
}
.container {
    width: 100%;
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 100px;   
}
.container h1 {
    width: 100%;
}
form.form_account, form.form_case {
    width: 33%;
    padding: 0 50px;
}
form.form_case {
    width: 66%;
}
form .container {
    margin: 0;
}
form.form_case .prize {
    width: 33.3%;
    padding: 0 5px;
}
form p.link {
    display: none;
    color: #ff0000;
    cursor: pointer;
    text-decoration: underline;
}
.add_prize {
    text-align: center;
    color: #0000ff;
    cursor: pointer;
    text-decoration: underline;
}
.delete_prize {
    width: 100%;
    color: #ff0000;
    cursor: pointer;
    line-height: 30px;
}
.prize_list {
    padding-left: 15px;
}
.prize_list li {
    display: flex;
    margin-bottom: 5px;
}
.prize_list li input {
    margin: 0;
}
.prize_list li p {
    margin: 0;
    width: 30px;
    cursor: pointer;
    line-height: 30px;
    text-align: center;
}
.delete_prize:hover {
    text-decoration: underline;
}
form input, form select, form textarea {
    width: 100%;
    display: block;
    margin: 10px 0;
    resize: vertical;
    padding: 5px 10px;
    box-sizing: border-box;
}
form input[type="checkbox"] {
    width: 50px;
    display: inline-block;
}
form input[type="reset"] {
    display: none;
}
ul.account_list {
    width: 33%;
    height: 500px;
    margin: 0;
    padding: 0 50px;
    overflow-y: auto;
}
ul.account_list li {
    cursor: pointer;
    line-height: 30px;
}
ul.account_list li:hover {
    background-color: #f9f9f9;
}
ul.account_list form.delete {
    float: right;
}
</style>
<body>
    <div class="container">
        <h1>Админ панель</h1>
        <form class="form_account" id="account_form" action="{{ route('admin_account_create') }}" method="post" enctype="multipart/form-data">
            @csrf 
            @method('POST')
            <input type="reset" value="reset" display="none" id="res">
            <h2>Создать аккаунт</h2>
            <p id="clear_form" class="link" data-url="{{ route('admin_account_create') }}">Создать аккаунт</p>
            <input type="file" name="files[]" multiple>
            <input type="text" name="name" placeholder="Название">
            <select name="game" id="">
                <option value="clash-of-clans" selected="true">Clash of Clans</option>
                <option value="clash-royal">Clash Royal</option>
                <option value="brawl-stars">Brawl Stars</option>
            </select>
            <textarea name="description" id="" placeholder="Описание"></textarea>
            <br>
            <input name="rang" type="text" placeholder="Ранг">
            <input name="desc_rang" type="text" placeholder="Описание ранга">
            <input name="lvl" type="text" placeholder="Уровень">
            <br>
            <input name="mres" type="text" placeholder="Ресурсы">
            <input name="ares" type="text" placeholder="Доп ресурсы">
            <input name="dres" type="text" placeholder="Донат ресурсы">
            <br>
            <input name="login" type="text" placeholder="Логин">
            <input name="password" type="text" placeholder="Пароль">
            <label for="link">Привязан</label>
            <input name="link" type="checkbox" id="link" value="true">
            <input name="price" type="text" placeholder="Цена">
            <br>
            <button>Создать аккаунт</button>
        </form>
        <ul class="account_list" id="accounts">
            <h2>Список аккаунтов</h2>
            @foreach ($accounts as $account)
                <li data-url="{{ route('admin_account_update', $account->id) }}"
                    data-name="{{ $account->name }}" 
                    data-game="{{ $account->game }}" 
                    data-description="{{ $account->description }}"
                    data-rang="{{ $account->rang }}"
                    data-desc_rang="{{ $account->desc_rang }}"
                    data-lvl="{{ $account->lvl }}"
                    data-mres="{{ $account->mres }}"
                    data-ares="{{ $account->ares }}"
                    data-dres="{{ $account->dres }}"
                    data-login="{{ $account->login }}"
                    data-password="{{ $account->password }}"
                    data-link="{{ $account->link }}"
                    data-price="{{ $account->price }}">
                    {{$account->name}}
                    <form class="delete" action="{{ route('admin_account_delete', $account) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button>x</button>
                    </form>
                </li>
            @endforeach
            <script>
                $(document).ready(function() {
                    $("#accounts li").click(function() {
                        $("#clear_form").show();

                        $("#account_form")[0].setAttribute('action', this.dataset.url);
                        
                        $("#account_form h2").html("Обновить аккаунт");
                        $("#account_form button").html("Обновить аккаунт");

                        $("#account_form").children("input[name=name]").val(this.dataset.name);
                        $("#account_form select option[selected=true]")[0].setAttribute("selected", false);
                        $("#account_form select").children("option[value="+this.dataset.game+"]")[0].setAttribute("selected", true);
                        $("#account_form").children("textarea[name=description]").html(this.dataset.description);
                        $("#account_form").children("input[name=rang]").val(this.dataset.rang);
                        $("#account_form").children("input[name=desc_rang]").val(this.dataset.desc_rang);
                        $("#account_form").children("input[name=lvl]").val(this.dataset.lvl);
                        $("#account_form").children("input[name=mres]").val(this.dataset.mres);
                        $("#account_form").children("input[name=ares]").val(this.dataset.ares);
                        $("#account_form").children("input[name=dres]").val(this.dataset.dres);
                        $("#account_form").children("input[name=login]").val(this.dataset.login);
                        $("#account_form").children("input[name=password]").val(this.dataset.password);
                        $("#account_form").children("input[name=link]")[0].setAttribute("checked", this.dataset.link);
                        $("#account_form").children("input[name=price]").val(this.dataset.price);
                        

                    });

                    $("#account_form #clear_form").click(function() {
                        $("#res").click();
                        $(this).hide();

                        $("#account_form h2").html("Создать аккаунт");
                        $("#account_form button").html("Создать аккаунт");

                        $("#account_form")[0].setAttribute('action', this.dataset.url);
                        $("#account_form").children("textarea[name=description]").html("");
                        $("#account_form").children("input[name=link]")[0].removeAttribute("checked");
                    });
                });
            </script>
        </ul>
    </div>
    <div class="container">
        <form class="form_case" id="case_form" action="{{ route('admin_case_create') }}" method="POST"  enctype="multipart/form-data">
            @csrf 
            @method('POST')
            <h2>Создать кейс</h2>
            <p id="clear_form" class="link" data-url="{{ route('admin_case_create') }}">Создать кейс</p>
            <input type="file" name="files">
            <input type="text" name="name" placeholder="Название">
            <select name="type" id="">
                <option value="Youtube" selected="true">Youtube</option>
                <option value="Regular">Обычный</option>
            </select>
            <br>
            <p class="add_prize" id="add_prizes">Добавить выйгрыш</p>
            <div class="container">
                <div class="prize" id="clone" hidden>
                    <p class="delete_prize" onclick="$(this).parent().remove()">x</p>
                    <input type="text" name="name_prize[]" placeholder="Названия приза">
                    <select name="type_of_prize[]" id="">
                        <option value="phyz" selected="true">Физическое</option>
                        <option value="money">Валюта сайта</option>
                        <option value="accounts">Аккаунт</option>
                    </select>
                    <select name="count[]">
                        <option value="inf">Безгранично</option>
                        <option value="notinf">Ограничено</option>
                    </select>
                    <input type="text" name="chance[]" placeholder="Шанс получить">
                    <p class="add_prize ap" 
                        onclick="$(this).parent().children('.prize_list').children('li').first().clone().appendTo($(this).parent().children('.prize_list'));">
                    Добавить</p>
                    <ul class="prize_list">
                        <li>
                            <input type="text" name="data_prize[][]">
                            <p onclick="$(this).parent().remove()">x</p>
                        </li>                    
                    </ul>
                </div>
            </div>
            <br>
            <input name="price" type="text" placeholder="Цена">
            <br>
            <button>Создать кейс</button>
        </form>
        <ul class="account_list" id="accounts">
            <h2>Список Кейсов</h2>
            @foreach ($cases as $case)
                <li>
                    {{$case->name}}
                    <form class="delete" action="{{ route('admin_case_delete', $case) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button>x</button>
                    </form>
                </li>
            @endforeach
        </ul>
        <script>
            $(document).ready(function() {
                var count = 0;
                $("#add_prizes").click(function() {
                    var prize = $("#case_form .container #clone").clone().appendTo('#case_form .container').attr("id", "").show();
                    count++;
                    prize.children('.prize_list').children("li").children("input").attr('name', "data_prize["+count+"][]");
                });
                $("#add_prizes").click();
            });
        </script>
    </div>
    <div class="container">
        <ul class="payments_list">
            <h2>Список Пополнении</h2>
            @foreach ($payments as $payment)
                <a href="https://vk.com/id{{$payment->getUser->name}}">
                    <li>
                        Пользователь @user{{ $payment->getUser->name }} пополнин на {{ $payment->amount }} руб.
                        <p>{{ $payment->updated_at }}</p>
                    </li>
                </a>
            @endforeach
            <h3>Получено сегодня: {{ $today_payments_sum }}</h3>
            <h3>Сумма: {{$payments->sum('amount')}}</h3>
        </ul>
        <ul class="payments_list">
            <h2>Список Призов</h2>
            @foreach ($checks as $check)
                <a href="https://vk.com/id{{$check->getUser->name}}">
                    <li>
                        Пользователь @user{{ $check->getUser->name }} получил {{ $check->getPrize->name }} из {{ $check->getCase->name }}
                        <p>{{ $check->updated_at }}</p>
                    </li>
                </a>
            @endforeach
        </ul>
    </div>
</body>
</html>