import tt from '@tomtom-international/web-sdk-maps'

let urlAddress = 'https://api.tomtom.com/search/2/search/';
let positionUrlAddress = 'https://api.tomtom.com/search/2/geometryFilter.json';
let apartmentsList = [
                {
                    position: {
                        lat: 9.165437,
                        lon: 45.464718,
                    }
                },
                {
                    position: {
                    lat: 9.163100,
                    lon: 45.478681,
                    }
                },
                {
                    position: {
                    lat: 9.207381,
                    lon: 45.483141,
                    }
                },
                {
                    position: {
                    lat: 9.677238,
                    lon: 45.698168,
                    }
                },
                {
                    position: {
                    lat: 9.661306,
                    lon: 45.682499,
                    }
                }
            ];

function getHouses() {
    let locationQuery = document.getElementById('locationQuery').value;
    console.log(locationQuery)
    axios.get(urlAddress + `${locationQuery}.json`, {
        params: {
            key: "jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr",
            
        }
    })
    .then((response) => {
        console.log(response)
        let centerCoordinate = response.data.results[0].position;
        let position = `${response.data.results[0].position.lon},${response.data.results[0].position.lat}`;
        axios.get(positionUrlAddress, {
            params: {
                key: "jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr",
                geometryList: JSON.stringify([
                    {
                    type: "CIRCLE",
                    position: position,
                    radius: 10000
                    }
            ]),
            poiList: JSON.stringify(apartmentsList)
        }
        })
        .then((response) => {
            const map = tt.map({
            key: "jEFhMI0rD5tTkGjuW8dYlC2x3UFxNRJr",
            container: "map",
            center: centerCoordinate,
            zoom: 13
            })
            map.on('load', () => {
                /* const MarkerEl = document.createElement("div");
                const iconMarker = document.createElement("div");
                iconMarker.innerHTML(iconMarker);
                MarkerEl.classList.add('marker');
                console.log(MarkerEl); */
                response.data.results.forEach(function (location) {
                    let marker = new tt.Marker().setLngLat([location.position.lat, location.position.lon]).addTo(map) 
                    const popup = new tt.Popup({ anchor: 'top' }).setText('Posizione esatta fornita dopo la prenotazione.')
                    marker.setPopup(popup)
                })
                
            })
            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
        })
        .catch(function (error) {
            console.log(error);
        })
        .finally(function () {

        });
    })
    
};

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
}

window.addEventListener("DOMContentLoaded", (event) => {
    let coordinate = document.getElementsByName('coordinate[]');
    let k = [];
    for (let i = 0; i < coordinate.length; i++) {
        let a = coordinate[i]['defaultValue'];
        k.push(a)
    }
    let lon = Number(k[0]);
    let lat = Number(k[1]);
    let coordinates = [lon, lat]
    map(coordinates);
  });