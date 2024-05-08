const btn = document.querySelector('.menu');
const logo = document.querySelector('.logoLink');
const ajuda = document.querySelector('.ajuda');
const contato = document.querySelector('.contato');
const acervo = document.querySelector('.acervo');
const home = document.querySelector('.home');
const menu = document.querySelector('.left-menu');
const settings = document.getElementById('setting');

btn.addEventListener('click', 
    function () {
        btn.classList.toggle('active');
        if (btn.classList.contains('active')) {
            menu.style.width = '4.6rem';
            home.style.opacity = '0';
            contato.style.opacity = '0';
            ajuda.style.opacity = '0';
            acervo.style.opacity = '0';
            logo.style.opacity = '0';
        }
        else {
            logo.style.opacity = '1';
            home.style.opacity = '1';
            contato.style.opacity = '1';
            ajuda.style.opacity = '1';
            acervo.style.opacity = '1';
            menu.style.width = '13rem';
        }
    }
)