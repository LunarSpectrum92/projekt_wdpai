
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
        const roles = document.querySelectorAll('.role');
        roles.forEach(role => {
            const card = role.closest('.reservation-card');
            const roleText = role.textContent.trim(); 
            const role1 = roleText.replace('Rola: ', '');
            if (role1 !== roleType) { 
                card.style.display = 'none';
            } else { 
                card.style.display = 'block';
            }
        });
    }

    function checker1(statusType) {
        const statuses = document.querySelectorAll('.status');
        statuses.forEach(status => {
            const card = status.closest('.reservation-card');
            
        

            const statusText = status.textContent.trim(); 
            const status1 = statusText.replace('status wykonania: ', '');
            if (status1 !== statusType) { 
                card.style.display = 'none';
            } else { 
                card.style.display = 'block';

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
