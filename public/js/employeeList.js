const addAdminButtons = document.querySelectorAll('.add_admin');

function przekaż() {
    const roles = document.querySelectorAll('.role');
    roles.forEach(role => {
        const card = role.closest('.reservation-card');
        const userb1 = card.querySelector('.add_admin'); 
        const userb2 = card.querySelector('.add_employee'); 
        const userb3 = card.querySelector('.delete'); 
        const roleText = role.textContent.trim(); 
        const role1 = roleText.replace('Rola: ', '');
        if (role1 !== 'employee') { 
            card.style.display = 'none';
        } else { 
            card.style.display = 'block';
            userb1.textContent = 'przekaz';
            userb2.style.display = 'none';
            userb3.style.display = 'none';
        }
    });
}

addAdminButtons.forEach(button => {
    button.addEventListener('click', () => {
        console.log("Przekaż do wykonania");
        przekaż();
    });
});
