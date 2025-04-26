let arrow = document.querySelector('.arrow-up');

if (arrow) {
    window.addEventListener('scroll', () => {
        if (window.pageYOffset >= arrow.getBoundingClientRect().top) {
            arrow.classList.add('arrow-up--visible')
        } else {
            arrow.classList.remove('arrow-up--visible')
        }
    })    
}

