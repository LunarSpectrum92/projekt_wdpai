
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        const filter = urlParams.get('filter');
        const status = urlParams.get('status');

        if (filter) {
            checker(filter);
        }

        if (status) {
            checker1(status);
        }
    });

    const adminLinks = document.querySelectorAll('.admin-link');
    const clientLinks = document.querySelectorAll('.client-link');
    const employeeLinks = document.querySelectorAll('.employee-link');
    const oczekiwanieLinks = document.querySelectorAll('.oczekiwanie-link');
    const realizacjaLinks = document.querySelectorAll('.realizacja-link');
    const wykonaneLinks = document.querySelectorAll('.wykonane-link');
    const wykonanie = document.querySelectorAll('.wykonanie');
    

    function checker(roleType) {
        const users = document.querySelectorAll('.abc'); // Zmiana na '.abc' aby obejmować kontener użytkownika i jego zamówienia
    
        users.forEach(userContainer => {
            const roleElement = userContainer.querySelector('.role');
            const roleText = roleElement.textContent.trim().replace('Rola: ', '');
    
            if (roleText !== roleType) {
                userContainer.style.display = 'none'; // Ukryj cały kontener użytkownika i jego zamówienia
            } else {
                userContainer.style.display = 'flex'; // Pokaż cały kontener użytkownika i jego zamówienia
            }
        });
    }
    

    function checker1(statusType) {
        const statuses = document.querySelectorAll('.status');
        statuses.forEach(status => {
            const card = status.closest('.reservation-card');
            const a = card.nextElementSibling.firstElementChild;
          
            const statusText = status.textContent.trim(); 
            const status1 = statusText.replace('status wykonania: ', '');
            if (status1 !== statusType) { 
                card.style.display = 'none';
                a.style.display = 'none';

            } else { 
                card.style.display = 'block';
                a.style.display = 'block';

            }
        });
    }






    adminLinks.forEach(adminLink => {
        adminLink.addEventListener('click', () => checker('admin'));
    });

    clientLinks.forEach(clientLink => {
        clientLink.addEventListener('click', () => checker('client'));
    });

    employeeLinks.forEach(employeeLink => {
        employeeLink.addEventListener('click', () => checker('employee'));
    });

    oczekiwanieLinks.forEach(oczekiwanieLink => {
        oczekiwanieLink.addEventListener('click', () => checker1('oczekujące na przyjęcie'));
    });

    realizacjaLinks.forEach(realizacjaLink => {
        realizacjaLink.addEventListener('click', () => checker1('w trakcie realizacji'));
    });

    wykonaneLinks.forEach(wykonaneLink => {
        wykonaneLink.addEventListener('click', () => checker1('wykonane'));
    });
