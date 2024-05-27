const inputFile = document.querySelector('.pfp')
const img = document.querySelector('.personal-avatar')
inputFile.addEventListener('change', event => {
    const url = URL.createObjectURL(event.target.files[0])
    img.src = url
})
