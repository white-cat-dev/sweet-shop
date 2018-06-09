<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <title>Кондитерская Анны Малининой</title>
</head>

<body>
    <div class="top-line">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-md">

                <div class="logo mr-auto">
                    <img src="/img/logo.png">
                    <p>Кондитерская<br>Анны Малининой</p>
                </div>
                
                <div class="ml-auto">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            
                <div class="collapse navbar-collapse" id="navbar">
                    @guest
                        <div class="ml-auto text-right">
                            <a href="{{ route('login') }}" class="btn btn-primary ml-auto">Вход</a>
                            <a href="{{ route('register') }}" class="btn btn-primary ml-auto">Регистрация</a>
                        </div>
                    @else

                    <div class="ml-auto text-right">

                        <a href="/cakes" class="btn btn-primary ml-auto">Торты</a>
                        <a href="/ingredients" class="btn btn-primary ml-auto">Ингредиенты</a>
                        <a href="/orders" class="btn btn-primary ml-auto">Заказы</a>
                        <a href="/reviews" class="btn btn-primary ml-auto">Отзывы</a>
                        <a class="btn btn-primary ml-auto" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>Выход</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    @endguest  
                </div>
            </nav>
        </div>
    </div>

    <div class="content">
        @yield('content') 
    </div>

    <div class="bottom-line">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-auto">Copyright © Анна Малинина, 2018</div>
                <div class="col-12 col-md-auto ml-auto"><a href="#" class="btn-link">Разработка сайтов</a></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/js/script.js"></script>
</body>
</html>