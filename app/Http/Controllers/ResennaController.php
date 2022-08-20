<?php

namespace App\Http\Controllers;

use App\Models\Caracteristicas_Resennado;
use App\Models\Documentacion;
use App\Models\Funcionario;
use App\Models\Resenna;
use App\Models\Genero;
use App\Models\Geografia_Venezuela;
use App\Models\Person;
use App\Models\Traza_Resenna;
use App\ComboDependientes\Nomenclador\NomencladorBase as Nomenclador;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Alert;
use File;



class ResennaController extends Controller
{
    function __construct(Nomenclador $geografia_venezuela)
    {

        $this->geografia_venezuela = $geografia_venezuela;
        $this->middleware('can:resenna.index')->only('index');
        $this->middleware('can:resenna.create')->only('create');
        $this->middleware('can:resenna.show')->only('show');
        $this->middleware('can:resenna.edit')->only('edit', 'update');
        $this->middleware('can:resenna.destroy')->only('destroy');
        $this->middleware('can:resenna.pdf')->only('pdf');
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->all();
        if($request->buscador == null)
        {
            $request->buscador = null;
        }

        if($request->tipo_busqueda == 'cedula_resennado'){
            $resenna = Resenna::join('persons', 'persons.id', '=', 'resenna_detenido.id_person')
            ->Where('persons.cedula', '=', $request->buscador)->paginate(5);

        }else if($request->tipo_busqueda == 'cedula_resenna' || $request->tipo_busqueda == 'cedula_aprehensor'){
            if($request->tipo_busqueda == 'cedula_resenna'){
                $columna = 'id_funcionario_resenna';
            }else if($request->tipo_busqueda == 'cedula_aprehensor'){
                $columna = 'id_funcionario_aprehensor';
            }
            $resenna = Resenna::join('funcionarios', 'funcionarios.id', '=', $columna)
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.cedula', '=', $request->buscador)->paginate(5);

        }else if($request->tipo_busqueda == 'credencial_resenna' || $request->tipo_busqueda == 'credencial_aprehensor'){
            if($request->tipo_busqueda == 'credencial_resenna'){
                $columna = 'id_funcionario_resenna';
            }else if($request->tipo_busqueda == 'credencial_aprehensor'){
                $columna = 'id_funcionario_aprehensor';
            }
            $resenna = Resenna::join('funcionarios', 'funcionarios.id', '=', $columna)
            ->Where('funcionarios.credencial', '=', $request->buscador)->paginate(5);

        }else if($request->tipo_busqueda == 'jerarquia_resenna' || $request->tipo_busqueda == 'jerarquia_aprehensor'){
            if($request->tipo_busqueda == 'jerarquia_resenna'){
                $columna = 'id_funcionario_resenna';
            }else if($request->tipo_busqueda == 'jerarquia_aprehensor'){
                $columna = 'id_funcionario_aprehensor';
            }
            $resenna = Resenna::join('funcionarios', 'funcionarios.id', '=', $columna)
            ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
            ->Where('jerarquia.valor', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'nombre_resennado'){
            $resenna = Resenna::join('persons', 'persons.id', '=', 'resenna_detenido.id_person')
            ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')->paginate(5);

        }else if($request->tipo_busqueda == 'apellido_resennado'){
            $resenna = Resenna::join('persons', 'persons.id', '=', 'resenna_detenido.id_person')
            ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')->paginate(5);

        }else if($request->tipo_busqueda == 'nombre_resenna' || $request->tipo_busqueda == 'nombre_aprehensor'){
            if($request->tipo_busqueda == 'nombre_resenna'){
                $columna = 'id_funcionario_resenna';
            }else if($request->tipo_busqueda == 'nombre_aprehensor'){
                $columna = 'id_funcionario_aprehensor';
            }
            $resenna = Resenna::join('funcionarios', 'funcionarios.id', '=', $columna)
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'apellido_resenna' || $request->tipo_busqueda == 'apellido_aprehensor'){
            if($request->tipo_busqueda == 'apellido_resenna'){
                $columna = 'id_funcionario_resenna';
            }else if($request->tipo_busqueda == 'apellido_aprehensor'){
                $columna = 'id_funcionario_aprehensor';
            }
            $resenna = Resenna::join('funcionarios', 'funcionarios.id', '=', $columna)
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')->paginate(10);
            
        }else if($request->tipo_busqueda == 'motivo_resenna'){
            $resenna = Resenna::join('caracteristicas_resennado', 'caracteristicas_resennado.id', '=', 'resenna_detenido.id_motivo_resenna')
            ->Where('caracteristicas_resennado.valor', 'LIKE', '%'.$request->buscador.'%')->paginate(5);

        }else{
            $resenna = Resenna::orderBy('fecha_resenna', 'desc')->paginate(5);
        }

        return view('resenna.index', ['resennas' => $resenna]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genero = Genero::pluck('valor', 'id')->all();
        $estado_civil = Caracteristicas_Resennado::Where('id_padre', 241)->pluck('valor', 'id')->all();
        $profesion = Caracteristicas_Resennado::Where('id_padre', 234)->pluck('valor', 'id')->all();
        $motivo_resenna = Caracteristicas_Resennado::Where('id_padre', 94)->pluck('valor', 'id')->all();
        $tez = Caracteristicas_Resennado::Where('id_padre', 240)->pluck('valor', 'id')->all();
        $contextura = Caracteristicas_Resennado::Where('id_padre', 243)->pluck('valor', 'id')->all();
        $estado = Geografia_Venezuela::Where('id_padre', 107)->pluck('valor', 'id')->all();
        $municipio = Geografia_Venezuela::Where('id_padre', 108)->pluck('valor', 'id')->all();
        $documentacion = Documentacion::pluck('valor', 'id')->all();

        $estados = $this->geografia_venezuela->combos();

        $funcionario_resenna = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
        ->select('funcionarios.id', 'persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor')->get();
        $funcionario_aprehensor = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
        ->select('funcionarios.id', 'persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor')->get();

        return view('resenna.create', compact('genero', 'estado_civil', 'profesion', 'motivo_resenna', 'tez', 'contextura', 
        'estado', 'estados', 'municipio', 'funcionario_resenna', 'funcionario_aprehensor', 'documentacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        if($request['cedula'] == null){
            $ex = explode('/', $request['fecha_nacimiento']);
            $request['cedula'] = $ex[0].$ex[1].$ex[2].date('s');
        }

        $cedula = $request['cedula'];
        $obtener_persona = Person::where('cedula','=',$cedula)->get();
        $validar_persona = Person::where('cedula','=',$cedula)->exists();

        if($validar_persona == true)
        {
            $resenna = new Resenna();
            $resenna->fecha_resenna = $request->fecha_resenna;
            $resenna->id_person = $obtener_persona[0]['id'];
            $resenna->id_estado_civil = $request->id_estado_civil;
            $resenna->id_profesion = $request->id_profesion;
            $resenna->id_motivo_resenna = $request->id_motivo_resenna;
            $resenna->id_tez = $request->id_tez;
            $resenna->id_contextura = $request->id_contextura;
            $resenna->id_funcionario_aprehensor = $request->id_funcionario_aprehensor;
            $resenna->id_funcionario_resenna = $request->id_funcionario_resenna;
            $resenna->direccion = $request->direccion;
            $resenna->observaciones = $request->observaciones;
            $resenna->save();
            $id_resenna = $resenna->id;

            if($request->hasFile('url_foto')) {
                $imagen = $request->file('url_foto')->store('imagenes/resennados/'.$obtener_persona[0]['id'].'-'.$request->cedula);
            }else{
                if($request->id_genero == '1'){
                    $imagen = 'imagenes/resennados/masculino.png';
                }
                if($request->id_genero == '2'){
                    $imagen = 'imagenes/resennados/femenino.png';
                }
                if($request->id_genero == null){
                    $imagen = 'imagenes/resennados/desconocido.png';
                }
            }
            $resenna = Resenna::find($id_resenna, ['id']);
            $resenna->update(['url_foto' => 'storage/'.$imagen]);

            $caracteristicas_Resennado = Caracteristicas_Resennado::get();
            $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
            $generos = Genero::get();

            $genero_for = $generos->Where('id', $obtener_persona[0]['id_genero']);
            foreach($genero_for as $genero){
                $genero = $genero['valor'];
            }
            $estado_civil_for = $caracteristicas_Resennado->Where('id', $request->id_estado_civil);
            foreach($estado_civil_for as $estado_civil){
                $estado_civil = $estado_civil['valor'];
            }
            $profesion_for = $caracteristicas_Resennado->Where('id', $request->id_profesion);
            foreach($profesion_for as $profesion){
                $profesion = $profesion['valor'];
            }
            $motivo_resenna_for = $caracteristicas_Resennado->Where('id', $request->id_motivo_resenna);
            foreach($motivo_resenna_for as $motivo_resenna){
                $motivo_resenna = $motivo_resenna['valor'];
            }
            $tez_for = $caracteristicas_Resennado->Where('id', $request->id_tez);
            foreach($tez_for as $tez){
                $tez = $tez['valor'];
            }
            $contextura_for = $caracteristicas_Resennado->Where('id', $request->id_contextura);
            foreach($contextura_for as $contextura){
                $contextura = $contextura['valor'];
            }
            $funcionario_aprehensor_for = $funcionarios->Where('funcionarios.id', $request->id_funcionario_aprehensor)->get();
            foreach($funcionario_aprehensor_for as $funcionario_aprehensor){
                $funcionario_aprehensor = $funcionario_aprehensor['valor'].'. '.$funcionario_aprehensor['primer_nombre'].' '.$funcionario_aprehensor['primer_apellido'];
            }
            $funcionario_resenna_for = $funcionarios->Where('funcionarios.id', $request->id_funcionario_resenna)->get();
            // foreach($funcionario_resenna_for as $fun_resenna){
            //     $funcionario_resenna = $fun_resenna['valor'].'. '.$fun_resenna['primer_nombre'].' '.$fun_resenna['primer_apellido'];
            // }
            // $funcionario_resenna.'
            $id_user = Auth::user()->id;
            $id_Accion = 1; //Registro
            $trazas = Traza_Resenna::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
            'valores_modificados' => 'El ciudadano ya posee reseñas en el Sistema. Datos de Reseña: '.
            $request->fecha_resenna.' || '.$obtener_persona[0]['cedula'].' || '.$obtener_persona[0]['primer_nombre'].' || '.
            $obtener_persona[0]['segundo_nombre'].' || '.$obtener_persona[0]['primer_apellido'].' || '.$obtener_persona[0]['segundo_apellido'].' || '.
            $genero.' || '.$obtener_persona[0]['fecha_nacimiento'].' || '.$estado_civil.' || '.$profesion.' || '.$motivo_resenna.' || '.$tez.' || '.$contextura.' || '
            .$funcionario_aprehensor.' || '.$request->direccion.' || '.$request->observaciones.' || '.$imagen]);

            Alert()->success('Reseña creada Satisfactoriamente','Atención: El ciudadano ya posee reseñas en el Sistema!');
            return redirect()->route('resenna.index');  

        }else if($validar_persona == false)
        {
            $persona = new Person();
            $persona->id_tipo_documentacion = $request->id_tipo_documentacion;
            $persona->letra_cedula = $request->letra_cedula;
            $persona->cedula = $request->cedula;
            $persona->primer_nombre = $request->primer_nombre;
            $persona->segundo_nombre = $request->segundo_nombre;
            $persona->primer_apellido = $request->primer_apellido;
            $persona->segundo_apellido = $request->segundo_apellido;
            $persona->id_genero = $request->id_genero;
            $persona->fecha_nacimiento = $request->fecha_nacimiento;
            $persona->id_estado_nacimiento = $request->id_estado_nacimiento;
            $persona->id_municipio_nacimiento = $request->id_municipio_nacimiento;
            $persona->save();
            $id_person = $persona->id;

            $resenna = new Resenna();
            $resenna->fecha_resenna = $request->fecha_resenna;
            $resenna->id_person = $id_person;
            $resenna->id_estado_civil = $request->id_estado_civil;
            $resenna->id_profesion = $request->id_profesion;
            $resenna->id_motivo_resenna = $request->id_motivo_resenna;
            $resenna->id_tez = $request->id_tez;
            $resenna->id_contextura = $request->id_contextura;
            $resenna->id_funcionario_aprehensor = $request->id_funcionario_aprehensor;
            $resenna->id_funcionario_resenna = $request->id_funcionario_resenna;
            $resenna->direccion = $request->direccion;
            $resenna->observaciones = $request->observaciones;
            $resenna->save();
            $id_resenna = $resenna->id;

            if($request->hasFile('url_foto')) {
                $imagen = $request->file('url_foto')->store('imagenes/resennados/'.$id_person.'-'.$request->cedula);
            }else{
                if($request->id_genero == '1'){
                    $imagen = 'imagenes/resennados/masculino.png';
                }
                if($request->id_genero == '2'){
                    $imagen = 'imagenes/resennados/femenino.png';
                }
                if($request->id_genero == null){
                    $imagen = 'imagenes/resennados/desconocido.png';
                }
            }
            $resenna = Resenna::find($id_resenna, ['id']);
            $resenna->update(['url_foto' => 'storage/'.$imagen]);

            $caracteristicas_Resennado = Caracteristicas_Resennado::get();
            $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
            $funcionarios_resenna = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
            $generos = Genero::get();

            $genero_for = $generos->Where('id', $request->id_genero);
            foreach($genero_for as $genero){
                $genero = $genero['valor'];
            }
            $estado_civil_for = $caracteristicas_Resennado->Where('id', $request->id_estado_civil);
            foreach($estado_civil_for as $estado_civil){
                $estado_civil = $estado_civil['valor'];
            }
            $profesion_for = $caracteristicas_Resennado->Where('id', $request->id_profesion);
            foreach($profesion_for as $profesion){
                $profesion = $profesion['valor'];
            }
            $motivo_resenna_for = $caracteristicas_Resennado->Where('id', $request->id_motivo_resenna);
            foreach($motivo_resenna_for as $motivo_resenna){
                $motivo_resenna = $motivo_resenna['valor'];
            }
            $tez_for = $caracteristicas_Resennado->Where('id', $request->id_tez);
            foreach($tez_for as $tez){
                $tez = $tez['valor'];
            }
            $contextura_for = $caracteristicas_Resennado->Where('id', $request->id_contextura);
            foreach($contextura_for as $contextura){
                $contextura = $contextura['valor'];
            }
            $funcionario_aprehensor_for = $funcionarios->Where('funcionarios.id', $request->id_funcionario_aprehensor)->get();
            foreach($funcionario_aprehensor_for as $fun_aprehensor){
                $funcionario_aprehensor = $fun_aprehensor['valor'].'. '.$fun_aprehensor['primer_nombre'].' '.$fun_aprehensor['primer_apellido'];
            }
            $funcionario_resenna_for = $funcionarios_resenna->Where('funcionarios.id', $request->id_funcionario_resenna)->get();
            foreach($funcionario_resenna_for as $fun_resenna){
                $funcionario_resenna = $fun_resenna['valor'].'. '.$fun_resenna['primer_nombre'].' '.$fun_resenna['primer_apellido'];
            }

            $id_user = Auth::user()->id;
            $id_Accion = 1; //Registro
            $trazas = Traza_Resenna::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
            'valores_modificados' => 'Datos de Reseña: '.
            $request->fecha_resenna.' || '.$request->cedula.' || '.$request->primer_nombre.' '.$request->segundo_nombre.' || '.
            $request->primer_apellido.' || '.$request->segundo_apellido.' || '.$request->fecha_nacimiento.' || '.$genero.' || '.$estado_civil.' || '.$profesion.' || '.$motivo_resenna.' || '.
            $tez.' || '.$contextura.' || '.$funcionario_aprehensor.' || '.$funcionario_resenna.' || '.$request->direccion.' || '.$request->observaciones.' || '.$imagen]);

            Alert()->success('Reseña creada Satisfactoriamente','Ciudadano: '.$request->primer_nombre.' '.$request->primer_apellido.
            '. Portador de la Cédula de Identidad:'.$request->cedula);
            return redirect()->route('resenna.index');

        };

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Resenna $resenna)
    {
        return view('resenna.show', compact('resenna'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Resenna $resenna)
    {
        $genero = Genero::pluck('valor', 'id')->all();
        $estado_civil = Caracteristicas_Resennado::Where('id_padre', 241)->pluck('valor', 'id')->all();
        $profesion = Caracteristicas_Resennado::Where('id_padre', 234)->pluck('valor', 'id')->all();
        $motivo_resenna = Caracteristicas_Resennado::Where('id_padre', 94)->pluck('valor', 'id')->all();
        $tez = Caracteristicas_Resennado::Where('id_padre', 240)->pluck('valor', 'id')->all();
        $contextura = Caracteristicas_Resennado::Where('id_padre', 243)->pluck('valor', 'id')->all();
        $estado = Geografia_Venezuela::Where('id_padre', 107)->pluck('valor', 'id')->all();
        $municipio = Geografia_Venezuela::Where('id_padre', 108)->pluck('valor', 'id')->all();
        $documentacion = Documentacion::pluck('valor', 'id')->all();
        $funcionario_resenna = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
        ->select('funcionarios.id', 'persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor')->get();
        $funcionario_aprehensor = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
        ->select('funcionarios.id', 'persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor')->get();

        return view('resenna.edit', compact('genero', 'estado_civil', 'profesion', 'motivo_resenna', 'tez', 'contextura', 
        'estado', 'municipio', 'funcionario_resenna', 'funcionario_aprehensor', 'documentacion', 'resenna'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $person = Resenna::join('persons', 'persons.id', '=', 'resenna_detenido.id_person')
        ->Where('resenna_detenido.id', $id)->select('persons.id')->get();
        foreach($person as $per)
        {
            $id_person = $per['id'];
        }

        if($request->hasFile('url_foto')) {
            $imagen = $request->file('url_foto')->store('imagenes/resennados/'.$id_person.'-'.$request->cedula);
            
        }else{
            $imagen = null;
        }

        if($imagen != null)
        {
            $resenna = Resenna::find($id, ['id']);
            $resenna->update(['url_foto' => 'storage/'.$imagen]);
        }

        $resenna = Resenna::find($id, ['id']);
        $resenna->update($request->all('fecha_resenna', 'id_estado_civil', 'id_profesion', 'id_motivo_resenna', 'id_tez', 
        'id_contextura', 'id_funcionario_aprehensor', 'id_funcionario_resenna', 'direccion', 'observaciones'));
        $persona = Person::find($id_person, ['id']);
        $persona->update($request->all('id_tipo_documentacion', 'letra_cedula', 'cedula', 'primer_nombre', 
        'segundo_nombre', 'primer_apellido','segundo_apellido', 'id_genero', 'fecha_nacimiento', 'id_estado_nacimiento',
        'id_municipio_nacimiento'));

        $caracteristicas_Resennado = Caracteristicas_Resennado::get();
        $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
        $funcionarios_resenna = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
        $generos = Genero::get();

        $genero_for = $generos->Where('id', $request->id_genero);
        foreach($genero_for as $genero){
            $genero = $genero['valor'];
        }
        $estado_civil_for = $caracteristicas_Resennado->Where('id', $request->id_estado_civil);
        foreach($estado_civil_for as $estado_civil){
            $estado_civil = $estado_civil['valor'];
        }
        $profesion_for = $caracteristicas_Resennado->Where('id', $request->id_profesion);
        foreach($profesion_for as $profesion){
            $profesion = $profesion['valor'];
        }
        $motivo_resenna_for = $caracteristicas_Resennado->Where('id', $request->id_motivo_resenna);
        foreach($motivo_resenna_for as $motivo_resenna){
            $motivo_resenna = $motivo_resenna['valor'];
        }
        $tez_for = $caracteristicas_Resennado->Where('id', $request->id_tez);
        foreach($tez_for as $tez){
            $tez = $tez['valor'];
        }
        $contextura_for = $caracteristicas_Resennado->Where('id', $request->id_contextura);
        foreach($contextura_for as $contextura){
            $contextura = $contextura['valor'];
        }
        $funcionario_aprehensor_for = $funcionarios->Where('funcionarios.id', $request->id_funcionario_aprehensor)->get();
        foreach($funcionario_aprehensor_for as $funcionario_aprehensor){
            $funcionario_aprehensor = $funcionario_aprehensor['valor'].'. '.$funcionario_aprehensor['primer_nombre'].' '.$funcionario_aprehensor['primer_apellido'];
        }
        $funcionario_resenna_for = $funcionarios_resenna->Where('funcionarios.id', $request->id_funcionario_resenna)->get();
        foreach($funcionario_resenna_for as $fun_resenna){
            $funcionario_resenna = $fun_resenna['valor'].'. '.$fun_resenna['primer_nombre'].' '.$fun_resenna['primer_apellido'];
        }

        $id_user = Auth::user()->id;
        $id_Accion = 2; //Actualización
        $trazas = Traza_Resenna::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
        'valores_modificados' => 'Datos de Reseña: '.
        $request->fecha_resenna.' || '.$request->cedula.' || '.$request->primer_nombre.' '.$request->segundo_nombre.' || '.
        $request->primer_apellido.' || '.$request->segundo_apellido.' || '.$request->fecha_nacimiento.' || '.$genero.' || '.$estado_civil.' || '.$profesion.' || '.$motivo_resenna.' || '.
        $tez.' || '.$contextura.' || '.$funcionario_aprehensor.' || '.$funcionario_resenna.' || '.$request->direccion.' || '.$request->observaciones.' || '.$imagen]);

        Alert()->success('Reseña Actualizada Satisfactoriamente');
        return redirect()->route('resenna.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resennas = Resenna::join('persons', 'persons.id', '=', 'resenna_detenido.id_person')
        ->Where('resenna_detenido.id', $id)->get();

        foreach($resennas as $resenna)
        {
            $fecha_resenna = $resenna['fecha_resenna'];
            $cedula = $resenna['cedula'];
            $primer_nombre = $resenna['primer_nombre'];
            $segundo_nombre = $resenna['segundo_nombre'];
            $primer_apellido = $resenna['primer_apellido'];
            $segundo_apellido = $resenna['segundo_apellido'];
            $fecha_nacimiento = $resenna['fecha_nacimiento'];
            $id_genero = $resenna['id_genero'];
            $id_estado_civil = $resenna['id_estado_civil'];
            $id_profesion = $resenna['id_profesion'];
            $id_motivo_resenna = $resenna['id_motivo_resenna'];
            $id_tez = $resenna['id_tez'];
            $id_contextura = $resenna['id_contextura'];
            $id_funcionario_aprehensor = $resenna['id_funcionario_aprehensor'];
            $id_funcionario_resenna = $resenna['id_funcionario_resenna'];
            $direccion = $resenna['direccion'];
            $observaciones = $resenna['observaciones'];
            $imagen = $resenna['url_foto'];
        }
        
        $caracteristicas_Resennado = Caracteristicas_Resennado::get();
        $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
        $funcionarios_resenna = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
        $caracteristicas_Resennado = Caracteristicas_Resennado::get();
        $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia');
        $generos = Genero::get();

        $genero_for = $generos->Where('id', $id_genero);
        foreach($genero_for as $genero){
            $genero = $genero['valor'];
        }
        $estado_civil_for = $caracteristicas_Resennado->Where('id', $id_estado_civil);
        foreach($estado_civil_for as $estado_civil){
            $estado_civil = $estado_civil['valor'];
        }
        $profesion_for = $caracteristicas_Resennado->Where('id', $id_profesion);
        foreach($profesion_for as $profesion){
            $profesion = $profesion['valor'];
        }
        $motivo_resenna_for = $caracteristicas_Resennado->Where('id', $id_motivo_resenna);
        foreach($motivo_resenna_for as $motivo_resenna){
            $motivo_resenna = $motivo_resenna['valor'];
        }
        $tez_for = $caracteristicas_Resennado->Where('id', $id_tez);
        foreach($tez_for as $tez){
            $tez = $tez['valor'];
        }
        $contextura_for = $caracteristicas_Resennado->Where('id', $id_contextura);
        foreach($contextura_for as $contextura){
            $contextura = $contextura['valor'];
        }
        $funcionario_aprehensor_for = $funcionarios->Where('funcionarios.id', $id_funcionario_aprehensor)->get();
        foreach($funcionario_aprehensor_for as $funcionario_aprehensor){
            $funcionario_aprehensor = $funcionario_aprehensor['valor'].'. '.$funcionario_aprehensor['primer_nombre'].' '.$funcionario_aprehensor['primer_apellido'];
        }
        $funcionario_resenna_for = $funcionarios_resenna->Where('funcionarios.id', $id_funcionario_resenna)->get();
        foreach($funcionario_resenna_for as $fun_resenna){
            $funcionario_resenna = $fun_resenna['valor'].'. '.$fun_resenna['primer_nombre'].' '.$fun_resenna['primer_apellido'];
        }
        
        $id_user = Auth::user()->id;
        $id_Accion = 3; //Eliminación
        $trazas = Traza_Resenna::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
        'valores_modificados' => 'Datos de Reseña: '.
        $fecha_resenna.' || '.$cedula.' || '.$primer_nombre.' '.$segundo_nombre.' || '.$primer_apellido.' || '.$segundo_apellido.' || '.
        $fecha_nacimiento.' || '.$genero.' || '.$estado_civil.' || '.$profesion.' || '.$motivo_resenna.' || '.
        $tez.' || '.$contextura.' || '.$funcionario_aprehensor.' || '.$funcionario_resenna.' || '.$direccion.' || '.$observaciones.' || '.$imagen]);

        $resenna = Resenna::find($id, ['id']);
        $resenna->delete();
        return redirect()->route('resenna.index')->with('eliminar', 'Ok');
    }

    public function pdf(Resenna $resenna)
    {
        return PDF::loadView('resenna.pdf', compact('resenna'))->setOption(['dpi' => 100, 'defaultFont' => 'sans-serif'])->stream('resenna.pdf');
    }
}
