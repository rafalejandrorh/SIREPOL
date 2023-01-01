<?php

namespace App\Http\Controllers;

use App\Events\TrazasEvent;
use App\Models\Permissions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionesController extends Controller
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
    public function index()
    {
        return view('configuraciones.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_permisos()
    {
        $permissions = Permissions::orderBy('created_at', 'desc')->paginate(10);
        return view('configuraciones.permisos', compact('permissions'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_rutasAlmacenamiento()
    {
        return view('configuraciones.rutasAlmacenamiento');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_permisos()
    {
        return view('configuraciones.createPermisos');
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_rutasAlmacenamiento()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_permisos(Request $request)
    {
        $permissions = new Permissions();
        $permissions->name = $request->nomenclatura;
        $permissions->description = $request->descripcion;
        $permissions->guard_name = $request->tipo_permiso;
        $permissions->save();

        // $id_user = Auth::user()->id;
        // $id_Accion = 1; //Registro
        // $valores_modificados = 'Datos de Permiso: '.$request->nomenclatura.' || .'.$request->descripcion.' || '.$request->tipo_permiso;
        // event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Permisos'));

        Alert()->success('Permiso registrado Satisfactoriamente');
        return redirect()->route('permisos.index');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_rutasAlmacenamiento(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_permisos(Permissions $permiso)
    {
        return view('configuraciones.editPermisos', compact('permiso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_rutasAlmacenamiento($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_permisos($id, Request $request)
    {
        $permissions = Permissions::find($id, ['id']);
        $permissions->update([
            'name' => $request->nomenclatura,
            'description' => $request->descripcion,
            'guard_name' => $request->tipo_permiso
        ]);

        // $id_user = Auth::user()->id;
        // $id_Accion = 2; //Actualización
        // $valores_modificados = 'Datos de Permiso: '.$request->nomenclatura.' || '.$request->descripcion.' || '.$request->tipo_permiso;
        // event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Permisos'));

        Alert()->success('Permiso Actualizado Satisfactoriamente');
        return redirect()->route('permisos.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_rutasAlmacenamiento(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_permisos($id)
    {
        // $permissions = Permissions::where('id', $id)->first();
        // $id_user = Auth::user()->id;
        // $id_Accion = 3; //Eliminación
        // $valores_modificados = 'Datos de Permiso: '.$permissions['name'].' || '.$permissions['description'].' || '.$permissions['guard_name'];
        // event(new TrazasEvent($id_user, $id_Accion, $valores_modificados, 'Traza_Permisos'));
        
        $resenna = Permissions::find($id, ['id']);
        $resenna->delete();

        Alert()->success('El Permiso ha sido Eliminada');
        return redirect()->route('permisos.index');
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy_rutasAlmacenamiento($id)
    {
        //
    }
}
