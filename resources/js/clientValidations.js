const formElement = document.getElementById('form')
const title = document.getElementById('title')
const rooms = document.getElementById('rooms')
const beds = document.getElementById('beds')
const bathrooms = document.getElementById('bathrooms')
const square_meters = document.getElementById('square_meters')
const address = document.getElementById('address')
const services = document.querySelectorAll('input.my-service')
const image = document.getElementById('image')
let atLeastOne = false

console.log(services)


const allowedExtensions = ['.png', '.webp', '.svg', '.jpg', '.jpeg', '.jfif', '.pjpeg', '.pjp', '.gif', '.avif', '.apng', '.bmp', '.ico', '.cur', '.tif', '.tiff']



formElement.addEventListener('submit', function (event) {
    event.preventDefault()

    if (!title.value) {
        console.log('a')
        return
    } else if (title.value.length < 2 || title.value.length > 255) {
        console.log('b')
        return
    }

    if (!rooms.value) {
        console.log('c')
        return
    } else if (rooms.value < 1 || rooms.value > 20) {
        console.log('d')
        return
    }

    if (!beds.value) {
        console.log('e')
        return
    } else if (beds.value < 1 || beds.value > 40) {
        console.log('f')
        return
    }

    if (!bathrooms.value) {
        console.log('g')
        return
    } else if (bathrooms.value < 1 || bathrooms.value > 10) {
        console.log('h')
        return
    }

    if (!square_meters.value) {
        console.log('i')
        return
    } else if (square_meters.value < 4) {
        console.log('l')
        return
    }

    if (!address.value) {
        console.log('m')
        return
    } else if (address.value.length < 2 || address.value.length > 255) {
        console.log('n')
        return
    }

    services.forEach(service => {
        if (service.checked) {
            atLeastOne = true
        }
    });

    if (!atLeastOne) {
        console.log('o')
        return
    }

    this.submit();
})

// const form = document.getElementById('myForm');
// form.addEventListener('submit', function (event) {
//     event.preventDefault();
//     const name = document.getElementById('name').value.trim();
//     const email = document.getElementById('email').value.trim();
//     if (!name) {
//         alert('Inserisci il tuo nome.');
//         return;
//     }
//     if (!email) {
//         alert('Inserisci la tua email.');
//         return;
//     }
//     if (!validateEmail(email)) {
//         alert('Inserisci un indirizzo email valido.');
//         return;
//     }
//     // Se i campi sono validi, invia il form
//     form.submit();
// });
// function validateEmail(email) {
//     const re = /\S+@\S+\.\S+/;
//     return re.test(email);
// }


// if (title.value && title.value.length >= 2 && title.value.length <= 255) {
//     if (rooms.value && rooms.value >= 1 && rooms.value <= 20) {
//         if (beds.value && beds.value >= 1 && beds.value <= 40) {
//             if (bathrooms.value && bathrooms.value >= 1 && bathrooms.value <= 10) {
//                 if (square_meters.value && square_meters.value >= 4) {
//                     if (address.value && address.value.length >= 2 && address.value.length <= 255) {
//                         services.forEach(service => {
//                             if (service.checked) {
//                                 if (!image.value) {
//                                     this.submit()
//                                 } else {
//                                     for (let i = 0; i < allowedExtensions.length; i++) {
//                                         if (image.value.endsWith(allowedExtensions[i])) {
//                                             const imageSize = Math.round(image.files[0].size / 1024 / 1024)
//                                             if (imageSize <= 2) {
//                                                 this.submit()
//                                             }
//                                         }
//                                     }
//                                 }
//                             }
//                         })
//                     }
//                 }
//             }
//         }
//     }
// }