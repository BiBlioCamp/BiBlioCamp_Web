const prev = document.querySelector('.prev');
const prev2 = document.querySelector('.prev2');
const next = document.querySelector('.next');
const next2 = document.querySelector('.next2');
const track = document.querySelector('.track');
const track2 = document.querySelector('.track2');
let carousel = document.querySelector('.carousel-container').offsetWidth;
let carousel2 = document.querySelector('.border-black').offsetWidth;

window.addEventListener('resize', () => {
    carousel = document.querySelector('.carousel-container').offsetWidth
})
window.addEventListener('resize', () => {
    carousel2 = document.querySelector('.border-black').offsetWidth
})

let index = 0;

next.addEventListener('click', () => {
    index++;
    prev.classList.add('shown');
    track.style.transform = `translateX(-${index * (carousel - 30)}px)`;
    if (track.offsetWidth - (index * (carousel - 30)) < carousel) {
        next.classList.remove('shown');
    }
})

prev.addEventListener('click', () => {
    index--;
    next.classList.add('shown');
    if (index === 0)
        prev.classList.remove('shown');
    track.style.transform = `translateX(-${index * carousel}px`;
})

next2.addEventListener('click', () => {
    index++;
    prev2.classList.add('shown');
    track2.style.transform = `translateX(-${index * (carousel2 - 30)}px)`;
    if (track2.offsetWidth - (index * (carousel - 30)) < carousel) {
        next2.classList.remove('shown');
    }
})

prev2.addEventListener('click', () => {
    index--;
    next2.classList.add('shown');
    if (index === 0)
        prev2.classList.remove('shown');
    track2.style.transform = `translateX(-${index * carousel2}px`;
})