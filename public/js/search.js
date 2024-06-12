const search = document.querySelector('.userSearchInput');
const emails =  document.querySelectorAll('.email-address');










search.addEventListener('input', e => {
const value = e.target.value
emails.forEach(em => {
    const card = em.closest('.reservation-card');
    
    const emailText = em.textContent;
    const email = emailText.replace('Adres e_mail: ', '');
    if(!email.includes(value)){
        card.style.display = 'none';
    }else{
        card.style.display = 'block';
    }
});




})