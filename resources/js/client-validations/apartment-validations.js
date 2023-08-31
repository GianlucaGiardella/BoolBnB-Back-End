document.addEventListener('DOMContentLoaded', () => {

    //Elementi HTML
    const form = document.querySelector('#create-apartment');
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
    const images = document.querySelector('#images');

    cover.addEventListener('change', () => {
        if (cover.value === '') {
            fileInputLabel.innerHTML = 'Select a file';
        } else {
            const realPathArray = cover.value.split('\\');

            fileInputLabel.innerHTML =
                realPathArray[realPathArray.length - 1];
        }
    });


    //Al submit attiva le validazioni
    form.addEventListener('submit', e => {
        e.preventDefault();

        if (!validateForm()) {
            e.preventDefault();
            window.scrollTo(0, 0);
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

    // function countImages() {
    //     var fileInput = document.getElementById('imageUpload');
    //     var imageCount = fileInput.files.length;

    //     if (imageCount > 5) {
    //         alert('Puoi caricare al massimo 5 immagini');
    //         // Resettare il campo di input per rimuovere le immagini aggiuntive
    //         fileInput.value = '';
    //     }
    // }

    //Validazione completa dei campi
    const validateForm = () => {
        let isValid = true;

        const minText = 3;
        const maxText = 255;
        const minNumber = 1;
        const maxNumber = 99;
        const maxSize = 9999;

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
            setError(address, 'Campo richiesto');
            isValid = false;
        } else if (Number.isInteger(addressValue)) {
            setError(address, 'Deve essere un numero');
            isValid = false;
        } else if (addressValue < minNumber) {
            setError(address, `Numero minimo per il Civico: ${minNumber}`);
            isValid = false;
        } else {
            setSuccess(address);
        }

        if (sizeValue === '') {
            setError(size, 'Campo richiesto');
            isValid = false;
        } else if (Number.isInteger(sizeValue)) {
            setError(size, 'Deve essere un numero');
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
            setError(rooms, 'Campo richiesto');
            isValid = false;
        } else if (Number.isInteger(roomsValue)) {
            setError(rooms, 'Deve essere un numero');
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
            setError(beds, 'Campo richiesto');
            isValid = false;
        } else if (Number.isInteger(bedsValue)) {
            setError(beds, 'Deve essere un numero');
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
            setError(bathrooms, 'Campo richiesto');
            isValid = false;
        } else if (Number.isInteger(bathroomsValue)) {
            setError(bathrooms, 'Deve essere un numero');
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

        // setSuccess(images);

        return isValid;
    }
});