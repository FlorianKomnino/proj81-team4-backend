const formElement = document.getElementById('form')
const title = document.getElementById('title')
const rooms = document.getElementById('rooms')
const beds = document.getElementById('beds')
const bathrooms = document.getElementById('bathrooms')
const square_meters = document.getElementById('square_meters')
const address = document.getElementById('address')
const services = document.getElementById('services')

formElement.addEventListener('submit', function (event) {
    event.preventDefault()
    if (title.value && title.value.length >= 2 && title.value.length <= 255) {
        if (rooms.value && rooms.value >= 1 && rooms.value <= 20) {
            if (beds.value && beds.value >= 1 && beds.value <= 40) {
                if (bathrooms.value && bathrooms.value >= 1 && bathrooms.value <= 10) {
                    if (square_meters.value && square_meters.value >= 4 && square_meters.value <= 10) {
                        if (address.value && address.value.length >= 2 && address.value.length <= 255) {
                            this.submit()
                        }
                    }
                }
            }
        }
    }

})