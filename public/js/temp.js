    document.addEventListener('DOMContentLoaded', () => {
        const services = document.querySelectorAll('.service');
        const a = document.querySelector('body');


        services.forEach(service => {
            service.addEventListener('mouseover', () => {
                console.log(service.backgroundColor);
                a.style.backgroundColor = service.style.backgroundColor;
                services.forEach(s => {
                    if (s !== service) {
                        s.classList.add('fade-out');
                    }
                });
            });

            service.addEventListener('mouseout', () => {
                a.style.backgroundColor = '';
                services.forEach(s => {
                    s.classList.remove('fade-out');
                });
            });
        });
    });
