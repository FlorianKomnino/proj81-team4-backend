//Dom elements



const formElement = document.getElementById('form')

const email = document.getElementById('email')
const emailError = document.getElementById('email-error')

const password = document.getElementById('password')
const passwordError = document.getElementById('password-error')

const confirmPassword = document.getElementById('password-confirm')
const confirmPasswordError = document.getElementById('confirmPassword-error')

const userName = document.getElementById('name')
const nameError = document.getElementById('name-error')

const userSurname = document.getElementById('surname')
const surnameError = document.getElementById('surname-error')

const birthDate = document.getElementById('birth_date')
const birthDateError = document.getElementById('birth_date-error')





formElement.addEventListener('submit', function (event) {
    event.preventDefault()
    let success = true

    //single fields validation

    if (!email.value) {
        emailError.classList.remove('invalid-feedback')
        success = false
    } else if (email.value) {
        let regex = /\S+@\S+\.\S+/;

        if (!regex.test(email.value)) {
            console.log("Email non valida");
            emailError.classList.remove('invalid-feedback')
            success = false
        } else {
            emailError.classList.add('invalid-feedback')
        }
    }


    if (!password.value) {
        passwordError.classList.remove('invalid-feedback')
        success = false
        console.log('inserisci la passw')
    }

    if (password.value && password.value.length < 8) {
        passwordError.classList.remove('invalid-feedback')
        success = false
        console.log('8 caratteri minimi')
    }

    if (password.value != confirmPassword.value) {
        passwordError.classList.remove('invalid-feedback')
        confirmPasswordError.classList.remove('invalid-feedback')
        success = false
        console.log('Le password non coincidono')
    }

    if (!confirmPassword.value) {
        confirmPasswordError.classList.remove('invalid-feedback')
        success = false
        console.log('Conferma la passw')
    }

    if (confirmPassword.value != password.value) {
        passwordError.classList.remove('invalid-feedback')
        confirmPasswordError.classList.remove('invalid-feedback')
        success = false
        console.log('le passw non coincidono')
    }

    if (userName.value && userName.value.length < 3) {
        nameError.classList.remove('invalid-feedback')
        success = false
        console.log('le passw non coincidono')
    } else {
        nameError.classList.add('invalid-feedback')
    }

    if (userSurname.value && userSurname.value.length < 3) {
        surnameError.classList.remove('invalid-feedback')
        success = false
        console.log('le passw non coincidono')
    } else {
        surnameError.classList.add('invalid-feedback')
    }

    if (birthDate.value) {
        let regexp = /^\d{4}-\d{2}-\d{2}$/;
        if (!regexp.test(birthDate.value)) {
            console.log("Inserisci una data valida");
            birthDateError.classList.remove('invalid-feedback')
            success = false
        } else {
            birthDateError.classList.add('invalid-feedback')
        }
    }


    if (success) {
        this.submit();
    }
    return
})