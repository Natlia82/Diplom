const elements = document.querySelectorAll('.buying-scheme__chair');
const book = document.querySelector('.acceptin-button');

elements.forEach(element => {
    element.addEventListener('click', function(event) {
        //    console.log(event.target)
        if (event.target.closest('.buying-scheme__chair_standart') || event.target.closest('.buying-scheme__chair_vip') ||
            event.target.closest('.buying-scheme__chair_selected')) {
            event.target.classList.toggle('buying-scheme__chair_selected');
        }
    })
});

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}


book.addEventListener('click', function(event) {
    event.preventDefault();
    // alert("тут");
    let arr = [];
    const nomerB = getRandomInt(999999999);
    const allSelect = document.querySelectorAll('.buying-scheme__chair_selected');
    allSelect.forEach(select => {
        //   console.log(select.getAttribute('data-atr'));
        if (select.getAttribute('data-atr')) {
            arr.push({
                'place_id': select.getAttribute('data-place'),
                'session_id': select.getAttribute('data-s'),
                'price': select.getAttribute('data-summ'),
                'datSession': document.querySelector('.buying__info-start').getAttribute('data-dat'),
                'nomerB': nomerB,
            });
        }

    });
    // console.log(arr);
    const ticket = {
        "place": arr,
        'film': document.querySelector('.buying__info-title').getAttribute('dat-film'),
        'zal': document.querySelector('.buying__info-hall').getAttribute('data-zal'),
    };

    /****** */

    let xhr = new XMLHttpRequest();
    xhr.open("PUT", '../../../../../ticket');
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(JSON.stringify(ticket));
    xhr.onload = function() {
        if (xhr.status = 200) {
            const rez = JSON.parse(xhr.response);
            // console.log(rez[0].nomerB);
            window.location.replace('../../../../../electronicTicket/' + rez[0].nomerB);
        }
    };
    /******** */


});