document.addEventListener('DOMContentLoaded', () => {

    //Elementi HTML
    const form = document.querySelector('#form');
    const title = document.querySelector('#title');
    const country = document.querySelector('#country');
    const street = document.querySelector('#street');
    const address = document.querySelector('#address');
    const size = document.querySelector('#size');
    const rooms = document.querySelector('#rooms');
    const beds = document.querySelector('#beds');
    const bathrooms = document.querySelector('#bathrooms');
    const description = document.querySelector('#description');
    const cover = document.querySelector('#cover');
    const removeCover = document.querySelector('#remove-cover');
    const images = document.querySelector('#images');
    const removeImages = document.querySelector('#remove-images');

    const inputs = [title, country, street, address, size, rooms, beds, bathrooms, description, cover, images];

    const minText = 3;
    const maxText = 255;
    const minNumber = 1;
    const maxNumber = 99;
    const maxSize = 9999;
    const maxImages = 5;

    inputs.forEach(x => x.addEventListener('input', () => {
        switch (x) {

            case title:
                if (x.value.trim() === '') {
                    setError(x, 'Campo richiesto');
                } else if (x.value.trim().length < minText) {
                    setError(x, `Il Titolo deve contenere almeno ${minText} caratteri`);
                } else if (x.value.trim().length > maxText) {
                    setError(x, `Il Titolo non può superare i ${maxText} caratteri`);
                } else {
                    setSuccess(x);
                }
                break;

            case country:
                if (x.value.trim() === '') {
                    setError(x, 'Campo richiesto');
                } else if (x.value.trim().length > maxText) {
                    setError(x, `La Nazione non può superare i ${maxText} caratteri`);
                } else {
                    setSuccess(x);
                }
                break;

            case street:
                if (x.value.trim() === '') {
                    setError(street, 'Campo richiesto');
                } else if (x.value.trim().length > maxText) {
                    setError(street, `La Via non può superare i ${maxText} caratteri`);
                } else {
                    setSuccess(street);
                }
                break;

            case address:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo per il Civico: ${minNumber}`);
                } else {
                    setSuccess(x);
                }
                break;

            case size:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo di Metri quadrati: ${minNumber}`);
                } else if (x.value > maxSize) {
                    setError(x, `Numero massimo di Metri quadrati: ${maxSize}`);
                } else {
                    setSuccess(x);
                }
                break;

            case rooms:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo di Camere: ${minNumber}`);
                } else if (x.value > maxNumber) {
                    setError(x, `Numero massimo di Camere: ${maxNumber}`);
                } else {
                    setSuccess(x);
                }
                break;

            case beds:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo di Letti: ${minNumber}`);
                } else if (x.value > maxNumber) {
                    setError(x, `Numero massimo di Letti: ${maxNumber}`);
                } else {
                    setSuccess(x);
                }
                break;

            case bathrooms:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo di Bagni: ${minNumber}`);
                } else if (x.value > maxNumber) {
                    setError(x, `Numero massimo di Bagni: ${maxNumber}`);
                } else {
                    setSuccess(x);
                }
                break;

            case description:
                if (x.value.trim() === '') {
                    setError(description, 'Campo richiesto');
                } else if (x.value.trim().length < minText) {
                    setError(description, `La Descrizione deve contenere almeno ${minText} caratteri`);
                } else {
                    setSuccess(description);
                }
                break;

            case cover:
                if (!x.files[0]) {
                    setError(x, 'Campo richiesto');
                } else {
                    setSuccess(x);
                }
                break;

            case images:
                if (x.files.length > maxImages) {
                    setError(x, `Numero massimo di Immagini: ${maxImages}`);
                } else {
                    setSuccess(x);
                }
                break;

        }
    }))

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

    removeCover.addEventListener('click', () => cover.value = "");
    removeImages.addEventListener('click', () => images.value = "");

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

    //Validazione completa dei campi
    const validateForm = () => {
        let isValid = true;

        const titleValue = title.value.trim();
        const countryValue = country.value.trim();
        const streetValue = street.value.trim();
        const descriptionValue = description.value.trim();
        const sizeValue = size.value;
        const addressValue = address.value;
        const roomsValue = rooms.value;
        const bedsValue = beds.value;
        const bathroomsValue = bathrooms.value;
        const coverValue = cover.files[0];
        const imagesValue = images.files;

        if (titleValue === '') {
            setError(title, 'Campo richiesto');
            isValid = false;
        } else if (titleValue.length < minText) {
            setError(title, `Il Titolo deve contenere almeno ${minText} caratteri`);
            isValid = false;
        } else if (titleValue.length > maxText) {
            setError(title, `Il Titolo non può superare i ${maxText} caratteri`);
            isValid = false;
        } else {
            setSuccess(title);
        }

        if (countryValue === '') {
            setError(country, 'Campo richiesto');
            isValid = false;
        } else if (countryValue.length > maxText) {
            setError(country, `La Nazione non può superare i ${maxText} caratteri`);
            isValid = false;
        } else {
            setSuccess(country);
        }

        if (streetValue === '') {
            setError(street, 'Campo richiesto');
            isValid = false;
        } else if (streetValue.length < minText) {
            setError(street, `La Via deve contenere almeno ${minText} caratteri`);
            isValid = false;
        } else if (streetValue.length > maxText) {
            setError(street, `La Via non può superare i ${maxText} caratteri`);
            isValid = false;
        } else {
            setSuccess(street);
        }

        if (descriptionValue === '') {
            setError(description, 'Campo richiesto');
            isValid = false;
        } else if (descriptionValue.length < minText) {
            setError(description, `La Descrizione deve contenere almeno ${minText} caratteri`);
            isValid = false;
        } else {
            setSuccess(description);
        }

        if (addressValue === '') {
            setError(address, 'Numero richiesto');
            isValid = false;
        } else if (addressValue < minNumber) {
            setError(address, `Numero minimo per il Civico: ${minNumber}`);
            isValid = false;
        } else {
            setSuccess(address);
        }

        if (sizeValue === '') {
            setError(size, 'Numero richiesto');
            isValid = false;
        } else if (sizeValue < minNumber) {
            setError(size, `Numero minimo di Metri quadrati: ${minNumber}`);
            isValid = false;
        } else if (sizeValue > maxSize) {
            setError(size, `Numero massimo di Metri quadrati: ${maxSize}`);
            isValid = false;
        } else {
            setSuccess(size);
        }

        if (roomsValue === '') {
            setError(rooms, 'Numero richiesto');
            isValid = false;
        } else if (roomsValue < minNumber) {
            setError(rooms, `Numero minimo di Camere: ${minNumber}`);
            isValid = false;
        } else if (roomsValue > maxNumber) {
            setError(rooms, `Numero massimo di Camere: ${maxNumber}`);
            isValid = false;
        } else {
            setSuccess(rooms);
        }

        if (bedsValue === '') {
            setError(beds, 'Numero richiesto');
            isValid = false;
        } else if (bedsValue < minNumber) {
            setError(beds, `Numero minimo di Letti: ${minNumber}`);
            isValid = false;
        } else if (bedsValue > maxNumber) {
            setError(beds, `Numero massimo di Letti: ${maxNumber}`);
            isValid = false;
        } else {
            setSuccess(beds);
        }

        if (bathroomsValue === '') {
            setError(bathrooms, 'Numero richiesto');
            isValid = false;
        } else if (bathroomsValue < minNumber) {
            setError(bathrooms, `Numero minimo di Bagni: ${minNumber}`);
            isValid = false;
        } else if (bathroomsValue > maxNumber) {
            setError(bathrooms, `Numero massimo di Bagni: ${maxNumber}`);
            isValid = false;
        } else {
            setSuccess(bathrooms);
        }

        if (!coverValue) {
            setError(cover, 'Campo richiesto');
            isValid = false;
        } else {
            setSuccess(cover);
        }

        if (imagesValue.length > maxImages) {
            setError(images, `Numero massimo di Immagini: ${maxImages}`);
            isValid = false;
        } else {
            setSuccess(images);
        }

        return isValid;
    }
});