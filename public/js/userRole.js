const wykonanieButtons = document.querySelectorAll('.add_admin');





wykonanieButtons.forEach(button => {
    button.addEventListener('click', () => {
        const parentReservationCard = button.closest('.reservation-card');
        const aCards = parentReservationCard.nextElementSibling;
        if (aCards && aCards.classList.contains('a')) {
            const reservationCards = aCards.querySelectorAll('.reservation-card');
            if (aCards.style.display === 'none' || aCards.style.display === '') {
                aCards.style.display = 'block';
                reservationCards.forEach(card => {
                    card.style.display = 'block';
                });
            } else {
                aCards.style.display = 'none';
                reservationCards.forEach(card => {
                    card.style.display = 'none';
                });
            }
        }
    });
});

const displayEmployeeOrders = document.querySelectorAll('.display_employee_orders');

displayEmployeeOrders.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault();

        const parentReservationCard = button.closest('.abc');
        const employeeOrders = parentReservationCard.querySelector('.employee-orders');
        const reservationCards = parentReservationCard.querySelectorAll('.employee-orders .reservation-card');

        

        
        reservationCards.forEach(status => {
            const statuses = status.querySelector('.status');
            
            const statusText = statuses.textContent.trim().replace('status wykonania: ', '');
            
            if (statusText === 'wykonane') {
                status.style.backgroundColor = "red"; // Ustawia tło na czerwone dla całego kontenera employee-orders
            }
        });

        if (employeeOrders.style.display === 'none' || employeeOrders.style.display === '') {
            employeeOrders.style.display = 'block'; // Pokaż employee-orders
        } else {
            employeeOrders.style.display = 'none'; // Ukryj employee-orders
        }
    });
});
