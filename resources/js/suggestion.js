// Load all the result when the DOM is ready
document.addEventListener('DOMContentLoaded', () => {

    // HTML Elements
    const country = document.getElementById("country");
    let oldCountry = document.getElementById('old_country').value;
    const street = document.getElementById('street');
    const streetList = document.getElementById('suggestions-street');
    const civic = document.getElementById('civic');

    // Countrie API
    const urlAllCountries = `https://restcountries.com/v3.1/all`;

    // Array of countries
    let arrCountries = [];

    // Array of suggestions
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
            civic.removeAttribute('disabled');
        } else {
            civic.setAttribute('disabled', 'disabled');
        }
    });

    // Make a request to get the list of all countries
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

                // Set the value and text of the option as the country code and country name
                option.value = e.cca2;
                option.text = `${e.name.common}`;

                if (e.cca2 === oldCountry) {
                    option.selected = true;
                }

                // Add the option to the country dropdown menu
                country.appendChild(option);
            });

            // Reset Street input field at country change
            country.addEventListener('change', () => {
                street.value = "";
                civic.value = "";
            });

        })
        .catch(error => {
            console.error('Request failed:', error);
        });

    // Function to create street suggestions based on user input
    if (street && streetList) {
        // Load the result every time the user types something
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


                        // Add the user's input as a suggestion
                        // if (street.value.trim() !== '') {
                        //     let li = document.createElement('li');
                        //     li.className = 'list-group-item';
                        //     li.textContent = street.value;
                        //     li.addEventListener('click', () => {
                        //         street.value = li.textContent;

                        //         // Clear all suggestions
                        //         clearSuggestions();
                        //     });
                        //     streetList.appendChild(li);
                        //     arrSuggestions.push(li);

                        // }
                    })
                    .catch(error => {
                        console.error('Request failed:', error);
                    });
            } else {
                clearSuggestions();
            }
        });
    }

    // Function to remove all suggestion
    function clearSuggestions() {
        while (streetList.firstChild) {
            streetList.removeChild(streetList.firstChild);
        }
        arrSuggestions = [];
    }

});