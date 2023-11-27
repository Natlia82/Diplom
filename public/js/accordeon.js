const headers = Array.from(document.querySelectorAll('.conf-step__header'));
headers.forEach(header => header.addEventListener('click', () => {
    header.classList.toggle('conf-step__header_closed');
    header.classList.toggle('conf-step__header_opened');
}));

const delCinima = document.querySelectorAll('.conf-step__button-trash');
const prop = document.getElementById('popup');
const closePr = document.querySelectorAll('.closePr');
const DelOkCinima = document.getElementById('DelOkCinima');
const addByttonCinima = document.getElementById('addCinima'); //кнопка создания зала
const addCinima = document.getElementById('popupAddCinima'); //окно для ввода информации о зале
const canselAddCinima = document.querySelectorAll('.canselAddCinima'); //отмена ввода зала
const addCinimaForm = document.getElementById('addCinimaForm'); //добавление нового зала
const priceCinema = document.getElementById('priceCinema'); //кнопка сохранить цену на билеты
const cinemaClick = document.querySelectorAll('.zal');
const cinemaPlases = document.querySelectorAll('.cinemaPlases');
const rowCinema = document.getElementById('row');
const columCinema = document.getElementById('colum');
//const places = document.querySelectorAll('.conf-step__row .conf-step__chair');
const contextMenuOpen = document.querySelector('.context-menu-open');
const contextMenu = document.querySelectorAll('.context-menu');
const confStepHall = document.querySelector('.conf-step__hall');
const savePlsces = document.getElementById('savePlsces');
const addFilm = document.getElementById('addFilm'); //кнопка добавить фильм
const newFilm = document.getElementById('newFilm'); // окно для ввода нового фильма
const canselFilm = document.querySelectorAll('.canselFilm') // кнопки отмены ввода нового фильма
const saveFilm = document.getElementById('saveFilm'); // кнопка сохранить фильм
const addSession = document.querySelector('.conf-step__movies'); // все фильмы
const newSeccion = document.getElementById('newSeccion'); //окно для ввода сеанса
const canselSession = document.querySelectorAll('.canselSession'); //отмена добавления сеанса
const saveSession = document.getElementById('saveSession'); //сохранение сеанса
const openSale = document.getElementById('openSale'); // открыть продажу 
const confStepSeances = document.querySelector('.conf-step__seances'); //секция с сеансами
const delSessionProp = document.getElementById('delSessionProp'); // окно для удаления сеанса
const canselDelSession = document.querySelectorAll('.canselDelSession'); // отменить удалние сеанса
const delSession = document.getElementById('delSession'); // удаление  сеанса
const contextDelOpen = document.querySelector('.context-del-open');
const viborDeleteFilm = document.getElementById("viborDeleteFilm");



function classPropup(elementProp) {
    elementProp.classList.toggle('popup');
    elementProp.classList.toggle('popupVis');
}


function checkedElement(element1, element2, classStr) {
    //  console.log("вызов");
    //  console.log(element1);
    //  console.log(element2);
    //   console.log(classStr);
    document.querySelector(element1).removeAttribute("checked");
    document.querySelector(element1).classList.remove(classStr);

    element2.classList.add(classStr);
    element2.setAttribute("checked", "");
}

function requestWithResponse() {

}

function requestWithoutResponse(url, metod, bodu) {
    let xhr = new XMLHttpRequest();
    xhr.open(metod, url);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(bodu);
}

function buildAGym(rowCinema, columCinema) {
    let divContener = document.querySelector('.conf-step__hall-wrapper');
    let newDiv = document.createElement('div');
    newDiv.classList.add('conf-step__hall-wrapper');
    for (let i = 1; i <= rowCinema; i++) {
        let p = document.createElement('div');
        p.classList.add('conf-step__row');
        p.setAttribute("data-row", i);
        //p.textContent = '!';
        for (let j = 1; j <= columCinema; j++) {
            let sp = document.createElement('span');
            sp.classList.add('conf-step__chair');
            sp.classList.add('conf-step__chair_disabled');
            sp.setAttribute("data-colum", j);
            sp.setAttribute("data-row", i);
            p.appendChild(sp);
        }

        newDiv.appendChild(p);
    }
    divContener.replaceWith(newDiv);

}

