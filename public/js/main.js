document.addEventListener("DOMContentLoaded", () => {
    const slider = document.querySelector('.projects-grid');
    let isDown = false;
    let startX;
    let scrollLeft;
console.log('asd')
    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
console.log('f')

    });

    slider.addEventListener('mouseleave', () => {
        isDown = false;
        slider.classList.remove('active');
console.log('a')

    });

    slider.addEventListener('mouseup', () => {
        isDown = false;
        slider.classList.remove('active');
console.log('s')

    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; //scroll-fast
        slider.scrollLeft = scrollLeft - walk;
console.log('d')

    });
});
