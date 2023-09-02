document.addEventListener('DOMContentLoaded', () => {
    const country = document.querySelector("#country");
    const street = document.querySelector("#street");
    const streetList = document.querySelector("#suggestions-street");

    const urlAllCountries = `https://restcountries.com/v3.1/all`;
    let arrCountries = [];

    fetch(urlAllCountries)
        .then(response => response.json())
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

                option.value = e.cca2;
                option.innerHTML = e.name.common;

                country.addEventListener('change', () => {
                    street.value = "";
                });

                country.appendChild(option);
            });
        })
        .catch(error => {
            console.error(error);
        });

    street.addEventListener('input', () => {
        if (country.value !== "") {

            const query = street.value.trim().replace(" ", "%20");
            const urlStreet = `https://api.tomtom.com/search/2/search/${query}.json?limit=5&countrySet=${country.value}&key=bpAesa0y51fDXlgxGcnRbLEN2X5ghu3R`;
            let arrStreets = [];

            fetch(urlStreet)
                .then(response => response.json())
                .then(data => {
                    arrStreets = data.results;

                    if (arrStreets.length) {
                        streetList.style.display = 'flex';

                        arrStreets.forEach(x => {
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