'use strict'

const loginContainer = document.getElementById('loginContainer')

const moveOverlay = () => loginContainer.classList.add('move')
document.getElementById('openCadaster').addEventListener('click', moveOverlay)

const moveBack = () => loginContainer.classList.remove('move')
document.getElementById('openLogin').addEventListener('click', moveBack)