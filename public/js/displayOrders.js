document.addEventListener("DOMContentLoaded", function() {
    const buttonElems = document.querySelectorAll('.toggleButton');
    
    buttonElems.forEach(buttonElem => {
        buttonElem.addEventListener('click', () => {
            const card = buttonElem.closest('.reservation-card');
            const textElem = card.querySelector('.text');
            const dateElem = card.querySelector('.date');
            
            if (textElem.style.display === 'none' || textElem.style.display === '') {
                textElem.style.display = 'block';
                dateElem.style.display = 'none';
                buttonElem.innerHTML = "<i class='bx bx-chevron-up'></i>";
            } else {
                dateElem.style.display = 'block';
                textElem.style.display = 'none';
                buttonElem.innerHTML = "<i class='bx bx-chevron-down'></i>";
            }
        });
    });
});
