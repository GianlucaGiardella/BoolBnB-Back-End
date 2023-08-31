document.addEventListener('DOMContentLoaded', () => {

    //Elementi HTML
    const form = document.querySelector('#register');
    const name = document.querySelector('#name');
    const surname = document.querySelector('#surname');
    const birth_date = document.querySelector('#birth_date');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirmPassword');

    //Al submit attiva le validazioni
    form.addEventListener('submit', e => {
        if (!validateForm()) {
            e.preventDefault();
        }
    });

    //Stile e messaggio di errore sotto l'imput
    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    }

    //Stile e messaggio di successo sotto l'imput
    const setSuccess = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    //Verifica email con regex
    const validateEmail = email => {
        const re =
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    //Validazione completa dei campi
    const validateForm = () => {
        let isValid = true;

        const nameValue = name.value.trim();
        const surnameValue = surname.value.trim();
        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();
        const confirmPasswordValue = confirmPassword.value.trim();

        setSuccess(name);
        setSuccess(surname);
        setSuccess(birth_date);

        if (emailValue === '') {
            setError(email, 'Email richiesta');
            isValid = false;
        } else if (emailValue.length < 3) {
            setError(password, 'Minino 8 caratteri');
            isValid = false;
        } else if (emailValue.length > 255) {
            setError(password, 'Massimo 255 caratteri');
            isValid = false;
        } else if (!validateEmail(emailValue)) {
            setError(email, 'Email non valida');
            isValid = false;
        } else {
            setSuccess(email);
        }

        if (passwordValue === '') {
            setError(password, 'Password richiesta');
            isValid = false;
        } else if (passwordValue.length < 8) {
            setError(password, 'Minino 8 caratteri');
            isValid = false;
        } else if (passwordValue.length > 255) {
            setError(password, 'Massimo 255 caratteri');
            isValid = false;
        } else {
            setSuccess(password);
        }

        if (confirmPasswordValue === '') {
            setError(confirmPassword, 'Conferma la password');
            isValid = false;
        } else if (confirmPasswordValue !== passwordValue) {
            setError(confirmPassword, "Le password non corrispondono");
            isValid = false;
        } else {
            setSuccess(confirmPassword);
        }

        return isValid;
    }
});