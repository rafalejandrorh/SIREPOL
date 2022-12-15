$('.contrasenna').submit(function(e){
    e.preventDefault();

    Swal.fire({
    title: '¿Estás seguro?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: '¡Sí, estoy seguro!'
    }).then((result) => {
    if (result.value) {
        this.submit();
    }
    })
});