const menu = document.querySelector('.hamburger');
const mobileNav = document.querySelector('.mobile-nav');




menu.addEventListener('click', () => {
    menu.classList.toggle('is-active');
    mobileNav.classList.toggle('is-active');
})
