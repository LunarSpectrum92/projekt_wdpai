function validateForm(event) {
    event.preventDefault();

    const serviceSelect = document.querySelector('.services');
    const commentsTextarea = document.querySelector('.comments');
    let errorMessage = '';

    serviceSelect.style.border = '';
    commentsTextarea.style.border = '';


    if (serviceSelect.value === '' || serviceSelect.value === 'Typ usługi') {
        errorMessage += 'Please select a service type.\n';
        serviceSelect.style.border = '1px solid red';
    }


    if (commentsTextarea.value.trim() === '') {
        errorMessage += 'Please provide a description for the service.\n';
        commentsTextarea.style.border = '1px solid red';
    }

    if (errorMessage) {
        alert(errorMessage);
    } else {
        document.getElementById('reservationForm').submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('reservationForm').addEventListener('submit', validateForm);
});
