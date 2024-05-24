const btn = document.querySelector('.menu');
const text = document.querySelector('.logo');
const list = document.querySelector('.list');
const logo = document.querySelector('.logoLink');
const aloc = document.querySelector('.alocacoes');
const name = document.querySelector('.name');
const pfp = document.querySelector('.pfp');
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
            name.style.opacity = '0';
            aloc.style.opacity = '0';
        }
        else {
            logo.style.opacity = '1';
            home.style.opacity = '1';
            contato.style.opacity = '1';
            ajuda.style.opacity = '1';
            acervo.style.opacity = '1';
            menu.style.width = '13rem';
            aloc.style.opacity = '1';
            name.style.opacity = '1';
        }
    }
)