window.addEventListener('scroll', () => {
    const navEl = document.querySelector('.navbar');
    if (window.scrollY >= 30) {
        navEl.classList.add('navbar-scrolled');
    } else {
        navEl.classList.remove('navbar-scrolled');
    }
});