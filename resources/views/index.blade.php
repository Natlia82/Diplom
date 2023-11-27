<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ИдёмВКино</title>
  <link rel="stylesheet" href="{{asset('/css/normalizeAdmin.css')}}">
  <link rel="stylesheet" href="{{asset('/css/stylesAdmin.css')}}">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
  <script src="{{asset('/js/accordeon.js')}}" defer></script>
</head>

<body>
  <header class="page-header">
    <h1 class="page-header__title">Идём<span>в</span>кино</h1>
    <span class="page-header__subtitle">Администраторррская</span>
  </header>
  
  <main class="conf-steps">
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Управление залами</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Доступные залы:</p>
        <ul class="conf-step__list">
        @foreach($zals as $zal)
            <li> {{$zal->name}}
              <button type="submit" data-id="{{$zal->id}}" class="conf-step__button conf-step__button-trash"></button>
            </li>  
        @endforeach 
        </ul>
        <button type="submit"  id="addCinima" class="conf-step__button conf-step__button-accent">Создать зал</button>
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация залов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
        @foreach($zals as $zal)
             @if ($loop->first)
                 <li><input type="radio" data-id="{{$zal->id}}" class="conf-step__radio cinemaPlases checkedPlaces" name="chairs-hall" value="{{$zal->name}}" checked><span class="conf-step__selector">{{$zal->name}}</span></li>
             @else    
                 <li><input type="radio" data-id="{{$zal->id}}" class="conf-step__radio cinemaPlases" name="chairs-hall" value="{{$zal->name}}"><span class="conf-step__selector">{{$zal->name}}</span></li>
            @endif 
            
        @endforeach 
          
        </ul>
        <p class="conf-step__paragraph">Укажите количество рядов и максимальное количество кресел в ряду:</p>
        <div class="conf-step__legend">
          <label class="conf-step__label">Рядов, шт<input type="number" class="conf-step__input" id="row" placeholder="10" value={{$row}} ></label>
          <span class="multiplier">x</span>
          <label class="conf-step__label">Мест, шт<input type="number" class="conf-step__input" id="colum" placeholder="8" value={{$colum}}></label>
        </div>
        <p class="conf-step__paragraph">Теперь вы можете указать типы кресел на схеме зала:</p>
        <div class="conf-step__legend">
          <span class="conf-step__chair conf-step__chair_standart"></span> — обычные кресла
          <span class="conf-step__chair conf-step__chair_vip"></span> — VIP кресла
          <span class="conf-step__chair conf-step__chair_disabled"></span> — заблокированные (нет кресла)
          <p class="conf-step__hint">Чтобы изменить вид кресла, нажмите по нему левой кнопкой мыши</p>
        </div>  
        
        <div class="conf-step__hall">
          <div class="conf-step__hall-wrapper">
          @for ($i = 1; $i <= $row; $i++)
            <div class="conf-step__row">
              @foreach($places as $plac)
                @if ($plac->row == $i)
                  
                    @if ($plac->typeOfPlace == 1)
                        <span class="conf-step__chair conf-step__chair_standart" data-row="{{$plac->row}}" data-colum="{{$plac->colum}}"></span>
                        @elseif ($plac->typeOfPlace == 2)
                        <span class="conf-step__chair conf-step__chair_vip" data-row="{{$plac->row}}" data-colum="{{$plac->colum}}"></span>
                        @else
                        <span class="conf-step__chair conf-step__chair_disabled" data-row="{{$plac->row}}" data-colum="{{$plac->colum}}"></span>     
                        @endif
                @endif
              @endforeach
            </div>    
          @endfor

         

           
          </div>  
        </div>
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input id="savePlsces" type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>                 
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация цен</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        <ul class="conf-step__selectors-box">
        @foreach($zals as $zal)
             @if ($loop->first)
                  <li><input type="radio" class="zal conf-step__radio checked" data-id="{{$zal->id}}" name="prices-hall" value="{{$zal->name}}" checked><span class="conf-step__selector">{{$zal->name}}</span></li>
             @else    
                  <li><input type="radio" class="zal conf-step__radio" data-id="{{$zal->id}}" name="prices-hall" value="{{$zal->name}}" ><span class="conf-step__selector">{{$zal->name}}</span></li> 
            @endif 
            
        @endforeach 
                
        </ul>
          
        <p class="conf-step__paragraph">Установите цены для типов кресел:</p>
          <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей
            @if (count($zals) > 0)
              <input id="price" type="text" class="conf-step__input" placeholder="0" value="{{$zals[0]->price}}"></label>
            @else
              <input id="price" type="text" class="conf-step__input" placeholder="0" value="0"></label>  
            @endif  
            за <span class="conf-step__chair conf-step__chair_standart"></span> обычные кресла
          </div>  
          <div class="conf-step__legend">
            <label class="conf-step__label">Цена, рублей
            @if (count($zals) > 0)
              <input id="priceVip" type="text" class="conf-step__input" placeholder="0" value="{{$zals[0]->priceVip}}"></label>
            @else
              <input id="priceVip" type="text" class="conf-step__input" placeholder="0" value="0"></label>
            @endif      
            за <span class="conf-step__chair conf-step__chair_vip"></span> VIP кресла
          </div>  
        
        <fieldset class="conf-step__buttons text-center">
          <button class="conf-step__button conf-step__button-regular">Отмена</button>
          <input id="priceCinema" type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
        </fieldset>  
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Сетка сеансов</h2>
      </header>
      <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">
          <button id="addFilm" class="conf-step__button conf-step__button-accent">Добавить фильм</button>
        </p>
        <div class="conf-step__movies">
        @foreach ($films as $film)
          <div class="conf-step__movie">
            <img data-id="{{$film->id}}" class="conf-step__movie-poster" alt="poster" src="{{asset('i/poster.png')}}">
            <h3 data-id="{{$film->id}}" class="conf-step__movie-title">{{$film->name}}</h3>
            <p data-id="{{$film->id}}" class="conf-step__movie-duration">{{$film->duration}} минут</p>
          </div>
        @endforeach  
                
        </div>
        
        <div class="conf-step__seances">
          @foreach ($zals as $zal)
              <div  class="conf-step__seances-hall">
                  <h3 class="conf-step__seances-title">{{$zal->name}}</h3>
                  <div data-zal="{{$zal->id}}" class="conf-step__seances-timeline">
                  @foreach ($sessions as $session)
                        @if ($zal->id == $session->cinema_id)
                          @php
                            $w = $session->duration * 0.5;
                            $l = (int)substr($session->timBegin, 0, 2) * 60 *0.5;
                            $c = '#'.str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                          @endphp
                            <div data-id="{{$session->id}}" class="conf-step__seances-movie" style="width: {{$w}}px; background-color: {{$c}}; left: {{$l}}px;">
                                <p data-id="{{$session->id}}" class="conf-step__seances-movie-title">{{$session->name}}</p>
                                <p data-id="{{$session->id}}" class="conf-step__seances-movie-start">{{$session->timBegin}}</p>
                            </div>
                        @endif
                  @endforeach
                  </div>
              </div>
          @endforeach

        </div>
        
   
      </div>
    </section>
    
    <section class="conf-step">
      <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Открыть продажи</h2>
      </header>
      <div class="conf-step__wrapper text-center">
        <p class="conf-step__paragraph">Всё готово, теперь можно:</p>
        <button id="openSale" class="conf-step__button conf-step__button-accent">Открыть продажу билетов</button>
      </div>
    </section>    
  </main>

  <div id="popup" class="popup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
          Удаление зала
          <a class="popup__dismiss closePr" href="#"><img src="{{asset('i/close.png')}}" alt="Закрыть"></a>
        </h2>

      </div>
      <div class="popup__wrapper">
        <form action="delete_hall" method="post" accept-charset="utf-8">
          <p class="conf-step__paragraph">Вы действительно хотите удалить зал <span></span>?</p>
          <!-- В span будет подставляться название зала -->
          <div class="conf-step__buttons text-center">
            <input id="DelOkCinima" type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
            <button class="closePr conf-step__button conf-step__button-regular">Отменить</button>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="popupAddCinima" class="popup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
          Добавление зала
          <a class="canselAddCinima popup__dismiss" href="#"><img src="{{asset('i/close.png')}}" alt="Закрыть"></a>
        </h2>

      </div>
      <div class="popup__wrapper">
        <form name="addCinima" id="formAddCinima" action="add_hall" method="post" accept-charset="utf-8">
          <label class="conf-step__label conf-step__label-fullsize" for="name">
            Название зала
            <input name="name" class="conf-step__inputв" type="text" placeholder="Например, &laquo;Зал 1&raquo;" name="name" required>
          </label>
          <div class="conf-step__buttons text-center">
            <input id="addCinimaForm" type="submit" value="Добавить зал" class="conf-step__button conf-step__button-accent">
            <button class="canselAddCinima conf-step__button conf-step__button-regular">Отменить</button>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="context-menu-open">
    <ul>
        <li data-id ="1" class="context-menu context-menu-click">обычные кресла</li>
        <li data-id ="2" class="context-menu">VIP кресла</li>
        <li data-id ="3" class="context-menu">заблокированные (нет кресла)</li>
    </ul>
