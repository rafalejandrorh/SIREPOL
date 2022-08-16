<?php

namespace App\Http\Controllers;

use App\Models\Caracteristicas_Resennado;
use App\Models\Documentacion;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\Resenna;
use App\Models\Genero;
use App\Models\Geografia_Venezuela;
use App\Models\Person;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ResennaController extends Controller
{
    function __construct()
    {

        $this->middleware('can:resenna.index')->only('index');
        $this->middleware('can:resenna.create')->only('create');
        $this->middleware('can:resenna.show')->only('show');
        $this->middleware('can:resenna.edit')->only('edit', 'update');
        $this->middleware('can:resenna.destroy')->only('destroy');
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resenna = Resenna::orderBy('fecha_resenna', 'desc')->paginate(5);
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
        $funcionario_resenna = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
        ->select('funcionarios.id', 'persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor')->get();
        $funcionario_aprehensor = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
        ->select('funcionarios.id', 'persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor')->get();

        return view('resenna.create', compact('genero', 'estado_civil', 'profesion', 'motivo_resenna', 'tez', 'contextura', 
        'estado', 'municipio', 'funcionario_resenna', 'funcionario_aprehensor', 'documentacion'));
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
                $imagen = $request->file('url')->store('imagenes/resennados/'.$$obtener_persona[0]['id'].'-'.$request->cedula);
            }else{
                if($request->id_genero == '1'){
                    $imagen = 'imagenes/integrantes/masculino.png';
                }
                if($request->id_genero == '2'){
                    $imagen = 'imagenes/integrantes/femenino.png';
                }
                if($request->id_genero == null){
                    $imagen = 'imagenes/integrantes/desconocido.png';
                }
            }
            $resenna = Resenna::find($id_resenna);
            $resenna->update(['url_foto' => 'storage/'.$imagen]);

            //alert()->success('Integrante registrado con éxito');      
            return redirect()->route('resenna.index')->with('registrar', 'Ok');  

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
            $resenna = Resenna::find($id_resenna);
            $resenna->update(['url_foto' => 'storage/'.$imagen]);

            //alert()->success('Integrante registrado con éxito');      
            return redirect()->route('resenna.index')->with('registrar', 'Ok');

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
        $request->all();
        if($request['url_foto'] == null)
        {
            $request['url_foto'] = $request['url_foto_actual'];
        }
        $resenna = Resenna::find($id, ['id']);
        $resenna->update($request->all('fecha_resenna', 'id_estado_civil', 'id_profesion', 'id_motivo_resenna', 'id_tez', 
        'id_contextura', 'id_funcionario_aprehensor', 'id_funcionario_resenna', 'direccion', 'observaciones', 'url_foto'));
        $resenna->resennado()->update($request->all('id_tipo_documentacion', 'letra_cedula', 'cedula', 'primer_nombre', 
        'segundo_nombre', 'primer_apellido','segundo_apellido', 'id_genero', 'fecha_nacimiento', 'id_estado_nacimiento',
        'id_municipio_nacimiento'));

        return redirect()->route('resenna.index')->with('editar', 'Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resenna = Resenna::find($id, ['id']);
        $resenna->delete();
        return redirect()->route('resenna.index')->with('eliminar', 'Ok');
    }
}
