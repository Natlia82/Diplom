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
  <script src="{{asset('/js/script.js')}}" defer></script>  
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
  </header>
  
  <main>
    <section class="buying">
      <div class="buying__info">
        <div class="buying__info-description">
          <h2 class="buying__info-title" dat-film="{{$name}}">{{$name}}</h2>
          <p class="buying__info-start" data-dat="{{$dat}}">Начало сеанса: {{$dat}} в {{$beg->timBegin}}</p>
          <p class="buying__info-hall" data-zal="{{$zal->name}}">{{$zal->name}}</p>          
        </div>
        <div class="buying__info-hint">
          <p>Тапните дважды,<br>чтобы увеличить</p>
        </div>
      </div>  
     
      <div class="buying-scheme">
        <div class="buying-scheme__wrapper">
       
        @for ($i = 1; $i <= $pow; $i++)
            <div class="buying-scheme__row">
            @foreach($place as $pl)
              @if (intval($pl->row) === $i)
                  @php 
                    $flag = 0;
                  @endphp
                  @foreach($tickets as $ticket)
                      @if ($ticket->place_id == $pl->id)
                        @php 
                          $flag = 1;
                        @endphp
                      @endif
                  @endforeach
                  @if ($flag === 0)
                     @if (intval($pl->typeOfPlace) === 1)
                        <span data-place="{{$pl->id}}"   data-s="{{$beg->id}}" data-summ="{{$zal->price}}" data-atr="OK" class="buying-scheme__chair buying-scheme__chair_standart"></span>
                     @elseif (intval($pl->typeOfPlace) === 2)
                        <span data-place="{{$pl->id}}"  data-s="{{$beg->id}}" data-summ="{{$zal->priceVip}}" data-atr="OK" class="buying-scheme__chair buying-scheme__chair_vip"></span>
                      @else
                        <span  class="buying-scheme__chair buying-scheme__chair_disabled"></span>
                      @endif
                  @else
                        <span class="buying-scheme__chair buying-scheme__chair_taken"></span>
                  @endif    
              
              @endif
            @endforeach
          </div>  
          @endfor
        </div>
        <div class="buying-scheme__legend">
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_standart"></span> Свободно (<span class="buying-scheme__legend-value">{{$zal->price}}</span>руб)</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_vip"></span> Свободно VIP (<span class="buying-scheme__legend-value">{{$zal->priceVip}}</span>руб)</p>            
          </div>
          <div class="col">
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_taken"></span> Занято</p>
            <p class="buying-scheme__legend-price"><span class="buying-scheme__chair buying-scheme__chair_selected"></span> Выбрано</p>                    
          </div>
        </div>
      </div>
      <button type="submit" class="acceptin-button" >Забронировать</button>
    </section>     
  </main>
  
</body>
</html>