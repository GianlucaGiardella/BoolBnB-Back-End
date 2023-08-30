function createSuggestions(inputElement, suggestionsElement) {
    let suggestionItems = []; // Store created suggestion items

    inputElement.addEventListener('input', function (event) {
        let query = event.target.value;

        fetch(`https://api.tomtom.com/search/2/search/${query}.json?&idxSet=Str&view=Unified&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Request failed');
                }
                return response.json();
            })
            .then(data => {
                let suggestions = data.results;

                // Clear previous suggestions
                while (suggestionsElement.firstChild) {
                    suggestionsElement.removeChild(suggestionsElement.firstChild);
                }
                suggestionItems = [];

                suggestions.forEach(result => {
                    let listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = result.address.freeformAddress;
                    listItem.addEventListener('click', function () {
                        inputElement.value = listItem.textContent;

                        // Clear all suggestions
                        while (suggestionsElement.firstChild) {
                            suggestionsElement.removeChild(suggestionsElement.firstChild);
                        }
                        suggestionItems = [];
                    });
                    suggestionsElement.appendChild(listItem);
                    suggestionItems.push(listItem); // Store the item
                });

                // Add the user's input as a suggestion
                if (inputElement.value.trim() !== '') {
                    let listItem = document.createElement('li');
                    listItem.className = 'list-group-item';
                    listItem.textContent = inputElement.value;
                    listItem.addEventListener('click', function () {
                        inputElement.value = listItem.textContent;

                        // Clear all suggestions
                        while (suggestionsElement.firstChild) {
                            suggestionsElement.removeChild(suggestionsElement.firstChild);
                        }
                        suggestionItems = [];
                    });
                    suggestionsElement.appendChild(listItem);
                    suggestionItems.push(listItem); // Store the item
                }
            })
            .catch(error => {
                console.error('Request failed:', error);
            });
    });
}

// Usage
let inputElement = document.getElementById('street');
let suggestionsElement = document.getElementById('suggestions');

if (inputElement && suggestionsElement) {
    createSuggestions(inputElement, suggestionsElement);
}