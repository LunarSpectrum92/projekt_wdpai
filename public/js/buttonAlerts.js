
const addAdmin = document.querySelectorAll('.add_admin');

const addEmployee = document.querySelectorAll('.add_employee');
const rola = document.querySelectorAll('.role');
const statusElements = document.querySelectorAll('.status');

const Delete = document.querySelectorAll('.delete');



function cheker(){
    var result = confirm('czy jests pewien?');
    
    if(result == false){
        event.preventDefault();
    }
}


addAdmin.forEach(admin =>{
    admin.addEventListener('click', cheker);
}
)



addEmployee.forEach(employee =>{
    employee.addEventListener('click', cheker);
}
)



Delete.forEach(del =>{
    del.addEventListener('click', cheker);
}
)






rola.forEach(role =>{
    const card = role.closest('.reservation-card'); // corrected `role` instead of `em`
    const roleText = role.textContent;
    const role1 = roleText.replace('Rola: ', '');
    if(role1 == 'admin'){
        const addAdminButton = card.querySelector('.add_admin');
        if (addAdminButton) {
            addAdminButton.textContent = 'usun uprawnienia admina';
        }
    }else if(role1 == 'employee'){
        const addAdminButton = card.querySelector('.add_employee'); 
        const displayEmployeeOrders = card.querySelector('.display_employee_orders');
        if (addAdminButton) {
            addAdminButton.textContent = 'usun uprawnienia pracownika';
        }

        if(displayEmployeeOrders){
            displayEmployeeOrders.style.display = 'block';

        }
    }
});







statusElements.forEach(status => {
    const card = status.closest('.reservation-card'); // corrected `role` instead of `em`
    const roleText = status.textContent;
    const role1 = roleText.replace('Rola: ', '');
    if(role1 == 'admin'){
        const addAdminButton = card.querySelector('.add_admin'); // properly selecting the button inside card
        if (addAdminButton) {
            addAdminButton.textContent = 'usun uprawnienia admina';
        }
    }
});



statusElements.forEach(status =>{
    const card = status.closest('.reservation-card'); // corrected `role` instead of `em`
    const roleText = status.textContent;
    const role1 = roleText.replace('status wykonania: ', '');
    if(role1 == 'w trakcie realizacji'){
        const addAdminButton = card.querySelector('.add_admin'); // properly selecting the button inside card
        if (addAdminButton) {
            addAdminButton.style.visibility = 'hidden';
        }
    }else if(role1 == 'wykonane'){
        const addemployeeButton = card.querySelector('.add_employee');
        const addAdminButton = card.querySelector('.add_admin'); 
        if (addAdminButton && addemployeeButton) {
            addAdminButton.style.visibility = 'hidden';
            addemployeeButton.style.visibility = 'hidden';
        }
    }
});
