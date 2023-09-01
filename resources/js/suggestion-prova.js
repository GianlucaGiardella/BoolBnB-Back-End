const country = document.querySelector("#country");
const urlAllCountries = `https://restcountries.com/v3.1/all`;

document.addEventListener('DOMContentLoaded', () => {
    let arrCountries = [];

    fetch(urlAllCountries)
        .then(response => response.json())
        .then(data => {
            arrCountries = data;
            arrCountries.forEach(e => {
                const option = document.createElement("option");

                option.value = e.cca2;
                option.innerHTML = e.cca2 + " - " + e.name.official;

                country.appendChild(option);
            });
        })
        .catch(error => {
            console.error(error);
        });
});
