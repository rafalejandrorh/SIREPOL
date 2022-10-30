<?php

//Timezone (Hora Local)
define('Ubicacion', 'America/Caracas');

// Métodos del Servicio Disponibles para consultar
define('ConsultaFuncionario', 'ConsultaFuncionario');
define('ConsultaResennado', 'ConsultaResennado');
define('Login', 'Login');
define('Logout', 'Logout');

/////// Permisos de API ////////
define('ConsultarFuncionarios', 'Funcionario:Consultar');
define('ConsultarResennados', 'Resennado:Consultar');

/////// Responses de API ///////

// Ok (Login)
define('OK_CODE_AUTH', 200);
define('OK_DESCRIPTION_AUTH', 'Authentication Ok'); 

// Nok (Logout)
define('ERROR_CODE_AUTH', 401);
define('ERROR_DESCRIPTION_AUTH', 'Authentication Nok'); 

// Ok (Se realiza la consulta)
define('OK_CODE_SERVICE', 200);
define('OK_DESCRIPTION_SERVICE', 'Service Ok'); 

// Nok (Error en el servicio consultado)
define('ERROR_CODE_SERVICE', 404);
define('ERROR_DESCRIPTION_SERVICE', 'Service Nok');

// Nok (Error en el servicio consultado)
define('ERROR_CODE_REQUEST', 405);
define('ERROR_DESCRIPTION_REQUEST', 'Request Nok');

// Ok (Token Ok)
define('OK_CODE_TOKEN', 202);
define('OK_DESCRIPTION_TOKEN', 'Token Ok');

// Nok (Error por Token sin Bearer)
define('ERROR_CODE_NO_TOKEN_BEARER', 405);
define('ERROR_DESCRIPTION_NO_TOKEN_BEARER', 'No Token Bearer');

// Nok (Error por Token Expirado)
define('ERROR_CODE_TOKEN_EXPIRE', 406);
define('ERROR_DESCRIPTION_TOKEN_EXPIRE', 'Token Expire');

// Nok (Error por Token Incorrecto)
define('ERROR_CODE_TOKEN', 407);
define('ERROR_DESCRIPTION_TOKEN', 'Token Nok');

// Nok (Error por no Colocar Token)
define('ERROR_CODE_NO_TOKEN', 408);
define('ERROR_DESCRIPTION_NO_TOKEN', 'No Token');

// Nok (Token Inactivo)
define('ERROR_CODE_INACTIVE_TOKEN', 409);
define('ERROR_DESCRIPTION_INACTIVE_TOKEN', 'Inactive Token');

// Nok (Solicitud Inválida)
define('ERROR_CODE_INVALID_REQUEST', 410);
define('ERROR_DESCRIPTION_INVALID_REQUEST', 'Invalid Request');

// Nok (Servicio Inactivo)
define('ERROR_CODE_INACTIVE_SERVICE', 411);
define('ERROR_DESCRIPTION_INACTIVE_SERVICE', 'Inactive Service');

// Nok (Acción no permitida en el servicio)
define('ERROR_UNAUTHORIZED_ACTION', 401);
define('ERROR_DESCRIPTION_UNAUTHORIZED_ACTION', 'Unauthorized Action');

// Nok (Solicitud No Autorizada)
define('ERROR_CODE_UNAUTHORIZED_SERVICE', 401);
define('ERROR_DESCRIPTION_UNAUTHORIZED_SERVICE', 'Unauthorized Service');

?>