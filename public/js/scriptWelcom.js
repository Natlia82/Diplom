const datFilm = document.querySelectorAll('.page-nav__day'); //выбор даты показа
const viborSeansa = document.querySelectorAll('.movie-seances__time'); //выбор сеанса
//alert('jjf');
//console.log(datFilm);
datFilm.forEach(element => {
    element.addEventListener('click', function(event) {
        event.preventDefault();

        document.querySelector('.page-nav__day_chosen').classList.remove('page-nav__day_chosen');

        if (event.target.tagName != 'A') {
            const perentA = event.target.parentNode;
            perentA.classList.add('page-nav__day_chosen');
            //  console.log(perentA);
        } else event.target.classList.add('page-nav__day_chosen');

    });
});

viborSeansa.forEach(elemrnt => {
    elemrnt.addEventListener('click', function(event) {
        // event.preventDefault();
        let url = window.location.href;
        console.log(url);
        const dat = document.querySelector('.page-nav__day_chosen').getAttribute('data-dat');
        const zal = event.target.getAttribute('data-Zal');
        const tim = event.target.getAttribute('data-tim');
        const name = event.target.getAttribute('data-fulm');
        //  window.location.href = url + hash;
        let hash = 'user/' + dat + '/cinema/' + zal + '/' + tim + '/' + name;
        event.target.setAttribute('href', hash);

    });
});