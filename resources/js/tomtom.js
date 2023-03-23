import tt from '@tomtom-international/web-sdk-maps'

import { services } from '@tomtom-international/web-sdk-services';
import SearchBox from '@tomtom-international/web-sdk-plugin-searchbox';

let urlAddress = 'https://api.tomtom.com/search/2/search/';
let positionUrlAddress = 'https://api.tomtom.com/search/2/geometryFilter.json';

// function to make the map appear in the show blade
function map(locationQuery){
    let center = locationQuery
    const map = tt.map({
    key: "jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr",
    container: "map",
    center: center,
    zoom: 12
    })
    map.on('load', () => {
            

            const iconMarker = document.getElementById('marker');
            console.log(iconMarker)
            const popup = new tt.Popup({ anchor: 'top' }).setText('Posizione esatta fornita dopo la prenotazione.')
            let marker = new tt.Marker({element: iconMarker}).setLngLat(center).setPopup(popup).addTo(map);
            marker.addTo(map);

    })
    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());
};

// function to make the input search box of TomTom
function getAddress(){
    if (document.querySelector('.searchBar')){
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
                language: 'it-IT'
            },
            labels: {
                noResultsMessage: 'Nessun risultato trovato'
            },
            distanceFromPoint: '9.192771,45.463273',
            units: 'kilometers'
        }
        const ttSearchBox = new SearchBox(services, option);
        const searchBarContainer = document.querySelector('.searchBar');
        const searchBoxHTML = ttSearchBox.getSearchBoxHTML();
        const inputAddress = document.createElement('input')
        inputAddress.setAttribute('name', 'address')
        inputAddress.classList.add('d-none')
        searchBarContainer.append(inputAddress)
        
        searchBarContainer.append(searchBoxHTML);
        function handleResultSelection(event) {
            inputAddress.setAttribute('value', event.data.result.address.freeformAddress)
            let results = event.data.result.address.freeformAddress;
            let coordinate = results.position;
        };
        ttSearchBox.on("tomtom.searchbox.resultselected", handleResultSelection);
    }
}

window.addEventListener("DOMContentLoaded", (event) => {
    let coordinate = document.getElementsByName('coordinate[]');
    if (coordinate.length>0){
        let k = [];
        for (let i = 0; i < coordinate.length; i++) {
            let a = coordinate[i]['defaultValue'];
            k.push(a)
        }
        let lon = Number(k[0]);
        let lat = Number(k[1]);
        let coordinates = [lon, lat]
        map(coordinates);
    } else {
        getAddress();
    }
});