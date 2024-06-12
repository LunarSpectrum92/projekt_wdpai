document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const filter = urlParams.get('filter');
    if (filter) {
        checker(filter);
    }
});





const adminLinks = document.querySelectorAll('.admin-link');
const clientLinks = document.querySelectorAll('.client-link');
const employeeLinks = document.querySelectorAll('.employee-link');

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

adminLinks.forEach(adminLink => {
    adminLink.addEventListener('click', () => checker('admin'));
});

clientLinks.forEach(clientLink => {
    clientLink.addEventListener('click', () => checker('client'));
});

employeeLinks.forEach(employeeLink => {
    employeeLink.addEventListener('click', () => checker('employee'));
});

