const deleteFormElements = document.querySelectorAll('form.form-deleter')

deleteFormElements.forEach((formElement) => {
    formElement.addEventListener('submit', function(event){
        event.preventDefault()
        const confirmPopUp = window.confirm("Are you sure you want to delete this apartment?")
        if(confirmPopUp) this.submit()
    })
})