document.addEventListener('DOMContentLoaded', () => {
    const country = document.querySelector("#country");
    const street = document.querySelector("#street");
    const streetList = document.querySelector("#suggestions-street");

    const urlAllCountries = `https://restcountries.com/v3.1/all`;
    let countryID;
    let arrCountries = [];

    fetch(urlAllCountries)
        .then(response => response.json())
        .then(data => {
            arrCountries = data;
            arrCountries.forEach(e => {
                const option = document.createElement("option");

                option.value = e.cca2;
                option.innerHTML = e.cca2 + " - " + e.name.common;

                // option.addEventListener('click', () => {
                //     countryID = option.value;
                // })

                country.addEventListener('change', () => {
                    street.value = "";
                    console.log(country.value)
                });

                country.appendChild(option);
            });
        })
        .catch(error => {
            console.error(error);
        });
    console.log(country.value)

    street.addEventListener('input', () => {
        if (country.value !== "") {

            const query = street.value.trim().replace(" ", "%20");
            const urlStreet = `https://api.tomtom.com/search/2/search/${query}.json?limit=10&countrySet=${country.value}&minFuzzyLevel=1&maxFuzzyLevel=2&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R`;


            fetch(urlStreet)
                .then(response => response.json())
                .then(data => {
                    let arrStreets = [];
                    arrStreets = data.results;

                    if (arrStreets.length) {
                        streetList.style.display = 'flex';

                        arrStreets.forEach(x => {
                            console.log(x.address.countryCode.toLocaleLowerCase());

                            const li = document.createElement("li");
                            li.className = "list-group-item";

                            li.innerHTML = `${x.address.freeformAddress} - ${x.address.countrySubdivision}`;

                            window.addEventListener('click', e => {
                                if (li.contains(e.target)) {
                                    street.value = li.textContent;

                                } else {
                                    streetList.style.display = 'none';
                                }
                            });

                            streetList.appendChild(li);
                        });
                    }

                    console.log(arrStreets)
                })
                .catch(error => {
                    console.error(error);
                });
        }
    });
});
