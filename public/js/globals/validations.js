function mayus(e){
    e.value = e.value.toUpperCase();
}

function minus(e){
    e.value = e.value.toLowerCase();
}

$('.numero').on('input', function () { 
    this.value = this.value.replace(/[^0-9]/g,'');
});

$('.letras').on('input', function () { 
    this.value = this.value.replace(/[^a-zA-Z ]+$/,'');
});

$('.mail').blur('input', function (){ 
    if($(".mail").val().indexOf('@', 0) == -1 || $(".mail").val().indexOf('.', 0) == -1) {
        Swal.fire({
        title: 'Atención',
        text: "El correo electrónico introducido no es válido",
        icon: 'error',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        });
    }
});

$(".upload").change(function() {
    var file = this.files[0];
    var typefile = file.type;
    var match= ["image/jpg", "image/jpeg", "image/png"];
    document.getElementById('submit').disabled = false;
    if(!((typefile == match[0] || typefile == match[1] || typefile == match[2] || typefile == null || typefile == ""))) {
        Swal.fire({
        title: 'Atención',
        text: "Por favor, ingresa un formato de Imágen válido (jpg, jpeg, png)",
        icon: 'error',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        });
        document.getElementById('submit').disabled = true;
        return false;
    }
});