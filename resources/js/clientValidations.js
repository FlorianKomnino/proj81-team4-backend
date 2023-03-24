//Dom elements
{
    const formElement = document.getElementById('form')
    
    const title = document.getElementById('title')
    const titleError = document.getElementById('title-error')
    
    const rooms = document.getElementById('rooms')
    const roomsError = document.getElementById('rooms-error')
    
    const beds = document.getElementById('beds')
    const bedsError = document.getElementById('beds-error')
    
    const bathrooms = document.getElementById('bathrooms')
    const bathroomsError = document.getElementById('bathrooms-error')
    
    const squareMeters = document.getElementById('square_meters')
    const squareMetersError = document.getElementById('square_meters-error')
    
    const address = document.getElementById('address')
    const addressError = document.getElementById('address-error')
    
    const services = document.querySelectorAll('input.my-service')
    const servicesError = document.getElementById('services-error')
    
    const image = document.getElementById('image')
    const imageError = document.getElementById('image-error')
}
let atLeastOne = false

const allowedExtensions = ['.png', '.webp', '.svg', '.jpg', '.jpeg', '.jfif', '.pjpeg', '.pjp', '.gif', '.avif', '.apng', '.bmp', '.ico', '.cur', '.tif', '.tiff']

// custom validations functions
{
    function isValid(condition, field){
        if (condition) {
            return field.classList.add('invalid-feedback')
        } else {
            return field.classList.remove('invalid-feedback')
        }
    }
    
    function lengthValidation(inputElement, min, max, error){
        inputElement.addEventListener('input', function(){
            isValid((inputElement.value.length >= min && inputElement.value.length <= max), error)
        })
    }
    
    function numberRangeValidation(inputElement, min, max, error){
        inputElement.addEventListener('input', function(){
            isValid((inputElement.value >= min && inputElement.value <= max), error)
        })
    }
}

//interactive validations
{
    lengthValidation(title, 2, 250, titleError)
    numberRangeValidation(rooms, 1, 20, roomsError)
    numberRangeValidation(beds, 1, 40, bedsError)
    numberRangeValidation(bathrooms, 1, 10, bathroomsError)
    numberRangeValidation(squareMeters, 4, 250, squareMetersError)
    lengthValidation(address, 2, 250, addressError)
}

formElement.addEventListener('submit', function (event) {
    event.preventDefault()
    let success = true

    //single fields validation
    {
        if (!title.value) {
            titleError.classList.remove('invalid-feedback')
            success = false
        } else if (title.value.length < 2 || title.value.length > 255) {
            titleError.classList.remove('invalid-feedback')
            success = false
        }
        
        if (!rooms.value) {
            roomsError.classList.remove('invalid-feedback')
            success = false
        } else if (rooms.value < 1 || rooms.value > 20) {
            roomsError.classList.remove('invalid-feedback')
            success = false
        }

        if (!beds.value) {
            bedsError.classList.remove('invalid-feedback')
            success = false
        } else if (beds.value < 1 || beds.value > 40) {
            bedsError.classList.remove('invalid-feedback')
            success = false
        }

        if (!bathrooms.value) {
            bathroomsError.classList.remove('invalid-feedback')
            success = false
        } else if (bathrooms.value < 1 || bathrooms.value > 10) {
            bathroomsError.classList.remove('invalid-feedback')
            success = false
        }

        if (!squareMeters.value) {
            squareMetersError.classList.remove('invalid-feedback')
            success = false

        } else if (squareMeters.value < 4) {
            squareMetersError.classList.remove('invalid-feedback')
            success = false

        }

        if (!address.value) {
            addressError.classList.remove('invalid-feedback')
            success = false

        } else if (address.value.length < 2 || address.value.length > 255) {
            addressError.classList.remove('invalid-feedback')
            success = false

        }

        services.forEach(service => {
            if (service.checked) {
                atLeastOne = true
            }
        });
        
        if (!atLeastOne) {
            servicesError.classList.remove('invalid-feedback')
            success = false
            
        } else {
            servicesError.classList.add('invalid-feedback')
        }
    }
    
    if (success) {
        this.submit();
    }
    return
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