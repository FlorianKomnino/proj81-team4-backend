import tt from '@tomtom-international/web-sdk-maps'

import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

// function to make the map appear in the show blade
function map(coordinates) {
    let center = coordinates
    const map = tt.map({
        key: "jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr",
        container: "map",
        center: center,
        zoom: 12
    })
    map.on('load', () => {
        const iconMarker = document.getElementById('marker');
        const popup = new tt.Popup({ anchor: 'top' }).setText('Posizione esatta fornita dopo la prenotazione.')
        let marker = new tt.Marker({ element: iconMarker }).setLngLat(center).setPopup(popup).addTo(map);
        marker.addTo(map);
    })
    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
};


// function to make the input search box of TomTom
function getAddress() {
    if (document.querySelector('.searchBar')) {
        const option = {
            idleTimePress: 100,
            minNumberOfCharacters: 0,
            searchOptions: {
                key: 'jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr',
                language: 'it-IT',
                limit: 10,
            },
            autocompleteOptions: {
                key: 'jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr',
                language: 'it-IT',
                resultSet: 'category'
            },
            labels: {
                noResultsMessage: 'Nessun risultato trovato'
            },
        }
        const ttSearchBox = new SearchBox(services, option);
        const searchBarContainer = document.querySelector('.searchBar');
        const searchBoxHTML = ttSearchBox.getSearchBoxHTML();
        searchBarContainer.append(searchBoxHTML);
        const inputAddress = document.querySelector('.inputAddress');
        inputAddress.setAttribute('name', 'address');
        inputAddress.setAttribute('id', 'address');
        const oldInput = inputAddress.value;
        const icon = document.querySelector('.tt-search-box-close-icon');
        ttSearchBox.on("tomtom.searchbox.resultselected", handleResultSelection);

        function handleResultSelection(event) {
            if (event.data.result.address.freeformAddress) {
                inputAddress.setAttribute('value', event.data.result.address.freeformAddress)
            }
        };

        // if you click the "X" on the search bar the handleResultSelection's result will be null and the input will have the old value
        icon.addEventListener('click', function () {
            if (oldInput) {
                inputAddress.setAttribute('value', oldInput)
            } else {
                inputAddress.setAttribute('value', '')
            }
        })
    }
}


// this function is used in the show blade (it gives to the input named coordinate[] the latitude and the longitude for the map and it triggers the function map())
// it is used also for the createEditPartialForm beacause it triggers the function getAddress() that show the search bar
window.addEventListener("DOMContentLoaded", (event) => {
    if (document.getElementsByName('coordinate[]')) {
        let coordinates = document.getElementsByName('coordinate[]');
        if (coordinates.length > 0) {
            let k = [];
            for (let i = 0; i < coordinates.length; i++) {
                let a = coordinates[i]['defaultValue'];
                k.push(a)
            }
            let lon = Number(k[0]);
            let lat = Number(k[1]);
            coordinates = [lon, lat]
            map(coordinates);
        }
    }
    if (document.querySelector('.searchBar')) {
        getAddress();
    }
});