delCinima.forEach(element => {

    element.addEventListener('click', function(event) {
        event.preventDefault();

        // console.log(event.target.getAttribute('data-id'));
        classPropup(prop);
        event.target.classList.add('selectCinima');

    });
});

closePr.forEach(element => {

    element.addEventListener('click', function(event) {
        event.preventDefault();
        classPropup(prop);
        const selectCinima = document.querySelector('selectCinima');
        selectCinima.classList.remove('selectCinima');

    });
});

DelOkCinima.addEventListener('click', function(event) {
    event.preventDefault();
    const selectCinima = document.querySelector('.selectCinima');

    requestWithoutResponse('../delCinema/' + selectCinima.getAttribute('data-id'), "delete", null);

    classPropup(prop);
    location.reload();
});
//создание зала (выводит окно для ввода)
addByttonCinima.addEventListener('click', function(event) {
    event.preventDefault();
    classPropup(addCinima);
});

canselAddCinima.forEach(element => {

    element.addEventListener('click', function(event) {
        event.preventDefault();
        classPropup(addCinima);

    });
});

addCinimaForm.addEventListener('click', function(event) {
    event.preventDefault();
    //  let formData = new FormData(document.getElementById('formAddCinima'));
    let formData = new FormData(document.forms.addCinima);
    /*   const values = [...formData.entries()];
      console.log(values);
       console.log(...formData);
       console.log(formData.get('name'));*/
    const ticket = {
        "name": formData.get('name'),

    };

    requestWithoutResponse('../addCinima', "POST", JSON.stringify(ticket));

    classPropup(addCinima);
    location.reload();

});

//сохранение цены на балет
priceCinema.addEventListener('click', function(event) {

    event.preventDefault();

    var checkboxes = document.querySelector('.checked');

    // console.log(checkboxes);
    // console.log(checkboxes.getAttribute('data-id'))

    const price = {
        "price": document.getElementById('price').value,
        "priceVip": document.getElementById('priceVip').value,
    };

    //  console.log(price);
    requestWithoutResponse('../priceCinima/' + checkboxes.getAttribute('data-id'), "PUT", JSON.stringify(price));


});



cinemaClick.forEach(element => {

    element.addEventListener('click', function(event) {
        checkedElement('.checked', event.target, 'checked');


        // console.log(event.target.getAttribute('data-id'));
        /****** */

        let xhr = new XMLHttpRequest();
        const url = '../price/' + event.target.getAttribute('data-id');
        xhr.open("PUT", url);
        // xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send();
        xhr.onload = function() {
            if (xhr.status = 200) {
                const rez = JSON.parse(xhr.response);
                //   console.log(rez);
                let newPrice = document.createElement("input");
                newPrice.classList.add("conf-step__input");
                newPrice.setAttribute("id", "price");
                newPrice.setAttribute("type", "text");
                newPrice.setAttribute("placeholder", "0");
                newPrice.setAttribute("value", rez.price);
                //  console.log(newPrice);
                const oldPrici = document.getElementById('price');
                oldPrici.replaceWith(newPrice);
                let newPriceVip = document.createElement("input");
                newPriceVip.classList.add("conf-step__input");
                newPriceVip.setAttribute("id", "priceVip");
                newPriceVip.setAttribute("type", "text");
                newPriceVip.setAttribute("placeholder", "0");
                newPriceVip.setAttribute("value", rez.priceVip);
                // console.log(newPriceVip);
                const oldPriciVip = document.getElementById('priceVip');
                oldPriciVip.replaceWith(newPriceVip);

            }
        };
        /******** */

    });
});


