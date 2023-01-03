<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Genero;
use App\Models\Geografia;
use App\Models\Jerarquia;
use App\Models\Estatus_Funcionario;
use App\Models\Person;
use App\Models\Funcionario;
use Alert;
use App\Events\LogsEvent;
use App\Events\TrazasEvent;
use App\Models\Organismos_Seguridad;
use App\Models\Traza_Funcionarios;

class FuncionarioController extends Controller
{
    function __construct()
    {
        $this->middleware('can:funcionarios.index')->only('index');
        $this->middleware('can:funcionarios.create')->only('create');
        $this->middleware('can:funcionarios.show')->only('show');
        $this->middleware('can:funcionarios.edit')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->all();

        if(isset($request->buscador) && is_numeric($request->buscador))
        {
            if($request->tipo_busqueda == 'cedula'){
                $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
                ->select('funcionarios.id', 'funcionarios.id_jerarquia', 'funcionarios.id_estatus', 'funcionarios.credencial',
                'funcionarios.telefono', 'funcionarios.id_person')
                ->Where('persons.cedula', '=', $request->buscador)->paginate(10);

            }else if($request->tipo_busqueda == 'credencial'){
                $funcionarios = Funcionario::Where('funcionarios.credencial', '=', $request->buscador)
                ->select('funcionarios.id', 'funcionarios.id_jerarquia', 'funcionarios.id_estatus', 'funcionarios.credencial',
                'funcionarios.telefono', 'funcionarios.id_person')
                ->paginate(10);

            }else{
                Alert()->warning('Búsqueda no permitida');
                $funcionarios = Funcionario::paginate(10);
            }
        }else if(isset($request->buscador) && is_string($request->buscador)){
            
            if($request->tipo_busqueda == 'jerarquia'){
                $funcionarios = Funcionario::join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
                ->select('funcionarios.id', 'funcionarios.id_jerarquia', 'funcionarios.id_estatus', 'funcionarios.credencial',
                'funcionarios.telefono', 'funcionarios.id_person')
                ->Where('jerarquia.valor', 'ilike', '%'.$request->buscador.'%')->paginate(10);

            }else if($request->tipo_busqueda == 'usuario'){
                $funcionarios = Funcionario::Where('users', 'ilike', '%'.$request->buscador.'%')->paginate(10);

            }else if($request->tipo_busqueda == 'estatus'){
                if($request->buscador == 'activo' || $request->buscador == 'Activo' || $request->buscador == 'ACTIVO'){
                    $status = true;
                }else if($request->buscador == 'inactivo' || $request->buscador == 'Inactivo' || $request->buscador == 'INACTIVO'){
                    $status = false;
                }
                $funcionarios = Funcionario::Where('status', '=', $status)->paginate(10);

            }else if($request->tipo_busqueda == 'nombre'){
                $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
                ->select('funcionarios.id', 'funcionarios.id_jerarquia', 'funcionarios.id_estatus', 'funcionarios.credencial',
                'funcionarios.telefono', 'funcionarios.id_person')
                ->Where('persons.primer_nombre', 'ilike', '%'.$request->buscador.'%')->paginate(10);

            }else if($request->tipo_busqueda == 'apellido'){
                $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
                ->select('funcionarios.id', 'funcionarios.id_jerarquia', 'funcionarios.id_estatus', 'funcionarios.credencial',
                'funcionarios.telefono', 'funcionarios.id_person')
                ->Where('persons.primer_apellido', 'ilike', '%'.$request->buscador.'%')->paginate(10);
            }else{
                Alert()->warning('Búsqueda no permitida');
                $funcionarios = Funcionario::paginate(10);
            }
        }else{
            $funcionarios = Funcionario::paginate(5);
        }
        
        if(isset($request->tipo_busqueda) && isset($request->buscador))
        {
            $id_user = Auth::user()->id;
            $id_Accion = 5; //Búsqueda
            $valores_modificados = 'Tipo de Búsqueda: '.$request->tipo_busqueda.'. Valor Buscado: '.$request->buscador;
            event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Funcionarios'));
        }
        return view('funcionarios.index', ['funcionarios' => $funcionarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genero = Genero::pluck('valor', 'id')->all();
        $jerarquia = Jerarquia::where('id_organismo', 9)->pluck('valor', 'id')->all();
        $organismo = Organismos_Seguridad::pluck('nombre', 'id')->all();
        $organismoPredeterminado = Organismos_Seguridad::where('id', 9)->select('id')->first();
        $estatus = Estatus_Funcionario::pluck('valor', 'id')->all();
        $estado = Geografia::Where('id_padre', 107)->pluck('valor', 'id')->all();
        return view('funcionarios.create',compact('genero', 'jerarquia', 'organismo', 'organismoPredeterminado', 'estatus', 'estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request = $request->all();

        $validacion = Validator::make($request,Funcionario::returnValidations(),Funcionario::returnMessages())->validate();

        $person = new Person();
        $funcionario = new Funcionario();

        $cedula = $request['cedula'];
        $obtener_persona = $person->where('cedula','=',$cedula)->get();
        $validar_persona = $person->where('cedula','=',$cedula)->exists();
        if($validar_persona == true){
            $obtener_funcionario = $funcionario->where('id_person','=',$obtener_persona[0]['id'])->get();
            $validar_funcionario = $funcionario->where('id_person','=',$obtener_persona[0]['id'])->exists();
            if($validar_funcionario == true){
                    Alert()->warning('El funcionario ya se encuentra registrado en el Sistema.', 'No se realizó el registro de la información ingresada');
                    return redirect()->route('funcionarios.index');
            }
        }     

        if($validar_persona == false){

            if($request['cedula'] != null){
                $cedulado = 37;
            }

            $person->id_tipo_documentacion = $cedulado;
            $person->letra_cedula = 'V';
            $person->cedula = $request['cedula'];
            $person->primer_nombre = $request['primer_nombre'];
            $person->segundo_nombre = $request['segundo_nombre'];
            $person->primer_apellido = $request['primer_apellido'];
            $person->segundo_apellido = $request['segundo_apellido'];
            $person->id_genero = $request['id_genero'];
            $person->fecha_nacimiento = $request['fecha_nacimiento'];
            $person->id_estado_nacimiento = $request['id_estado_nacimiento'];
            $person->save();
            $id_person = $person->id;
        }

        $funcionario->credencial = $request['credencial'];
        $funcionario->id_jerarquia = $request['id_jerarquia'];
        $funcionario->telefono = $request['telefono'];
        $funcionario->id_person = isset($id_person) ? $id_person : $obtener_persona[0]['id'];
        $funcionario->id_estatus = $request['id_estatus'];
        $funcionario->id_organismo = $request['id_organismo'];
        $funcionario->save();
        $id_funcionario = $funcionario->id;

        $cedula = isset($request['cedula']) ? $request['cedula'] : $obtener_persona[0]['cedula'];
        $primer_nombre = isset($request['primer_nombre']) ? $request['primer_nombre'] : $obtener_persona[0]['primer_nombre'];
        $segundo_nombre = isset($request['segundo_nombre']) ? $request['segundo_nombre'] : $obtener_persona[0]['segundo_nombre'];
        $primer_apellido = isset($request['primer_apellido']) ? $request['primer_apellido'] : $obtener_persona[0]['primer_apellido'];
        $segundo_apellido = isset($request['segundo_apellido']) ? $request['segundo_apellido'] : $obtener_persona[0]['segundo_apellido'];
        $fecha_nacimiento = isset($request['fecha_nacimiento']) ? $request['fecha_nacimiento'] : $obtener_persona[0]['fecha_nacimiento'];
        $id_genero = isset($request['id_genero']) ? $request['id_genero'] : $obtener_persona[0]['id_genero'];

        $geografia = Geografia::get();
        $estatus_laboral = Estatus_Funcionario::get();
        $jerarquia = Jerarquia::get();
        $generos = Genero::get();

        $genero_for = $generos->Where('id', $id_genero);
        foreach($genero_for as $genero){
            $genero = $genero['valor'];
        }
        $estado_nacimiento_for = $geografia->Where('id', $request['id_estado_nacimiento']);
        foreach($estado_nacimiento_for as $estado_nacimiento){
            $estado_nacimiento = $estado_nacimiento['valor'];
        }
        $id_jerarquia_for = $jerarquia->Where('id', $request['id_jerarquia']);
        foreach($id_jerarquia_for as $jerarquia){
            $jerarquia = $jerarquia['valor'];
        }
        $estatus_laboral_for = $estatus_laboral->Where('id', $request['id_estatus']);
        foreach($estatus_laboral_for as $estatus){
            $estatus_laboral = $estatus['valor'];
        }

        $id_user = Auth::user()->id;
        $id_Accion = 1; //Registro
        $valores_modificados = 'Datos de Funcionario: V'.$cedula.' || '.$primer_nombre.' || '.$segundo_nombre.' || '.$primer_apellido.' || '.
        $segundo_apellido.' || '.$genero.' || '.$fecha_nacimiento.' || '.$estado_nacimiento.' || '.$request['credencial'].' || '.
        $jerarquia.' || '.$request['telefono'].' || '.$estatus_laboral;
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Funcionarios'));

        Alert()->success('Funcionario registrado Satisfactoriamente');
        return redirect()->route('funcionarios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        $id_user = Auth::user()->id;
        $id_Accion = 4; //Visualización
        $valores_modificados = 'Datos de Funcionario: '.
        $funcionario->credencial.' || '.$funcionario->person->letra_cedula.$funcionario->person->cedula.' || '.
        $funcionario->person->primer_nombre.' '.$funcionario->person->segundo_nombre.' '.$funcionario->person->primer_apellido.' '.
        $funcionario->person->segundo_apellido.' || '.$funcionario->jerarquia->valor.' || '.$funcionario->estatus->valor;
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Funcionarios'));

        return view('funcionarios.show', compact('funcionario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {
        $genero = Genero::pluck('valor', 'id')->all();
        $jerarquia = Jerarquia::Where('id_organismo', $funcionario->id_organismo)->pluck('valor', 'id')->all();
        $organismo = Organismos_Seguridad::pluck('nombre', 'id')->all();
        $organismoPredeterminado = Organismos_Seguridad::where('id', $funcionario->id_organismo)->select('id')->first();
        $estatus = Estatus_Funcionario::pluck('valor', 'id')->all();
        $estado = Geografia::Where('id_padre', 107)->pluck('valor', 'id')->all();

        return view('funcionarios.edit', compact('funcionario', 'genero', 'jerarquia', 'organismo', 'organismoPredeterminado', 'estatus', 'estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        
        $funcionarios = Funcionario::Find($id, ['id']);
        $funcionarios->update($request->all());

        $id = $funcionarios->Where('id', $id)->select('id_person')->get();
        foreach($id as $person)
        {
            $id_person = $person['id_person'];
        }
        $personas = Person::Find($id_person, ['id']);
        $personas->update($request->all('primer_nombre', 'segundo_nombre', 'primer_apellido',
        'segundo_apellido', 'id_genero', 'fecha_nacimiento', 'id_estado_nacimiento', 'id_organismo'));
        
        $geografia = Geografia::get();
        $jerarquia = Jerarquia::get();
        $generos = Genero::get();
        $estatus_laboral = Estatus_Funcionario::get();
        $genero_for = $generos->Where('id', $request['id_genero']);
        foreach($genero_for as $genero){
            $genero = $genero['valor'];
        }
        $estado_nacimiento_for = $geografia->Where('id', $request['id_estado_nacimiento']);
        foreach($estado_nacimiento_for as $estado_nacimiento){
            $estado_nacimiento = $estado_nacimiento['valor'];
        }
        $id_jerarquia_for = $jerarquia->Where('id', $request['id_jerarquia']);
        foreach($id_jerarquia_for as $jerarquia){
            $jerarquia = $jerarquia['valor'];
        }
        $estatus_laboral_for = $estatus_laboral->Where('id', $request['id_estatus']);
        foreach($estatus_laboral_for as $estatus){
            $estatus_laboral = $estatus['valor'];
        }

        $id_user = Auth::user()->id;
        $id_Accion = 2; //Actualización
        $valores_modificados = 'Datos de Funcionario: '.
        $request['primer_nombre'].' || '.$request['segundo_nombre'].' || '.$request['primer_apellido'].' || '.
        $request['segundo_apellido'].' || '.$genero.' || '.$request['fecha_nacimiento'].' || '.$estado_nacimiento.' || '.$request['credencial'].' || '.
        $jerarquia.' || '.$request['telefono'].' || '.$estatus_laboral;
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Funcionarios'));
    
        Alert()->success('Usuario Actualizado Satisfactoriamente');
        return redirect()->route('funcionarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->Where('funcionarios.id', $id)->get();

        foreach($funcionarios as $funcionario)
        {
            $cedula = $funcionario['cedula'];
            $primer_nombre = $funcionario['primer_nombre'];
            $segundo_nombre = $funcionario['segundo_nombre'];
            $primer_apellido = $funcionario['primer_apellido'];
            $segundo_apellido = $funcionario['segundo_apellido'];
            $fecha_nacimiento = $funcionario['fecha_nacimiento'];
            $id_estado_nacimiento = $funcionario['id_estado_nacimiento'];
            $id_genero = $funcionario['id_genero'];
            $credencial = $funcionario['credencial'];
            $id_jerarquia = $funcionario['id_jerarquia'];
            $id_estatus = $funcionario['id_estatus'];
            $telefono = $funcionario['telefono'];
        }
        
        $jerarquia = Jerarquia::get();
        $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('nomenclador.jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
        $estatus = Estatus_Funcionario::get();
        $generos = Genero::get();
        $estado_nacimiento = Geografia::get();

        $genero_for = $generos->Where('id', $id_genero);
        foreach($genero_for as $genero){
            $genero = $genero['valor'];
        }
        $jerarquia_for = $jerarquia->Where('id', $id_jerarquia);
        foreach($jerarquia_for as $jerarquia){
            $jerarquia = $jerarquia['valor'];
        }
        $estatus_for = $estatus->Where('id', $id_estatus);
        foreach($estatus_for as $estatus){
            $estatus = $estatus['valor'];
        }
        $estado_for = $estado_nacimiento->Where('id', $id_estado_nacimiento);
        foreach($estado_for as $estado){
            $estado_nacimiento = $estado['valor'];
        }
        
        $id_user = Auth::user()->id;
        $id_Accion = 3; //Eliminación
        $valores_modificados = 'Datos de Funcionario: '.
        'V'.$cedula.' || '.$primer_nombre.' '.$segundo_nombre.' || '.$primer_apellido.' || '.
        $segundo_apellido.' || '.$genero.' || '.$fecha_nacimiento.' || '.$estado_nacimiento.' || '.$credencial.' || '.$jerarquia.' || '.
        $telefono.' || '.$estatus;
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Funcionarios'));

        $funcionarios = Funcionario::find($id);
        $funcionarios->delete();

        return redirect()->route('funcionarios.index')->with('eliminar', 'Ok');
    }

    ////////////////////////////////////////////////////// SERVICIOS DE API //////////////////////////////////////////////////////

    public function SearchFuncionario($parametros)
    {
    
        if($parametros['tipo'] == 'cedula')
        {
            $result['Exist'] = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.cedula', '=', $parametros['valor'])->exists();
            $mensaje_error = 'La Cedula no pertenece a ningun Funcionario';
        }else if($parametros['tipo'] == 'credencial'){
            $result['Exist'] = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('funcionarios.credencial', '=', $parametros['valor'])->exists();
            $mensaje_error = 'Credencial Inexistente';
        }else{
            $result['Exist'] = false;
            $mensaje_error = 'Búsqueda no válida';
        }
        
        if($result['Exist'] == true)
        {
            if($parametros['tipo'] == 'cedula'){
                $result['Query'] = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
                ->join('nomenclador.estatus_funcionario', 'estatus_funcionario.id', '=', 'funcionarios.id_estatus')
                ->join('nomenclador.jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
                ->select('persons.cedula', 'funcionarios.credencial', 'persons.primer_nombre', 
                'persons.segundo_nombre', 'persons.primer_apellido', 'persons.segundo_apellido', 
                'estatus_funcionario.valor as estatus_funcionario', 'jerarquia.valor as jerarquia')
                ->Where('persons.cedula', '=', $parametros['valor'])->first();

            }else if($parametros['tipo'] == 'credencial'){
                $result['Query'] = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
                ->join('nomenclador.estatus_funcionario', 'estatus_funcionario.id', '=', 'funcionarios.id_estatus')
                ->join('nomenclador.jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
                ->select('persons.cedula', 'funcionarios.credencial', 'persons.primer_nombre', 
                'persons.segundo_nombre', 'persons.primer_apellido', 'persons.segundo_apellido', 
                'estatus_funcionario.valor as estatus_funcionario', 'jerarquia.valor as jerarquia')
                ->Where('funcionarios.credencial', '=', $parametros['valor'])->first();
                
            };

            $id_Accion = 5; //Búsqueda
            $valores_modificados = 'Tipo de Búsqueda: '.$parametros['tipo'].'. Valor Buscado: '.$parametros['valor'];
            event(new TrazasEvent($parametros['id_user'], $id_Accion, $valores_modificados, 'Traza_Funcionarios'));

            $response['Funcionario']['Datos'] = array(
                    'Cedula' => "".$result['Query']['cedula']."",
                    'Credencial' => "".$result['Query']['credencial']."",
                    'Nombre Completo' => $result['Query']['primer_nombre'].' '.$result['Query']['segundo_nombre'].
                    ', '.$result['Query']['primer_apellido'].' '.$result['Query']['segundo_apellido'],
                    'Jerarquia' => $result['Query']['jerarquia'],
                    'Estatus' => $result['Query']['estatus_funcionario'],
            );
        }else{
            $response = array(
                'Message' => $mensaje_error
            );
        }
        return $response;
    }

}
