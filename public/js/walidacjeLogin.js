document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const name = document.getElementById('name');
    const surname = document.getElementById('surname');
    const phone_number = document.getElementById('phone_number');
    const city = document.getElementById('city');
    const street = document.getElementById('street');
    const email = document.getElementById('email');
    const password = document.getElementById('password');
    const repeat_password = document.getElementById('repeat_password');

    const fields = [name, surname, phone_number, city, street, email, password, repeat_password];

    fields.forEach(field => {
        field.addEventListener('input', () => validateField(field));
    });

    function validateField(field) {
        let errorMessage = '';
        field.classList.remove('error');
        removeErrorMessage(field);

        switch (field.id) {
            case 'name':
            case 'surname':
            case 'city':
            case 'street':
                if (field.value.length > 50) {
                    errorMessage = 'This field must be less than 50 characters long.';
                }
                break;
            case 'phone_number':
                if (!/^\d{9}$/.test(field.value)) {
                    errorMessage = 'Phone number must be exactly 9 digits.';
                }
                break;
            case 'email':
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(field.value)) {
                    errorMessage = 'Invalid email format.';
                }
                break;
            case 'password':
                if (!/^(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/.test(field.value)) {
                    errorMessage = 'Password must be at least 8 characters, contain an uppercase letter and a digit.';
                }
                break;
            case 'repeat_password':
                if (field.value !== password.value) {
                    errorMessage = 'Passwords do not match.';
                }
                break;
        }

        if (errorMessage) {
            field.classList.add('error');
            displayErrorMessage(field, errorMessage);
        }
    }

    function displayErrorMessage(field, message) {
        const error = document.createElement('div');
        error.className = 'error-message';
        error.innerText = message;
        field.parentNode.insertBefore(error, field.nextSibling);
    }

    function removeErrorMessage(field) {
        const nextElement = field.nextSibling;
        if (nextElement && nextElement.classList && nextElement.classList.contains('error-message')) {
            nextElement.remove();
        }
    }

    form.addEventListener('submit', (event) => {
        let isValid = true;
        fields.forEach(field => {
            validateField(field);
            if (field.classList.contains('error')) {
                isValid = false;
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });
});