</div>

<div class="context-del-open">
    <ul>
        <li id="viborDeleteFilm" data-id ="1" class="context-del-menu">Удалить фильм</li>
        
    </ul>
</div>

<div id="newFilm" class="popup active">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
          Добавление фильма
          <a class="popup__dismiss canselFilm" href="#"><img src="{{asset('i/close.png')}}" alt="Закрыть"></a>
        </h2>

      </div>
      <div class="popup__wrapper">
        <form action="add_movie" id="addMovie" method="post" accept-charset="utf-8">
          <label class="conf-step__label conf-step__label-fullsize" for="name">
            Название фильма
            <input id="inputName" class="conf-step__input" type="text" placeholder="Например, &laquo;Гражданин Кейн&raquo;" name="name" required>
          </label>
          <label class="conf-step__label conf-step__label-fullsize" for="description">
            Описание фильма
            <textarea id="textareaFilm" class="conf-step__input" type="text" placeholder="Например, &laquo; Генетически модернизировав себя с помощью ДНК других видов, охотники стали ещё сильнее, умнее и беспощаднее&raquo;" name="description" required></textarea>
          </label>
          <p class="conf-step__paragraph">Укажите страну и продолжительность:</p>
        <div class="conf-step__legend">
            <label id="labellegend" class="conf-step__label">Страна<input type="text" class="conf-step__input" placeholder="Индия" name="country" ></label>  
            <label id="labelMinut" class="conf-step__label">Продолжительность, мин<input type="text" class="conf-step__input" placeholder="180" name="duration"></label>
        </div>
          
          <div class="conf-step__buttons text-center">
            <input id="saveFilm" type="submit" value="Добавить фильм" class="conf-step__button conf-step__button-accent">
            <button type="submit" class="conf-step__button conf-step__button-regular canselFilm">Отменить</button>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>


