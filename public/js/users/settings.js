$(document).ready(function () {
    $('#current_password').on('change', function() {
        verifyCurrentPassword();
    });

    $('#new_password_confirm').on('change', function() {
        verifyNewPassword();
    });

    $('#new_password').on('change', function() {
        verifyNewPassword();
    });

    function verifyCurrentPassword() {
        current_password = $('#new_password').val();

        if(current_password != ''){
            document.getElementById('save').disabled = false;
            $('#message_password').html('');
        }else{
            document.getElementById('save').disabled = true;
            $('#message_password').html('Ingrese su Contraseña Actual');
        }
    }

    function verifyNewPassword() {
        messagePassword = null;
        messageLengthPassword = null;
        current_password = $('#current_password').val();
        new_password = $('#new_password').val();
        new_password_confirm = $('#new_password_confirm').val();

        if(new_password != new_password_confirm && new_password_confirm != '') {
            //alert('Las Contraseñas no coinciden');
            messagePassword = 'Las Contraseñas no coinciden';
        }else{
            messagePassword = '';
        }

        if(new_password.length < 8){
            messageLengthPassword = 'Debe tener al menos 8 caracteres';
        }else{
            messageLengthPassword = '';
        }

        if(messagePassword != '' && messageLengthPassword == '') {
            document.getElementById('save').disabled = true;
            $('#message_new_password').html(messagePassword);
        }else if(messagePassword != '' && messageLengthPassword != '') {
            document.getElementById('save').disabled = true;
            $('#message_new_password').html(messagePassword+' y '+messageLengthPassword);
        }else if(messagePassword == '' && messageLengthPassword != '') {
            document.getElementById('save').disabled = true;
            $('#message_new_password').html(messageLengthPassword);
        }else{
            document.getElementById('save').disabled = false;
            $('#message_new_password').html('');
        }

        if(current_password == ''){
            document.getElementById('save').disabled = true;
            $('#message_password').html('Ingrese su Contraseña Actual');
        }
        
    }

});