cinemaPlases.forEach(element => {

    element.addEventListener('click', function(event) {

        checkedElement('.checkedPlaces', event.target, 'checkedPlaces');


        // console.log(event.target.getAttribute('data-id'));
        /****** */

        let xhr = new XMLHttpRequest();
        const url = '../place/' + event.target.getAttribute('data-id');
        xhr.open("PUT", url);
        // xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send();
        xhr.onload = function() {
            if (xhr.status = 200) {
                const rez = JSON.parse(xhr.response);
                //  console.log(rez);
                /****** */
                document.getElementById('row').value = rez.maxRow;
                document.getElementById('colum').value = rez.maxColum;
                /******** */
                const arrayRez = rez.all;
                const old = document.querySelector('.conf-step__hall-wrapper');
                const newElement = document.createElement("div");
                newElement.classList.add('conf-step__hall-wrapper');
                for (let i = 1; i <= rez.maxRow; i++) {
                    let newDiv = document.createElement("div");
                    newDiv.classList.add('conf-step__row');
                    newDiv.setAttribute('data-row', i);
                    for (let j = 1; j <= rez.maxColum; j++) {
                        //console.log(rez.all);
                        arrayRez.forEach((element) => {
                                if (i == element.row & j == element.colum) {
                                    let newSpan = document.createElement("span");
                                    newSpan.classList.add('conf-step__chair');
                                    newSpan.setAttribute('data-colum', element.colum);
                                    newSpan.setAttribute('data-row', element.row);
                                    if (element.typeOfPlace == 1) {
                                        newSpan.classList.add('conf-step__chair_standart');
                                    }
                                    if (element.typeOfPlace == 2) {
                                        newSpan.classList.add('conf-step__chair_vip');
                                    }
                                    if (element.typeOfPlace == 3) {
                                        newSpan.classList.add('conf-step__chair_disabled');
                                    }
                                    //  console.log(newSpan);
                                    newDiv.appendChild(newSpan);
                                }

                            }

                        );

                    }
                    newElement.appendChild(newDiv);
                    //  console.log(newElement);
                }

                old.replaceWith(newElement);

            }
        };
        /******** */

    });
});

rowCinema.addEventListener('change', function(event) {
    if (columCinema.value) {
        //   console.log('row2');
        buildAGym(rowCinema.value, columCinema.value);
    }

});

columCinema.addEventListener('change', function(event) {
    if (rowCinema.value) {
        //  console.log('colum');
        buildAGym(rowCinema.value, columCinema.value);
    }

});

contextMenu.forEach(element => {
    element.addEventListener('click', function(event) {
        document.querySelector('.context-menu-click').classList.remove('context-menu-click');
        event.target.classList.add('context-menu-click');

        const rez = event.target.getAttribute('data-id');

        let text = ""
        if (rez === "1") {
            text = "conf-step__chair_standart";
        } else if (rez === "2") {
            text = "conf-step__chair_vip";
        } else text = "conf-step__chair_disabled";

        const vibor = document.querySelector('.vibor');
        vibor.classList.remove("conf-step__chair_standart");
        vibor.classList.remove("conf-step__chair_vip");
        vibor.classList.remove("conf-step__chair_disabled");

        vibor.classList.add(text);
        vibor.classList.remove("vibor");

    });

});



confStepHall.addEventListener('contextmenu', function(event) {

    let target = event.target;
    //    console.log(target.tagName);
    if (target.tagName != 'SPAN') return;
    event.preventDefault();

    if (document.querySelector('.vibor')) {
        document.querySelector('.vibor').classList.remove("vibor");
    }

    contextMenuOpen.style.left = event.clientX + 'px';
    contextMenuOpen.style.top = event.clientY + 'px';
    contextMenuOpen.style.display = 'block';


    event.target.classList.add("vibor");

});


window.addEventListener('click', function() {
    contextMenuOpen.style.display = 'none';
    contextDelOpen.style.display = 'none';
    //document.querySelector('.vibor').classList.remove("vibor");
});

