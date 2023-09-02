document.addEventListener('DOMContentLoaded', () => {
    const street = document.querySelector("#street");
    const streetList = document.querySelector("#suggestions-street");

    let arrStreets = [];

    const requestOptions = {
        method: 'GET',
    };

    street.addEventListener('input', () => {

        const query = street.value.trim();

        if (query.length > 2) {
            fetch(`https://api.geoapify.com/v1/geocode/autocomplete?text=${query}&lang=it&apiKey=18cce45cf9f34366aa43ac56c6d85870`, requestOptions)
                .then(response => response.json())
                .then(result => {
                    while (streetList.firstChild) {
                        streetList.removeChild(streetList.firstChild);
                    }

                    arrStreets = result.features

                    if (arrStreets.length) {
                        console.log(arrStreets);
                        streetList.style.display = 'flex';

                        arrStreets.forEach(x => {
                            const li = document.createElement("li");
                            li.className = "list-group-item";
                            li.innerHTML = `${x.properties.formatted}, ${x.properties.country_code.toUpperCase()}`;

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
                })
                .catch(error => console.log('error', error));
        }
    });
});
