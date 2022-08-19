
        <h2 align="center"><b>Reseña policial</b></h2>

        <table border="1" cellspacing="3" cellpadding="3">

            <tr>
                <td><b>Fecha de Reseña</b></td>
                <td>{{date('d/m/Y', strtotime($resenna->fecha_resenna))}}</td>
                <td><b>Estatus de Documentación</b></td>
                <td>{{$resenna->resennado->documentacion->valor}}</td>
                <td><b>Cédula</b></td>
                <td>{{$resenna->resennado->letra_cedula.'-'.$resenna->resennado->cedula}}</td>
            </tr>

            <tr>
                <td><b>Nombres</b></td>
                <td>{{$resenna->resennado->primer_nombre.', '.$resenna->resennado->segundo_nombre}}</td>
                <td><b>Apellidos</b></td>
                <td>{{$resenna->resennado->primer_apellido.', '.$resenna->resennado->segundo_apellido}}</td>
                <td><b>Fecha de Nacimiento</b></td>
                <td>{{date('d/m/Y', strtotime($resenna->resennado->fecha_nacimiento))}}</td>
            </tr>
            
            <tr>
                <td><b>Género</b></td>
                <td>{{$resenna->resennado->genero->valor}}</td>
                <td><b>Tez</b></td>
                <td>{{$resenna->tez->valor}}</td>
                <td><b>Contextura</b></td>
                <td>{{$resenna->contextura->valor}}</td>
            </tr>
            <tr>
                <td><b>Estado Civil</b></td>
                <td>{{$resenna->estado_civil->valor}}</td>
                <td><b>Estado de Nacimiento</b></td>
                <td>{{$resenna->resennado->estado_nacimiento->valor}}</td>
                <td><b>Municipio de Nacimiento</b></td>
                <td>{{$resenna->resennado->municipio_nacimiento->valor}}</td>
            </tr>

            <tr>
                <td><b>Dirección</b></td>
                <td>{{$resenna->direccion}}</td>
                <td><b>Profesión</b></td>
                <td>{{$resenna->profesion->valor}}</td>
                <td><b>Motivo de Reseña</b></td>
                <td>{{$resenna->motivo_resenna->valor}}</td>
            </tr>
            
            <tr>
                <td><b>Funcionario Aprehensor</b></td>
                <td>{{$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido }}</td>
                <td><b>Funcionario que Reseña</b></td>
                <td>{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido }}</td>
            </tr>
            <tr>
                <td><b>Observaciones</b></td>
                <td>{{$resenna->observaciones}}</td>
            </tr>

        </table>  

        <br><br><hr>
        <label for=""><b>Fecha de Reseña</b></label>
        <label for="">{{date('d/m/Y', strtotime($resenna->fecha_resenna))}}</label>
        <br>
        <label for=""><b>Estatus de Documentación</b></label>
        <label type="text">{{$resenna->resennado->documentacion->valor}}</label>
        <label for=""><b>Cédula</b></label>
        <label type="text">{{$resenna->resennado->letra_cedula.'-'.$resenna->resennado->cedula}}</label>
        <br>
        <label><b>Nombres</b></label>
        <label>{{$resenna->resennado->primer_nombre.', '.$resenna->resennado->segundo_nombre}}</label>
        <label><b>Apellidos</b></label>
        <label>{{$resenna->resennado->primer_apellido.', '.$resenna->resennado->segundo_apellido}}</label>
        <br>
        <label><b>Fecha de Nacimiento</b></label>
        <label>{{date('d/m/Y', strtotime($resenna->resennado->fecha_nacimiento))}}</label>
        <label><b>Género</b></label>
        <label>{{$resenna->resennado->genero->valor}}</label>
        <label><b>Tez</b></label>
        <label>{{$resenna->tez->valor}}</label>
        <label><b>Contextura</b></label>
        <label>{{$resenna->contextura->valor}}</label>
        <br>
        <label><b>Estado Civil</b></label>
        <label>{{$resenna->estado_civil->valor}}</label>
        <label><b>Profesión</b></label>
        <label>{{$resenna->profesion->valor}}</label>
        <br>
        <label><b>Estado de Nacimiento</b></label>
        <label>{{$resenna->resennado->estado_nacimiento->valor}}</label>
        <label><b>Municipio de Nacimiento</b></label>
        <label>{{$resenna->resennado->municipio_nacimiento->valor}}</label>
        <br>
        <label><b>Dirección</b></label>
        <label>{{$resenna->direccion}}</label>
        <br>
        <label><b>Motivo de Reseña</b></label>
        <label>{{$resenna->motivo_resenna->valor}}</label>
        <br>
        <label><b>Funcionario Aprehensor</b></label>
        <label>{{$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido }}</label>
        <br>
        <label><b>Funcionario que Reseña</b></label>
        <label>{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido }}</label>
        <br>
        <label><b>Observaciones</b></label>
        <label>{{$resenna->observaciones}}</label>
        