savePlsces.addEventListener('click', function(event) {
    const idElement = document.querySelector('.checkedPlaces');
    const idCinema = idElement.getAttribute('data-id');
    const places = document.querySelectorAll('.conf-step__row .conf-step__chair');
    // console.log(places);
    const rw = document.getElementById('row').value;
    const col = document.getElementById('colum').value;

    let plOk = [];
    for (let i = 1; i <= Number(rw); i++) {
        let m = 0;
        let flag = 0;
        let vidCresla = 3;
        for (let j = 0; j <= Number(col); j++) {

            places.forEach(element => {
                if (Number(element.getAttribute('data-row')) == i &
                    Number(element.getAttribute('data-colum')) == j) {
                    if (element.classList.contains('conf-step__chair_standart')) {
                        vidCresla = 1;
                        m = m + 1;
                        flag = m;
                    }
                    if (element.classList.contains('conf-step__chair_vip')) {
                        vidCresla = 2;
                        m = m + 1;
                        flag = m;
                    }
                    if (element.classList.contains('conf-step__chair_disabled')) {
                        vidCresla = 3;
                        flag = 0;
                    }

                    plOk.push({
                        "typeOfPlace": vidCresla,
                        "row": Number(element.getAttribute('data-row')),
                        "colum": element.getAttribute('data-colum'),
                        "seatNumber": flag,
                        "cinema_id": idCinema,
                        "unicum": idCinema + element.getAttribute('data-row') + element.getAttribute('data-colum'),
                    });
                }
            });
        }
    }



    const plaseAll = {
        "id": idCinema,
        "row": rw,
        "colum": col,
        "plas": plOk,
    }

    // console.log(plaseAll);
    requestWithoutResponse('../places', "POST", JSON.stringify(plaseAll));
});

//добавление фольма (выводит окно для ввода)
addFilm.addEventListener('click', function(event) {
    event.preventDefault();
    classPropup(newFilm);
    document.getElementById('inputName').value = "";
    document.getElementById('textareaFilm').value = "";
    document.getElementById('labellegend').value = "";
    document.getElementById('labelMinut').value = "";
})

//отменить ввод фильма
canselFilm.forEach(element => {

    element.addEventListener('click', function(event) {
        event.preventDefault();
        classPropup(newFilm);

    });
});

// сохранение фильма
saveFilm.addEventListener('click', function(event) {
    event.preventDefault();
    const oldFilm = document.querySelector('.conf-step__movies');
    var form = document.getElementById('addMovie');
    var formData = new FormData(form);
    let obj = {};
    for (var [key, value] of formData.entries()) {
        obj[key] = value;
    }

    //  console.log(obj);

    //requestWithoutResponse('../addMovie', "POST", JSON.stringify(obj));
    /****** */

    let xhr = new XMLHttpRequest();
    xhr.open("POST", '../addMovie');
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(obj));
    xhr.onload = function() {
        if (xhr.status = 200) {
            const rez = JSON.parse(xhr.response);
            //   console.log(rez[0]);
            let newDiv = document.createElement('div');
            newDiv.classList.add('conf-step__movie');
            let newImg = document.createElement('img');
            newImg.classList.add('conf-step__movie-poster');
            newImg.setAttribute('alt', "poster");
            newImg.setAttribute('src', "/public/i/poster.png");
            newImg.setAttribute('data-id', rez[0].id);
            let newH = document.createElement('h3');
            newH.classList.add('conf-step__movie-title');
            newH.textContent = rez[0].name;
            newH.setAttribute('data-id', rez[0].id);
            let newP = document.createElement('p');
            newP.classList.add('conf-step__movie-duration');
            newP.textContent = rez[0].duration + ' минут';
            newP.setAttribute('data-id', rez[0].id);
            newDiv.appendChild(newImg);
            newDiv.appendChild(newH);
            newDiv.appendChild(newP);
            //   console.log(newDiv);
            oldFilm.appendChild(newDiv);
        }
    };
    /******** */



    classPropup(newFilm);

});

//вывод окна доб. сеанса при выборе фильма
addSession.addEventListener('click', function(event) {

    let target = event.target;
    //  console.log(target);

    if (target.tagName != 'IMG' & target.tagName != 'H3' &
        target.tagName != 'P') return;
    event.preventDefault();
    event.target.classList.add('viborfilm');
    classPropup(newSeccion);

});

//отмена ввода сеанса
canselSession.forEach(element => {
    element.addEventListener('click', function(event) {
        event.preventDefault();
        classPropup(newSeccion);
        //event.target.classList.remove('viborfilm');
        document.querySelector('.viborfilm').classList.remove('viborfilm');
    });
});

