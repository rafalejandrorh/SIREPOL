setInterval(() => {
    const options = {
        method: "GET",
        headers: {
            "Content-Type": "application/json"
        },
    };
    const url = "resenna/verify/"+last_id_resenna;
    const request = fetch(url, options)
        .then(response => response.text())
        .then(data => {
            if(data == 1)
            {
                location.reload();
            }
        });
}, 10000); // 60000 = 60 Segundos

$('.eliminar').submit(function(e){
    e.preventDefault();

    Swal.fire({
    title: '¿Estás seguro?',
    text: "No podrás revertir esta Acción",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
    if (result.value) {
        this.submit();
    }
    })
});