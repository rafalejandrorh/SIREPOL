<?php

namespace App\Http\Controllers;

use App\Events\TrazasEvent;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermisosController extends Controller
{
    function __construct()
    {
        $this->middleware('can:permisos.index')->only('index_permisos');
        $this->middleware('can:permisos.create')->only('create_permisos');
        $this->middleware('can:permisos.edit')->only('edit_permisos', 'update_permisos');
        $this->middleware('can:permisos.destroy')->only('destroy_permisos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->all();

        if(isset($request->buscador) && is_string($request->buscador)){
            if($request->tipo_busqueda == 'nomenclatura'){
                $permissions = Permissions::Where('name', 'ilike', '%'.$request->buscador.'%')->paginate(10);

            }else if($request->tipo_busqueda == 'descripcion'){
                $permissions = Permissions::Where('description', 'ilike', '%'.$request->buscador.'%')
                ->paginate(10);

            }else if($request->tipo_busqueda == 'permiso'){
                $permissions = Permissions::Where('guard_name', 'ilike', '%'.$request->buscador.'%')->paginate(10);

            }else{
                Alert()->warning('Búsqueda no permitida');
                $permissions = Permissions::paginate(10);
            }
        }else{
            $permissions = Permissions::orderBy('created_at', 'desc')->paginate(10);
        }

        if(isset($request->tipo_busqueda) && isset($request->buscador))
        {
            $id_user = Auth::user()->id;
            $id_Accion = 5; //Búsqueda
            $valores_modificados = 'Tipo de Búsqueda: '.$request->tipo_busqueda.'. Valor Buscado: '.$request->buscador;
            event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Permisos'));
        }

        return view('configuraciones.permisos', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('configuraciones.createPermisos');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permissions = new Permissions();
        $permissions->name = $request->nomenclatura;
        $permissions->description = $request->descripcion;
        $permissions->guard_name = $request->tipo_permiso;
        $permissions->save();

        $id_user = Auth::user()->id;
        $id_Accion = 1; //Registro
        $valores_modificados = 'Datos de Permiso: '.$request->nomenclatura.' || '.$request->descripcion.' || '.$request->tipo_permiso;
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Permisos'));

        Alert()->success('Permiso registrado Satisfactoriamente');
        return redirect()->route('permisos.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permissions $permiso)
    {
        return view('configuraciones.editPermisos', compact('permiso'));
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
        $permissions = Permissions::find($id, ['id']);
        $permissions->update([
            'name' => $request->nomenclatura,
            'description' => $request->descripcion,
            'guard_name' => $request->tipo_permiso
        ]);

        $id_user = Auth::user()->id;
        $id_Accion = 2; //Actualización
        $valores_modificados = 'Datos de Permiso: '.$request->nomenclatura.' || '.$request->descripcion.' || '.$request->tipo_permiso;
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Permisos'));

        Alert()->success('Permiso Actualizado Satisfactoriamente');
        return redirect()->route('permisos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permissions = Permissions::where('id', $id)->first();
        $id_user = Auth::user()->id;
        $id_Accion = 3; //Eliminación
        $valores_modificados = 'Datos de Permiso: '.$permissions['name'].' || '.$permissions['description'].' || '.$permissions['guard_name'];
        event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Permisos'));
        
        $permissions = Permissions::find($id, ['id']);
        $permissions->delete();

        Alert()->success('El Permiso ha sido Eliminada');
        return redirect()->route('permisos.index');
    }
}