//сохранение сеанса
saveSession.addEventListener('click', function(event) {
    event.preventDefault();
    var form = document.getElementById('formSession');
    var formData = new FormData(form);
    let obj = {};
    for (var [key, value] of formData.entries()) {
        obj[key] = value;
    }
    obj['film_id'] = document.querySelector('.viborfilm').getAttribute('data-id');
    //console.log(obj);
    document.querySelector('.viborfilm').classList.remove('viborfilm');
    //  requestWithoutResponse('../addSession', "POST", JSON.stringify(obj));
    /****** */

    let xhr = new XMLHttpRequest();
    xhr.open("POST", '../addSession');
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(obj));
    xhr.onload = function() {
        if (xhr.status = 200) {
            const rez = JSON.parse(xhr.response);
            console.log(rez);
            const newSessoin = document.querySelector("[data-zal='" + rez[0].cinema_id + "']");

            const newDivS = document.createElement('div');
            newDivS.classList.add('conf-step__seances-movie');
            newDivS.style.backgroundColor = 'salmon';
            let sum = Number(rez[0].duration) * 0.5;
            newDivS.style.width = sum + 'px';
            let str = rez[0].timBegin;
            let l = Number(str.substring(0, 2)) * 60 * 0.5;
            newDivS.style.left = l + 'px';
            newDivS.setAttribute('data-id', rez[0].id);

            const newPS = document.createElement('p');
            newPS.classList.add('conf-step__seances-movie-title');
            newPS.textContent = rez[0].name;
            newPS.setAttribute('data-id', rez[0].id);

            const newPS2 = document.createElement('p');
            newPS2.classList.add('conf-step__seances-movie-start');
            newPS2.textContent = rez[0].timBegin;
            newPS2.setAttribute('data-id', rez[0].id);

            newDivS.appendChild(newPS);
            newDivS.appendChild(newPS2);
            newSessoin.appendChild(newDivS);

        }
    };
    /******** */

    classPropup(newSeccion);
});

openSale.addEventListener('click', function(event) {
    event.preventDefault();
    //  console.log('привет');
    //const obj = {};
    requestWithoutResponse('../openSale', "PUT", null);
});

//вывод окна для удаления сеанса
confStepSeances.addEventListener('click', function(event) {
    const target = event.target;
    if (!target.classList.contains('conf-step__seances-movie') &
        !target.classList.contains('conf-step__seances-movie-title') &
        !target.classList.contains('conf-step__seances-movie-start')) return;
    classPropup(delSessionProp);
    target.classList.add('delSessionOk');
});

//отмена удаления сеанса
canselDelSession.forEach(element => {
    element.addEventListener('click', function(event) {
        event.preventDefault();
        classPropup(delSessionProp);
        target.classList.remove('delSessionOk');
    })
});

//удаление сеанса
delSession.addEventListener('click', function(event) {
    event.preventDefault();
    const vibor = document.querySelector('.delSessionOk')
    const idSession = vibor.getAttribute('data-id');
    requestWithoutResponse('../delSession/' + idSession, "PUT", null);
    //vibor.remove('delSessionOk');
    classPropup(delSessionProp);
    //const divSect = document.querySelector
    // const delSect = document.querySelector("div .conf-step__seances-movie [data-id='" + idSession + "']");
    const delSect = document.querySelector("div .conf-step__seances-movie");
    console.log(delSect);
    // delSect.remove();
    //confStepSeances.replaceChildren(delSect);
    location.reload();
});

/*********удаление фильма */

addSession.addEventListener('contextmenu', function(event) {

    let target = event.target;

    if (target.tagName != 'IMG' & target.tagName != 'H3' &
        target.tagName != 'P') return;

    event.preventDefault();
    /*  event.target.classList.add('viborfilm');
      classPropup(newSeccion);*/
    contextDelOpen.style.left = event.clientX + 'px';
    contextDelOpen.style.top = event.clientY + 'px';
    contextDelOpen.style.display = 'block';

    if (document.querySelector('.viborDelete')) {
        document.querySelector('.viborDelete').remove('viborDelete');
    }

    event.target.classList.add("viborDelete");

});

viborDeleteFilm.addEventListener('click', function(event) {
    const delFilm = document.querySelector('.viborDelete');
    const kod = delFilm.getAttribute('data-id');

    requestWithoutResponse('../delFilm/' + kod, "GET", null);

    delFilm.classList.remove('viborDelete');
    location.reload();
})