const formElement = document.getElementById('form')
const title = document.getElementById('title')
const rooms = document.getElementById('rooms')
const beds = document.getElementById('beds')
const bathrooms = document.getElementById('bathrooms')
const square_meters = document.getElementById('square_meters')
const address = document.getElementById('address')
const services = document.querySelectorAll('input#service')
const image = document.getElementById('image')

const allowedExtensions = ['.png', '.webp', '.svg', '.jpg', '.jpeg', '.jfif', '.pjpeg', '.pjp', '.gif', '.avif', '.apng', '.bmp', '.ico', '.cur', '.tif', '.tiff']







formElement.addEventListener('submit', function (event) {
    event.preventDefault()
    if (title.value && title.value.length >= 2 && title.value.length <= 255) {
        if (rooms.value && rooms.value >= 1 && rooms.value <= 20) {
            if (beds.value && beds.value >= 1 && beds.value <= 40) {
                if (bathrooms.value && bathrooms.value >= 1 && bathrooms.value <= 10) {
                    if (square_meters.value && square_meters.value >= 4) {
                        if (address.value && address.value.length >= 2 && address.value.length <= 255) {
                            services.forEach(service => {
                                if (service.checked) {
                                    for (let i = 0; i < allowedExtensions.length; i++) {
                                        if (image.value.endsWith(allowedExtensions[i])) {
                                            const imageSize = Math.round(image.files[0].size / 1024 / 1024)
                                            if (imageSize <= 2) {
                                                this.submit()
                                            }
                                        }
                                    }
                                }
                            })
                        }
                    }
                }
            }
        }
    }
})