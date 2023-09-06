document.addEventListener('DOMContentLoaded', () => {

    // Path
    const urlStorage = "http://localhost:8000/storage";
    const noImgPath = "/img/no-img.png";

    // Cover
    const cover = document.querySelector('#cover');
    const oldCover = document.querySelector('#old-cover');
    const addCover = document.querySelector('#add-cover');
    const removeCover = document.querySelector('#remove-cover');

    if (cover.src === urlStorage) {
        cover.src += noImgPath;
    };

    removeCover.addEventListener('click', () => {
        cover.src = urlStorage + noImgPath;
        addCover.value = "";
        oldCover.value = "";
    });

    addCover.addEventListener('change', e => {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = event => {
                cover.src = event.target.result;
            }

            reader.readAsDataURL(file);
        }
    });

    //Images
    const images = document.querySelectorAll('.images');

    images.forEach((img, i) => {
        const image = img.querySelector('.image')
        const oldImage = img.querySelector('.old-image');
        const addImage = img.querySelector(`#add-image${i}`);
        const removeImage = img.querySelector('.remove-image');

        if (image.src === urlStorage) {
            image.src += noImgPath;
        }

        removeImage.addEventListener('click', () => {
            image.src = urlStorage + noImgPath;
            addImage.value = "";
            oldImage.value = "";
        });

        addImage.addEventListener('change', e => {
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();

                reader.onload = event => {
                    image.src = event.target.result;
                }

                reader.readAsDataURL(file);
            }
        });
    })


    //HTML elements
    const form = document.querySelector('#form');
    const title = document.querySelector('#title');
    const country = document.querySelector('#country');
    const street = document.querySelector('#street');
    const zip = document.querySelector('#zip');
    const size = document.querySelector('#size');
    const rooms = document.querySelector('#rooms');
    const beds = document.querySelector('#beds');
    const bathrooms = document.querySelector('#bathrooms');
    const description = document.querySelector('#description');

    const inputs = [title, country, street, zip, size, rooms, beds, bathrooms, description];

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
                    setError(x, `Minimo: ${minText} caratteri`);
                } else if (x.value.trim().length > maxText) {
                    setError(x, `Massimo: ${maxText} caratteri`);
                } else {
                    setSuccess(x);
                }
                break;

            case country:
                if (x.value.trim() === '') {
                    setError(x, 'Campo richiesto');
                } else {
                    setSuccess(x);
                }
                break;

            case street:
                if (x.value.trim() === '') {
                    setError(x, 'Campo richiesto');
                } else if (x.value.trim().length > maxText) {
                    setError(x, `Massimo: ${maxText} caratteri`);
                } else {
                    setSuccess(x);
                }
                break;

            case zip:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo: ${minNumber}`);
                } else {
                    setSuccess(x);
                }
                break;

            case size:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo: ${minNumber}`);
                } else if (x.value > maxSize) {
                    setError(x, `Numero massimo: ${maxSize}`);
                } else {
                    setSuccess(x);
                }
                break;

            case rooms:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo: ${minNumber}`);
                } else if (x.value > maxNumber) {
                    setError(x, `Numero massimo: ${maxNumber}`);
                } else {
                    setSuccess(x);
                }
                break;

            case beds:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo: ${minNumber}`);
                } else if (x.value > maxNumber) {
                    setError(x, `Numero massimo: ${maxNumber}`);
                } else {
                    setSuccess(x);
                }
                break;

            case bathrooms:
                if (x.value === '') {
                    setError(x, 'Numero richiesto');
                } else if (x.value < minNumber) {
                    setError(x, `Numero minimo: ${minNumber}`);
                } else if (x.value > maxNumber) {
                    setError(x, `Numero massimo: ${maxNumber}`);
                } else {
                    setSuccess(x);
                }
                break;

            case description:
                if (x.value.trim() === '') {
                    setError(description, 'Campo richiesto');
                } else if (x.value.trim().length < minText) {
                    setError(description, `Minimo: ${minText} caratteri`);
                } else {
                    setSuccess(description);
                }
                break;
        }
    }))

    //Start full controll
    form.addEventListener('submit', e => {
        if (!validateForm()) {
            e.preventDefault();
            window.scrollTo(0, 0);

            form.addEventListener('input', () => {
                validateForm();
            });
        }
    });

    // Error message & style
    const setError = (element, message) => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');

        errorDisplay.innerText = message;
        inputControl.classList.add('error');
        inputControl.classList.remove('success');
    }

    // Success message & style
    const setSuccess = element => {
        const inputControl = element.parentElement;
        const errorDisplay = inputControl.querySelector('.error');


        errorDisplay.innerText = '';
        inputControl.classList.add('success');
        inputControl.classList.remove('error');
    };

    // Validazions
    const validateForm = () => {
        let isValid = true;

        const titleValue = title.value.trim();
        const countryValue = country.value.trim();
        const streetValue = street.value.trim();
        const zipValue = zip.value;
        const descriptionValue = description.value.trim();
        const sizeValue = size.value;
        const roomsValue = rooms.value;
        const bedsValue = beds.value;
        const bathroomsValue = bathrooms.value;

        if (titleValue === '') {
            setError(title, 'Campo richiesto');
            isValid = false;
        } else if (titleValue.length < minText) {
            setError(title, `Richiesti almeno ${minText} caratteri`);
            isValid = false;
        } else if (titleValue.length > maxText) {
            setError(title, `Massimo ${maxText} caratteri`);
            isValid = false;
        } else {
            setSuccess(title);
        }

        if (countryValue === '') {
            setError(country, 'Campo richiesto');
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
            setError(street, `Massimo ${maxText} caratteri`);
            isValid = false;
        } else {
            setSuccess(street);
        }

        // Zip
        if (zipValue === '') {
            setError(zip, 'Numero richiesto');
            isValid = false;
        } else if (zipValue < minNumber) {
            setError(zip, `Numero minimo: ${minNumber}`);
            isValid = false;
        } else {
            setSuccess(zip);
        }

        // Description
        if (descriptionValue === '') {
            setError(description, 'Campo richiesto');
            isValid = false;
        } else if (descriptionValue.length < minText) {
            setError(description, `Richiesti almeno ${minText} caratteri`);
            isValid = false;
        } else {
            setSuccess(description);
        }

        // Size
        if (sizeValue === '') {
            setError(size, 'Numero richiesto');
            isValid = false;
        } else if (sizeValue < minNumber) {
            setError(size, `Numero minimo: ${minNumber}`);
            isValid = false;
        } else if (sizeValue > maxSize) {
            setError(size, `Numero massimo: ${maxSize}`);
            isValid = false;
        } else {
            setSuccess(size);
        }

        // Rooms
        if (roomsValue === '') {
            setError(rooms, 'Numero richiesto');
            isValid = false;
        } else if (roomsValue < minNumber) {
            setError(rooms, `Numero minimo: ${minNumber}`);
            isValid = false;
        } else if (roomsValue > maxNumber) {
            setError(rooms, `Numero massimo: ${maxNumber}`);
            isValid = false;
        } else {
            setSuccess(rooms);
        }

        // Beds
        if (bedsValue === '') {
            setError(beds, 'Numero richiesto');
            isValid = false;
        } else if (bedsValue < minNumber) {
            setError(beds, `Numero minimo: ${minNumber}`);
            isValid = false;
        } else if (bedsValue > maxNumber) {
            setError(beds, `Numero massimo: ${maxNumber}`);
            isValid = false;
        } else {
            setSuccess(beds);
        }

        // Bathrooms
        if (bathroomsValue === '') {
            setError(bathrooms, 'Numero richiesto');
            isValid = false;
        } else if (bathroomsValue < minNumber) {
            setError(bathrooms, `Numero minimo: ${minNumber}`);
            isValid = false;
        } else if (bathroomsValue > maxNumber) {
            setError(bathrooms, `Numero massimo: ${maxNumber}`);
            isValid = false;
        } else {
            setSuccess(bathrooms);
        }

        return isValid;
    }
});