<div id='newSeccion' class="popup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
          Добавление сеанса
          <a class="popup__dismiss canselSession" href="#"><img src="{{asset('i/close.png')}}" alt="Закрыть"></a>
        </h2>

      </div>
      <div class="popup__wrapper">
        <form id="formSession" method="post" accept-charset="utf-8">
          <label class="conf-step__label conf-step__label-fullsize" for="hall">
            Название зала
            <select class="conf-step__input" name="cinema_id" required>
              @foreach ($zals as $zal)
                <option value="{{$zal->id}}" selected>{{$zal->name}}</option>
              @endforeach
            </select>
          </label>
          <label class="conf-step__label conf-step__label-fullsize" for="name">
            Время начала
            <input class="conf-step__input" type="time" value="00:00" name="timBegin" required>
          </label>

          <label class="conf-step__label conf-step__label-fullsize" >
            Название зала
            <input class="conf-step__input" type="text" placeholder="Например, &laquo;Зал 1&raquo;" required>
          </label>

          <div class="conf-step__buttons text-center">
            <input id="saveSession" type="submit" value="Добавить" class="conf-step__button conf-step__button-accent">
            <button class="conf-step__button conf-step__button-regular canselSession">Отменить</button>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="delSessionProp" class="popup">
  <div class="popup__container">
    <div class="popup__content">
      <div class="popup__header">
        <h2 class="popup__title">
          Снятие с сеанса
          <a class="popup__dismiss canselDelSession" href="#"><img src="{{asset('i/close.png')}}" alt="Закрыть"></a>
        </h2>

      </div>
      <div class="popup__wrapper">
        <form action="вудуеу_hall" method="post" accept-charset="utf-8">
          <p class="conf-step__paragraph">Вы действительно хотите снять с сеанса фильм <span></span>?</p>
          <!-- В span будет подставляться название фильма -->
          <div class="conf-step__buttons text-center">
            <input id="delSession" type="submit" value="Удалить" class="conf-step__button conf-step__button-accent">
            <button class="conf-step__button conf-step__button-regular canselDelSession">Отменить</button>            
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
