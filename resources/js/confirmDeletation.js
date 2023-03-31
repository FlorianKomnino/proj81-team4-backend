
const deleteBtns = document.querySelectorAll('form.form-deleter');
function exit(){
    return formDelete.submit();
}
deleteBtns.forEach((formDelete) => {
formDelete.addEventListener('submit', function (event) {
    event.preventDefault();
    Swal.fire({
        title: 'Sei sicuro di voler eliminare questo elemento?',
        text: "Perfavore conferma la tua richiesta !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Annulla',
        confirmButtonText: 'Conferma !'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                position: 'mid',
                icon: 'success',
                title: 'Il tuo elemento è stato eliminato',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                formDelete.submit()
            })
        }
    })
    })
});
