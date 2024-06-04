const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
const track = document.querySelector('.track');
const carousel = document.querySelector('.carousel-container').offsetWidth;

next.addEventListener('click', () => {
    track.style.transform = `translateX(-${carousel}px)`;
})

prev.addEventListener('click', () => {
    track.style.transform = `translateX(0)`;
})