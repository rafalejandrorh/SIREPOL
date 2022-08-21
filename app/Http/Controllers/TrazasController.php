<?php

namespace App\Http\Controllers;

use App\Models\Historial_Sesion;
use Illuminate\Http\Request;
use Alert;
use App\Models\Resenna;
use App\Models\Traza_Funcionarios;
use App\Models\Traza_Resenna;
use App\Models\Traza_Roles;
use App\Models\Traza_User;
use App\Models\User;
use Spatie\Permission\Models\Role;

class TrazasController extends Controller
{
    function __construct()
    {

        $this->middleware('can:trazas.index')->only('index', 
        'index_usuarios', 'index_resenna', 'index_funcionarios', 'index_historial_sesion', 'index_roles',
        'show_resenna', 'show_usuarios', 'show_funcionarios', 'show_roles');
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trazas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_resenna(Request $request)
    {
        $request->all();
        if($request->buscador == null)
        {
            $request->buscador = null;
        }

        if($request->tipo_busqueda == 'cedula'){
            $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.cedula', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'credencial'){
            $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->Where('funcionarios.credencial', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'usuario'){
            $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
            ->Where('users', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'nombre'){
            $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'apellido'){
            $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'accion'){
            $resennas = Traza_Resenna::join('traza_acciones', 'traza_acciones.id', '=', 'traza_resenna.id_accion')
            ->Where('traza_acciones.valor', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'valores_modificados'){
            $resennas = Traza_Resenna::Where('valores_modificados', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else{
            $resennas = Traza_Resenna::paginate(10);
        }

        return view('trazas.resenna_index', compact('resennas'));
    }

    public function show_resenna(Traza_Resenna $resenna)
    {
        return view('trazas.resenna_show', compact('resenna'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index_usuarios(Request $request)
    {
        $request->all();
        if($request->buscador == null)
        {
            $request->buscador = null;
        }

        if($request->tipo_busqueda == 'cedula'){
            $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.cedula', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'credencial'){
            $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->Where('funcionarios.credencial', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'usuario'){
            $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
            ->Where('users', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'nombre'){
            $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'apellido'){
            $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'accion'){
            $users = Traza_User::join('traza_acciones', 'traza_acciones.id', '=', 'traza_users.id_accion')
            ->Where('traza_acciones.valor', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'valores_modificados'){
            $users = Traza_User::Where('valores_modificados', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else{
            $users = Traza_User::paginate(10);
        }

        return view('trazas.users_index', compact('users'));
    }

    public function show_usuarios(Traza_User $user)
    {
        return view('trazas.users_show', compact('user'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index_funcionarios(Request $request)
    {
        $request->all();
        if($request->buscador == null)
        {
            $request->buscador = null;
        }

        if($request->tipo_busqueda == 'cedula'){
            $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.cedula', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'credencial'){
            $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->Where('funcionarios.credencial', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'usuario'){
            $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
            ->Where('users', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'nombre'){
            $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'apellido'){
            $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'accion'){
            $funcionario = Traza_Funcionarios::join('traza_acciones', 'traza_acciones.id', '=', 'trazas_funcionarios.id_accion')
            ->Where('traza_acciones.valor', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'valores_modificados'){
            $funcionario = Traza_Funcionarios::Where('valores_modificados', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else{
            $funcionario = Traza_Funcionarios::paginate(10);
        }

        return view('trazas.funcionarios_index', compact('funcionario'));
    }

    public function show_funcionarios(Traza_Funcionarios $funcionario)
    {
        return view('trazas.funcionarios_show', compact('funcionario'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index_roles(Request $request)
    {
        $request->all();
        if($request->buscador == null)
        {
            $request->buscador = null;
        }

        if($request->tipo_busqueda == 'cedula'){
            $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.cedula', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'credencial'){
            $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->Where('funcionarios.credencial', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'usuario'){
            $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
            ->Where('users', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'nombre'){
            $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'apellido'){
            $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'accion'){
            $roles = Traza_Roles::join('traza_acciones', 'traza_acciones.id', '=', 'traza_roles.id_accion')
            ->Where('traza_acciones.valor', 'LIKE', '%'.$request->buscador.'%')->paginate(10);

        }else{
            $roles = Traza_Roles::paginate(10);
        }

        return view('trazas.roles_index', compact('roles'));
    }

    public function show_roles(Traza_Roles $role)
    {
        return view('trazas.roles_show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index_historial_sesion(Request $request)
    {
        $request->all();
        if($request->buscador == null)
        {
            $request->buscador = null;
        }

        if($request->tipo_busqueda == 'cedula'){
            $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.cedula', '=', $request->buscador)->orderBy('login', 'DESC')->paginate(10);
        }else if($request->tipo_busqueda == 'credencial'){
            $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('login', 'DESC')->paginate(10);
        }else if($request->tipo_busqueda == 'jerarquia'){
            $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
            ->Where('jerarquia.valor', 'LIKE', '%'.$request->buscador.'%')->orderBy('login', 'DESC')->paginate(10);
        }else if($request->tipo_busqueda == 'usuario'){
            $historial_sesion = Historial_Sesion::Where('users', 'LIKE', '%'.$request->buscador.'%')->orderBy('login', 'DESC')->paginate(10);
        }else if($request->tipo_busqueda == 'nombre'){
            $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')->orderBy('login', 'DESC')->paginate(10);

        }else if($request->tipo_busqueda == 'apellido'){
            $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')->orderBy('login', 'DESC')->paginate(10);

        }else{
            $historial_sesion = Historial_Sesion::orderBy('login', 'DESC')->paginate(10);
        }

        return view('trazas.historial_sesion_index', compact('historial_sesion'));
    }

}
