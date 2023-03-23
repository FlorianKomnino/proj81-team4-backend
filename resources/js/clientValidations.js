const formElement = document.getElementById('form')
console.log(formElement)

formElement.addEventListener('submit', function (event) {
    event.preventDefault()
})