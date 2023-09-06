// Load all the result when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {

    // HTML Elements
    const country = document.querySelector("#country");
    let oldCountry = document.querySelector('#old_country').value;
    const street = document.querySelector('#street');
    const streetList = document.querySelector('#suggestions-street');
    const zip = document.querySelector('#zip');

    // Countries API
    const urlAllCountries = `https://restcountries.com/v3.1/all`;

    // Countries Array
    let arrCountries = [];

    // Suggestions Array
    let arrSuggestions = [];

    country.addEventListener('input', () => {
        if (country.value !== '') {
            street.removeAttribute('disabled');
        } else {
            street.setAttribute('disabled', 'disabled');
        }
    });

    street.addEventListener('input', () => {
        if (street.value !== '') {
            zip.removeAttribute('disabled');
        } else {
            zip.setAttribute('disabled', 'disabled');
        }
    });

    // Fetch request for country
    fetch(urlAllCountries)
        .then(response => {
            if (!response.ok) {
                throw new Error('Request failed');
            }
            return response.json();
        })
        .then(data => {
            arrCountries = data;

            arrCountries.sort((a, b) => {
                const nameA = a.name.common.toLowerCase();
                const nameB = b.name.common.toLowerCase();
                if (nameA < nameB)
                    return -1;
                if (nameA > nameB)
                    return 1;
                return 0;
            });

            arrCountries.forEach(e => {
                const option = document.createElement("option");

                // Set country name & value
                option.value = e.cca2;
                option.text = `${e.name.common}`;

                if (e.cca2 === oldCountry) {
                    option.selected = true;
                }

                // Dropdown option
                country.appendChild(option);
            });

            // Reset street & zip if country change
            country.addEventListener('change', () => {
                street.value = "";
                zip.value = "";
            });

        })
        .catch(error => {
            console.error('Request failed:', error);
        });

    // Create suggestion on input
    if (street && streetList) {
        // Responsive input
        street.addEventListener('input', () => {

            const query = encodeURIComponent(street.value); // Encode the query for the URL

            if (street.value && country.value !== "") {

                const urlStreet = `https://api.tomtom.com/search/2/search/${query}.json?typeahead=true&countrySet=${country.value}&language=it-IT&idxSet=Str&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R`

                fetch(urlStreet)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Request failed');
                        }
                        return response.json();
                    })
                    .then(data => {
                        const suggestions = data.results;

                        // Clear previous suggestions
                        clearSuggestions();

                        // Show Suggestions list
                        streetList.style.display = 'flex';

                        suggestions.forEach(result => {
                            const li = document.createElement('li');
                            li.className = 'list-group-item';
                            li.textContent = result.address.freeformAddress;

                            window.addEventListener('click', e => {
                                if (li.contains(e.target)) {
                                    street.value = li.textContent;
                                    clearSuggestions();
                                } else {
                                    // Hide Suggestions list
                                    streetList.style.display = 'none';
                                }
                            });

                            streetList.appendChild(li);
                            arrSuggestions.push(li);
                        });
                    })
                    .catch(error => {
                        console.error('Request failed:', error);
                    });
            } else {
                clearSuggestions();
            }
        });
    }

    // Function clear suggestions
    function clearSuggestions() {
        while (streetList.firstChild) {
            streetList.removeChild(streetList.firstChild);
        }
        arrSuggestions = [];
    }
});