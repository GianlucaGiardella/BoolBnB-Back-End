document.addEventListener('DOMContentLoaded', () => {

    //Elementi HTML
    const form = document.querySelector('#register');
    const name = document.querySelector('#name');
    const surname = document.querySelector('#surname');
    const birthDate = document.querySelector('#birth_date');
    const email = document.querySelector('#email');
    const password = document.querySelector('#password');
    const confirmPassword = document.querySelector('#confirmPassword');

    const inputs = [name, surname, birthDate, email, password, confirmPassword];

    inputs.forEach(x => x.addEventListener('keydown', e => {
        if (e.keyCode === 13) {
            e.preventDefault();
        }
    }));

    inputs.forEach(x => x.addEventListener('input', () => {
        switch (x) {
            case name:
                if (x.value.trim().length > 255) {
                    setError(x, 'Massimo 255 caratteri');
                } else {
                    setSuccess(x);
                }
                break;

            case surname:
                if (x.value.trim().length > 255) {
                    setError(x, 'Massimo 255 caratteri');
                } else {
                    setSuccess(x);
                }
                break;

            case birthDate:
                if (x.value) {
                    setSuccess(x);
                }
                break;

            case email:
                if (x.value.trim() === '') {
                    setError(x, 'Email richiesta');
                } else if (x.value.trim().length < 5) {
                    setError(x, 'Minino 5 caratteri');
                } else if (x.value.trim().length > 255) {
                    setError(x, 'Massimo 255 caratteri');
                } else if (!validateEmail(x.value.trim())) {
                    setError(x, 'Email non valida');
                } else {
                    setSuccess(x);
                }
                break;

            case password:
                if (x.value.trim() === '') {
                    setError(x, 'Password richiesta');
                } else if (x.value.trim().length < 8) {
                    setError(x, 'Minino 8 caratteri');
                } else if (x.value.trim().length > 255) {
                    setError(x, 'Massimo 255 caratteri');
                } else {
                    setSuccess(x);
                }
                break;

            case confirmPassword:
                const passwordValue = password.value.trim();
                if (x.value.trim() === '') {
                    setError(x, 'Conferma la password');
                } else if (x.value.trim() !== passwordValue) {
                    setError(x, "Le password non corrispondono");
                } else {
                    setSuccess(x);
                }
                break;
        }
    }));

    //Al submit attiva le validazioni
    form.addEventListener('submit', e => {
        if (!validateForm()) {
            e.preventDefault();
            window.scrollTo(0, 0);

            form.addEventListener('input', () => {
                validateForm();
            });
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
        const birthDateValue = birthDate.value;
        const emailValue = email.value.trim();
        const passwordValue = password.value.trim();
        const confirmPasswordValue = confirmPassword.value.trim();

        if (nameValue.length > 255) {
            setError(name, 'Massimo 255 caratteri');
            isValid = false;
        } else {
            setSuccess(name);
        }

        if (surnameValue.length > 255) {
            setError(surname, 'Massimo 255 caratteri');
            isValid = false;
        } else {
            setSuccess(surname);
        }

        setSuccess(birthDate);

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