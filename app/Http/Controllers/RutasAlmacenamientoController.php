<?php

namespace App\Http\Controllers;

use App\Events\TrazasEvent;
use App\Models\Rutas_Almacenamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RutasAlmacenamientoController extends Controller
{
    function __construct()
    {
        $this->middleware('can:rutasAlmacenamiento.index')->only('index_rutasAlmacenamiento');
        $this->middleware('can:rutasAlmacenamiento.create')->only('create_rutasAlmacenamiento');
        $this->middleware('can:rutasAlmacenamiento.edit')->only('edit_rutasAlmacenamiento', 'update_rutasAlmacenamiento');
        $this->middleware('can:rutasAlmacenamiento.destroy')->only('destroy_rutasAlmacenamiento');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rutasAlmacenamiento = Rutas_Almacenamiento::orderBy('created_at', 'desc')->paginate(10);
        return view('configuraciones.rutasAlmacenamiento', compact('rutasAlmacenamiento'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuraciones.createRutasAlmacenamiento');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rutasAlmacenamiento = new Rutas_Almacenamiento();
        $rutasAlmacenamiento->ruta = $request->ruta;
        $rutasAlmacenamiento->tipo_archivo = $request->tipo_archivo;
        $rutasAlmacenamiento->nomenclatura = $request->nomenclatura;
        $rutasAlmacenamiento->modulo = $request->modulo;
        $rutasAlmacenamiento->descripcion = $request->descripcion;
        $rutasAlmacenamiento->save();

        $id_user = Auth::user()->id;
        $id_Accion = 1; //Registro
        $valores_modificados = 'Datos de la Ruta: '.$request->ruta.' || '.$request->tipo_archivo.' || .'.$request->nomenclatura.' || '.$request->modulo.' || '.$request->descripcion;
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_RutasAlmacenamiento'));

        Alert()->success('Ruta de Almacenamiento registrada Satisfactoriamente');
        return redirect()->route('rutasAlmacenamiento.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Rutas_Almacenamiento $almacenamiento)
    {
        return view('configuraciones.editRutasAlmacenamiento', compact('almacenamiento'));
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
        $rutasAlmacenamiento = Rutas_Almacenamiento::find($id, ['id']);
        $rutasAlmacenamiento->update([
            'ruta' => $request->ruta,
            'tipo_archivo' => $request->tipo_archivo,
            'nomenclatura' => $request->nomenclatura,
            'modulo' => $request->modulo,
            'descripcion' => $request->descripcion
        ]);

        $id_user = Auth::user()->id;
        $id_Accion = 2; //Actualización
        $valores_modificados = 'Datos de la Ruta: '.$request->ruta.' || '.$request->tipo_archivo.' || .'.$request->nomenclatura.' || '.$request->modulo.' || '.$request->descripcion;
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_RutasAlmacenamiento'));

        Alert()->success('Ruta de Almacenamiento Actualizada Satisfactoriamente');
        return redirect()->route('rutasAlmacenamiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rutasAlmacenamiento = Rutas_Almacenamiento::where('id', $id)->first();
        $id_user = Auth::user()->id;
        $id_Accion = 3; //Eliminación
        $valores_modificados = 'Datos de la Ruta: '.$rutasAlmacenamiento['ruta'].' || '.$rutasAlmacenamiento['tipo_archivo'].' || '.$rutasAlmacenamiento['nomenclatura'].' || '.$rutasAlmacenamiento['modulo'].' || '.$rutasAlmacenamiento['descripcion'];
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_RutasAlmacenamiento'));
        
        $rutasAlmacenamiento = Rutas_Almacenamiento::find($id, ['id']);
        $rutasAlmacenamiento->delete();

        Alert()->success('La Ruta de Almacenamiento ha sido Eliminada');
        return redirect()->route('rutasAlmacenamiento.index');
    }
}
