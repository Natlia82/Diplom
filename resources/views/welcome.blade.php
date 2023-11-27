<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="{{asset('css/normalize.css')}}">
  <link rel="stylesheet" href="{{asset('css/styles.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
  <script src="{{asset('/js/scriptWelcom.js')}}"  defer></script>
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
  
  <nav class="page-nav">
    <a data-dat="31.10.2023" class="page-nav__day page-nav__day_today page-nav__day_chosen" href="#">
      <span class="page-nav__day-week">Пн</span><span class="page-nav__day-number">31</span>
    </a>
    <a data-dat="01.11.2023" class="page-nav__day" href="#">
      <span class="page-nav__day-week">Вт</span><span class="page-nav__day-number">1</span>
    </a>
    <a data-dat="02.11.2023" class="page-nav__day" href="#">
      <span class="page-nav__day-week">Ср</span><span class="page-nav__day-number">2</span>
    </a>
    <a data-dat="03.11.2023" class="page-nav__day" href="#">
      <span class="page-nav__day-week">Чт</span><span class="page-nav__day-number">3</span>
    </a>
    <a data-dat="04.11.2023" class="page-nav__day" href="#">
      <span class="page-nav__day-week">Пт</span><span class="page-nav__day-number">4</span>
    </a>
    <a data-dat="05.11.2023" class="page-nav__day page-nav__day_weekend" href="#">
      <span class="page-nav__day-week">Сб</span><span class="page-nav__day-number">5</span>
    </a>
    <a class="page-nav__day page-nav__day_next" href="">
    </a>
  </nav>
  
  <main>
 
  @foreach($film as $item)
    
    <section class="movie">
      <div class="movie__info">
        <div class="movie__poster">
          <img class="movie__poster-image" alt="Звёздные войны постер" src="{{asset('i/poster1.jpg')}}">
        </div>
        <div class="movie__description">
          <h2 class="movie__title"> {{$item->name}}</h2>
          <p class="movie__synopsis">{{$item->description}}</p>
          <p class="movie__data">
            <span class="movie__data-duration">{{$item->duration}} мин.</span>
            <span class="movie__data-origin">{{$item->country}}</span>
          </p>
        </div>
      </div>  
      @foreach($countZal as $Zal)
      <div class="movie-seances__hall">
        <h3 class="movie-seances__hall-title">{{$Zal->name}}</h3>
        <ul class="movie-seances__list">
          @foreach($session as $timS)
              @if ($timS->cinema_id == $Zal->id && $timS->film_id == $item->id)
              <li class="movie-seances__time-block"><a class="movie-seances__time" data-Zal="{{$Zal->id}}" data-tim="{{$timS->id}}" data-fulm="{{$item->id}}" href="#">{{$timS->timBegin}}</a></li>
              @endif
          @endforeach
        </ul>
      </div>
      @endforeach
     
    </section>
    @endforeach
    
  </main>
  
</body>
</html>