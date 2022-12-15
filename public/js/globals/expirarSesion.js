var timeout;
document.onmousemove = function(){ 
    clearTimeout(timeout); 
    contadorSesion(); //aqui cargamos la funcion de inactividad
} 

function contadorSesion() {
timeout = setTimeout(function () {
        $.confirm({
            title: 'Alerta de Inactividad!',
            content: 'La sesión esta a punto de expirar.',
            autoClose: 'expirar|10000',//cuanto tiempo necesitamos para cerrar la sess automaticamente
            type: 'red',
            icon: 'fa fa-spinner fa-spin',
            buttons: {
                expirar: {
                    text: 'Cerrar Sesión',
                    btnClass: 'btn-red',
                    action: function () {
                        salir();
                    }
                },
                permanecer: function () {
                    contadorSesion(); //reinicia el conteo
                    $.alert('La Sesión ha sido reiniciada!'); //mensaje
                }
            }
        });
    }, 2100000);//2100000 son 35 minutos
}

function salir() {
    $("#logout-formactivar").click();
    //onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  
    // window.location.href = "/login"; //esta función te saca
}