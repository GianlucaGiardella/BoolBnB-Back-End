function createSuggestions(inputElement, suggestionsElement, urlTemplate) {
    inputElement.addEventListener("input", function (event) {
        let query = event.target.value;
        let url = `${urlTemplate.replace(
            "{query}",
            encodeURIComponent(query)
        )}`;

        fetch(url)
            .then((response) => response.json())
            .then((data) => {
                let suggestions = "";

                if (inputElement === inputElementStreet) {
                    suggestions = data.results;
                } else {
                    suggestions = data;
                }

                while (suggestionsElement.firstChild) {
                    suggestionsElement.removeChild(suggestionsElement.firstChild);
                }

                suggestions.forEach((result) => {
                    let listItem = document.createElement("li");
                    listItem.className = "list-group-item";

                    listItem.textContent = "";
                    if (suggestions === data) {
                        listItem.textContent = result.cca2 + " - " + result.name.official;
                    } else {
                        listItem.textContent = result.address.freeformAddress;
                    }

                    listItem.addEventListener("click", function () {
                        inputElement.value = listItem.textContent;
                        // Clear all suggestions
                        while (suggestionsElement.firstChild) {
                            suggestionsElement.removeChild(suggestionsElement.firstChild);
                        }
                    });
                    suggestionsElement.appendChild(listItem); // Aggiungi l'elemento alla lista di suggerimenti
                });

                // Aggiungi anche la suggerimento con l'input dell'utente
                if (inputElement.value.trim() !== "") {
                    let userListItem = document.createElement("li");
                    userListItem.className = "list-group-item";
                    userListItem.textContent = inputElement.value; // aggiunge il testo scritto dall'utente nella lista dei risultati
                    userListItem.addEventListener("click", function () {
                        inputElement.value = userListItem.textContent;

                        // Clear all suggestions
                        while (suggestionsElement.firstChild) {
                            suggestionsElement.removeChild(suggestionsElement.firstChild);
                        }
                    });
                    suggestionsElement.appendChild(userListItem);
                }
            })
            .catch((error) => {
                console.error("Request failed:", error);
            });
    });
}

let inputElementCountry = document.getElementById("country");
let suggestionsElementCountry = document.getElementById("suggestions-country");
let urlCountry = `https://restcountries.com/v3.1/name/{query}`;

if (inputElementCountry && suggestionsElementCountry) {
    createSuggestions(inputElementCountry, suggestionsElementCountry, urlCountry);
}



let inputElementStreet = document.getElementById("street");
let suggestionsElementStreet = document.getElementById("suggestions-street");

inputElementCountry.addEventListener("input", function (event) {
    let countrySliced = event.target.value.slice(0, 2).toUpperCase();
    console.log(countrySliced);
    let urlStreet = `https://api.tomtom.com/search/2/search/{query}.json?countryCode=${countrySliced}&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R`;
    console.log(urlStreet);
    
    // Update the suggestions for street input
    if (inputElementStreet && suggestionsElementStreet) {
        createSuggestions(inputElementStreet, suggestionsElementStreet, urlStreet);
    }
});