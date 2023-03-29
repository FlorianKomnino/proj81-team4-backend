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

    // email
    if (!email.value) {
        emailError.innerText = 'L\'email è necessaria'
        emailError.classList.remove('invalid-feedback')
        success = false
    } else {
        let regex = /\S+@\S+\.\S+/;

        if (!regex.test(email.value)) {
            emailError.innerText = 'Email non valida'
            emailError.classList.remove('invalid-feedback')
            success = false
        } else {
            emailError.classList.add('invalid-feedback')
        }
    }

    // password
    if (!password.value) {
        passwordError.innerText = 'Inserisci la tua password'
        passwordError.classList.remove('invalid-feedback')
        success = false
    } else if (password.value.length < 8) {
        passwordError.innerText = 'Inserisci almeno 8 caratteri'
        passwordError.classList.remove('invalid-feedback')
        success = false
    } else {
        passwordError.classList.add('invalid-feedback')
    }

    // confirmPassword
    if (!confirmPassword.value) {
        confirmPasswordError.innerText = 'Conferma la tua password'
        confirmPasswordError.classList.remove('invalid-feedback')
        success = false
    } else if (confirmPassword.value != password.value) {
        confirmPasswordError.innerText = 'Le password non coincidono'
        confirmPasswordError.classList.remove('invalid-feedback')
        passwordError.innerText = 'Le password non coincidono'
        passwordError.classList.remove('invalid-feedback')
        success = false
    } else {
        passwordError.classList.add('invalid-feedback')
        confirmPasswordError.classList.add('invalid-feedback')
    }

    // name
    if (userName.value && userName.value.length < 2) {
        nameError.innerHTML = 'Inserisci almeno 2 caratteri'
        nameError.classList.remove('invalid-feedback')
        success = false
    } else {
        nameError.classList.add('invalid-feedback')
    }

    // surname
    if (userSurname.value && userSurname.value.length < 2) {
        surnameError.innerHTML = 'Inserisci almeno 2 caratteri'
        surnameError.classList.remove('invalid-feedback')
        success = false
    } else {
        surnameError.classList.add('invalid-feedback')
    }

    // birthDate
    if (birthDate.value) {
        let regexp = /^\d{4}-\d{2}-\d{2}$/;
        if (!regexp.test(birthDate.value)) {
            birthDateError.innerText = 'Inserisci una data valida'
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