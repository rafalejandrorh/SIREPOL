<?php

namespace App\Http\Controllers;

use App\Models\Historial_Sesion;
use Illuminate\Http\Request;
use Alert;
use App\Models\Resenna;
use App\Models\Traza_Acciones;
use App\Models\Traza_Funcionarios;
use App\Models\Traza_Resenna;
use App\Models\Traza_Roles;
use App\Models\Traza_Sessions;
use App\Models\Traza_User;
use App\Models\Traza_Permisos;
use App\Models\Traza_Rutas_Almacenamiento;
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
    public function indexResenna(Request $request)
    {
        $request->all();
        if(isset($request->filtro) && $request->filtro == 1)
        {
                if($request->fecha_inicio != null && $request->fecha_fin == null)
                {
                    Alert()->error('Error en el Filtrado','Atención: Al filtrar por fecha, debes colocar fecha de Inicio y Fin (Desde y Hasta)');
                    return back();
                }
                $queryBuilder = Traza_Resenna::query();
                if($request->fecha_inicio != null && $request->fecha_fin != null)    
                {
                    $inicio = date('Y-m-d H:i:s', strtotime($request->fecha_inicio));
                    $fin = date('Y-m-d H:i:s', strtotime($request->fecha_fin.' 23:59:59'));
                    $queryBuilder->WhereBetween('created_at', [$inicio, $fin]);
                }
                if($request->id_accion != null)
                {
                    $queryBuilder->Where('id_accion', $request->id_accion);
                }
                if($request->id_usuario != null)
                {
                    $queryBuilder->Where('id_user', $request->id_usuario);
                }
                $resennas = $queryBuilder->orderBy('created_at', 'desc')->paginate(10);
        }else{

            if(isset($request->buscador) && is_numeric($request->buscador))
            {
                if($request->tipo_busqueda == 'cedula'){
                    $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_resenna.id', 'traza_resenna.id_user', 'traza_resenna.id_accion', 'traza_resenna.valores_modificados', 'traza_resenna.created_at')
                    ->Where('persons.cedula', '=', $request->buscador)->orderBy('traza_resenna.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'credencial'){
                    $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->select('traza_resenna.id', 'traza_resenna.id_user', 'traza_resenna.id_accion', 'traza_resenna.valores_modificados', 'traza_resenna.created_at')
                    ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('traza_resenna.created_at', 'desc')->paginate(10);
                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $resennas = Traza_Resenna::orderBy('created_at', 'desc')->paginate(10);
                }
            }else if(isset($request->buscador) && is_string($request->buscador)){

                if($request->tipo_busqueda == 'usuario'){
                    $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
                    ->select('traza_resenna.id', 'traza_resenna.id_user', 'traza_resenna.id_accion', 'traza_resenna.valores_modificados', 'traza_resenna.created_at')
                    ->Where('users', 'ilike', '%'.$request->buscador.'%')->orderBy('traza_resenna.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'nombre'){
                    $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_resenna.id', 'traza_resenna.id_user', 'traza_resenna.id_accion', 'traza_resenna.valores_modificados', 'traza_resenna.created_at')
                    ->Where('persons.primer_nombre', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_resenna.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'apellido'){
                    $resennas = Traza_Resenna::join('users', 'users.id', '=', 'traza_resenna.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_resenna.id', 'traza_resenna.id_user', 'traza_resenna.id_accion', 'traza_resenna.valores_modificados', 'traza_resenna.created_at')
                    ->Where('persons.primer_apellido', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_resenna.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'accion'){
                    $resennas = Traza_Resenna::join('traza_acciones', 'traza_acciones.id', '=', 'traza_resenna.id_accion')
                    ->select('traza_resenna.id', 'traza_resenna.id_user', 'traza_resenna.id_accion', 'traza_resenna.valores_modificados', 'traza_resenna.created_at')
                    ->Where('traza_acciones.valor', 'ilike', '%'.$request->buscador.'%')->orderBy('created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'valores_modificados'){
                    $resennas = Traza_Resenna::select('traza_resenna.id', 'traza_resenna.id_user', 'traza_resenna.id_accion', 'traza_resenna.valores_modificados', 'traza_resenna.created_at')
                    ->Where('valores_modificados', 'ilike', '%'.$request->buscador.'%')->
                    orderBy('traza_resenna.created_at', 'desc')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $resennas = Traza_Resenna::orderBy('created_at', 'desc')->paginate(10);
                }
            }else{
                $resennas = Traza_Resenna::orderBy('created_at', 'desc')->paginate(10);
            }
        }

        $accion = Traza_Acciones::pluck('valor', 'id')->all();
        $user = User::pluck('users', 'id')->all();

        return view('trazas.resennaIndex', compact('resennas', 'user', 'accion'));
    }

    public function showResenna(Traza_Resenna $resenna)
    {
        return view('trazas.resennaShow', compact('resenna'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexUsuarios(Request $request)
    {
        $request->all();
        if(isset($request->filtro) && $request->filtro == 1)
        {
                if($request->fecha_inicio != null && $request->fecha_fin == null)
                {
                    Alert()->error('Error en el Filtrado','Atención: Al filtrar por fecha, debes colocar fecha de Inicio y Fin (Desde y Hasta)');
                    return back();
                }
                $queryBuilder = Traza_User::query();
                if($request->fecha_inicio != null && $request->fecha_fin != null)    
                {
                    $inicio = date('Y-m-d H:i:s', strtotime($request->fecha_inicio));
                    $fin = date('Y-m-d H:i:s', strtotime($request->fecha_fin.' 23:59:59'));
                    $queryBuilder->WhereBetween('created_at', [$inicio, $fin]);
                }
                if($request->id_accion != null)
                {
                    $queryBuilder->Where('id_accion', $request->id_accion);
                }
                if($request->id_usuario != null)
                {
                    $queryBuilder->Where('id_user', $request->id_usuario);
                }
                $users = $queryBuilder->orderBy('created_at', 'desc')->paginate(10);
        }else{

            if(isset($request->buscador) && is_numeric($request->buscador))
            {
                if($request->tipo_busqueda == 'cedula'){
                    $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_users.id', 'traza_users.id_user', 'traza_users.id_accion', 'traza_users.valores_modificados', 'traza_users.created_at')
                    ->Where('persons.cedula', '=', $request->buscador)->orderBy('traza_users.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'credencial'){
                    $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->select('traza_users.id', 'traza_users.id_user', 'traza_users.id_accion', 'traza_users.valores_modificados', 'traza_users.created_at')
                    ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('traza_users.created_at', 'desc')->paginate(10);
                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $users = Traza_User::orderBy('created_at', 'desc')->paginate(10);
                }
            }else if(isset($request->buscador) && is_string($request->buscador)){

                if($request->tipo_busqueda == 'usuario'){
                    $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
                    ->select('traza_users.id', 'traza_users.id_user', 'traza_users.id_accion', 'traza_users.valores_modificados', 'traza_users.created_at')
                    ->Where('users', 'ilike', '%'.$request->buscador.'%')->orderBy('traza_users.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'nombre'){
                    $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_users.id', 'traza_users.id_user', 'traza_users.id_accion', 'traza_users.valores_modificados', 'traza_users.created_at')
                    ->Where('persons.primer_nombre', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_users.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'apellido'){
                    $users = Traza_User::join('users', 'users.id', '=', 'traza_users.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_users.id', 'traza_users.id_user', 'traza_users.id_accion', 'traza_users.valores_modificados', 'traza_users.created_at')
                    ->Where('persons.primer_apellido', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_users.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'accion'){
                    $users = Traza_User::join('traza_acciones', 'traza_acciones.id', '=', 'traza_users.id_accion')
                    ->select('traza_users.id', 'traza_users.id_user', 'traza_users.id_accion', 'traza_users.valores_modificados', 'traza_users.created_at')
                    ->Where('traza_acciones.valor', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_users.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'valores_modificados'){
                    $users = Traza_User::select('traza_users.id', 'traza_users.id_user', 'traza_users.id_accion', 'traza_users.valores_modificados', 'traza_users.created_at')
                    ->Where('valores_modificados', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_users.created_at', 'desc')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $users = Traza_User::orderBy('created_at', 'desc')->paginate(10);
                }
            }else{
                $users = Traza_User::orderBy('created_at', 'desc')->paginate(10);
            }
        }

        $accion = Traza_Acciones::pluck('valor', 'id')->all();
        $user = User::pluck('users', 'id')->all();

        return view('trazas.usersIndex', compact('users', 'user', 'accion'));
    }

    public function showUsuarios(Traza_User $user)
    {
        return view('trazas.userShow', compact('user'));
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexFuncionarios(Request $request)
    {
        $request->all();
        if(isset($request->filtro) && $request->filtro == 1)
        {
                if($request->fecha_inicio != null && $request->fecha_fin == null)
                {
                    Alert()->error('Error en el Filtrado','Atención: Al filtrar por fecha, debes colocar fecha de Inicio y Fin (Desde y Hasta)');
                    return back();
                }
                $queryBuilder = Traza_Funcionarios::query();
                if($request->fecha_inicio != null && $request->fecha_fin != null)    
                {
                    $inicio = date('Y-m-d H:i:s', strtotime($request->fecha_inicio));
                    $fin = date('Y-m-d H:i:s', strtotime($request->fecha_fin.' 23:59:59'));
                    $queryBuilder->WhereBetween('created_at', [$inicio, $fin]);
                }
                if($request->id_accion != null)
                {
                    $queryBuilder->Where('id_accion', $request->id_accion);
                }
                if($request->id_usuario != null)
                {
                    $queryBuilder->Where('id_user', $request->id_usuario);
                }
                $funcionario = $queryBuilder->orderBy('created_at', 'desc')->paginate(10);
        }else{

            if(isset($request->buscador) && is_numeric($request->buscador))
            {
                if($request->tipo_busqueda == 'cedula'){
                    $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('trazas_funcionarios.id', 'trazas_funcionarios.id_user', 'trazas_funcionarios.id_accion', 'trazas_funcionarios.valores_modificados', 'trazas_funcionarios.created_at')
                    ->Where('persons.cedula', '=', $request->buscador)->orderBy('trazas_funcionarios.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'credencial'){
                    $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->select('trazas_funcionarios.id', 'trazas_funcionarios.id_user', 'trazas_funcionarios.id_accion', 'trazas_funcionarios.valores_modificados', 'trazas_funcionarios.created_at')
                    ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('trazas_funcionarios.created_at', 'desc')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $funcionario = Traza_Funcionarios::orderBy('created_at', 'desc')->paginate(10);
                }
            }else if(isset($request->buscador) && is_string($request->buscador)){

                if($request->tipo_busqueda == 'usuario'){
                    $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
                    ->select('trazas_funcionarios.id', 'trazas_funcionarios.id_user', 'trazas_funcionarios.id_accion', 'trazas_funcionarios.valores_modificados', 'trazas_funcionarios.created_at')
                    ->Where('users', 'ilike', '%'.$request->buscador.'%')->orderBy('trazas_funcionarios.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'nombre'){
                    $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('trazas_funcionarios.id', 'trazas_funcionarios.id_user', 'trazas_funcionarios.id_accion', 'trazas_funcionarios.valores_modificados', 'trazas_funcionarios.created_at')
                    ->Where('persons.primer_nombre', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('trazas_funcionarios.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'apellido'){
                    $funcionario = Traza_Funcionarios::join('users', 'users.id', '=', 'trazas_funcionarios.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('trazas_funcionarios.id', 'trazas_funcionarios.id_user', 'trazas_funcionarios.id_accion', 'trazas_funcionarios.valores_modificados', 'trazas_funcionarios.created_at')
                    ->Where('persons.primer_apellido', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('trazas_funcionarios.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'accion'){
                    $funcionario = Traza_Funcionarios::join('traza_acciones', 'traza_acciones.id', '=', 'trazas_funcionarios.id_accion')
                    ->select('trazas_funcionarios.id', 'trazas_funcionarios.id_user', 'trazas_funcionarios.id_accion', 'trazas_funcionarios.valores_modificados', 'trazas_funcionarios.created_at')
                    ->Where('traza_acciones.valor', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('trazas_funcionarios.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'valores_modificados'){
                    $funcionario = Traza_Funcionarios::select('trazas_funcionarios.id', 'trazas_funcionarios.id_user', 'trazas_funcionarios.id_accion', 'trazas_funcionarios.valores_modificados', 'trazas_funcionarios.created_at')
                    ->Where('valores_modificados', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('trazas_funcionarios.created_at', 'desc')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $funcionario = Traza_Funcionarios::orderBy('created_at', 'desc')->paginate(10);
                }
            }else{
                $funcionario = Traza_Funcionarios::orderBy('created_at', 'desc')->paginate(10);
            }
        }

        $accion = Traza_Acciones::pluck('valor', 'id')->all();
        $user = User::pluck('users', 'id')->all();

        return view('trazas.funcionariosIndex', compact('funcionario', 'user', 'accion'));
    }

    public function showFuncionarios(Traza_Funcionarios $funcionario)
    {
        return view('trazas.funcionarioShow', compact('funcionario'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexRoles(Request $request)
    {
        $request->all();
        if(isset($request->filtro) && $request->filtro == 1)
        {
                if($request->fecha_inicio != null && $request->fecha_fin == null)
                {
                    Alert()->error('Error en el Filtrado','Atención: Al filtrar por fecha, debes colocar fecha de Inicio y Fin (Desde y Hasta)');
                    return back();
                }
                $queryBuilder = Traza_Roles::query();
                if($request->fecha_inicio != null && $request->fecha_fin != null)    
                {
                    $inicio = date('Y-m-d H:i:s', strtotime($request->fecha_inicio));
                    $fin = date('Y-m-d H:i:s', strtotime($request->fecha_fin.' 23:59:59'));
                    $queryBuilder->WhereBetween('created_at', [$inicio, $fin]);
                }
                if($request->id_accion != null)
                {
                    $queryBuilder->Where('id_accion', $request->id_accion);
                }
                if($request->id_usuario != null)
                {
                    $queryBuilder->Where('id_user', $request->id_usuario);
                }
                $roles = $queryBuilder->orderBy('created_at', 'desc')->paginate(10);
        }else{

            if(isset($request->buscador) && is_numeric($request->buscador))
            {
                if($request->tipo_busqueda == 'cedula'){
                    $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->Where('persons.cedula', '=', $request->buscador)->orderBy('traza_roles.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'credencial'){
                    $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('traza_roles.created_at', 'desc')->paginate(10);
                
                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $roles = Traza_Roles::orderBy('created_at', 'desc')->paginate(10);
                }
            }else if(isset($request->buscador) && is_string($request->buscador)){

                if($request->tipo_busqueda == 'usuario'){
                    $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
                    ->Where('users', 'ilike', '%'.$request->buscador.'%')->orderBy('traza_roles.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'nombre'){
                    $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->Where('persons.primer_nombre', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_roles.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'apellido'){
                    $roles = Traza_Roles::join('users', 'users.id', '=', 'traza_roles.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->Where('persons.primer_apellido', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_roles.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'accion'){
                    $roles = Traza_Roles::join('traza_acciones', 'traza_acciones.id', '=', 'traza_roles.id_accion')
                    ->Where('traza_acciones.valor', 'ilike', '%'.$request->buscador.'%')
                    ->orderBy('traza_roles.created_at', 'desc')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $roles = Traza_Roles::orderBy('created_at', 'desc')->paginate(10);
                }
            }else{
                $roles = Traza_Roles::orderBy('created_at', 'desc')->paginate(10);
            }
        }

        $accion = Traza_Acciones::pluck('valor', 'id')->all();
        $user = User::pluck('users', 'id')->all();

        return view('trazas.rolesIndex', compact('roles', 'user', 'accion'));
    }

    public function showRoles(Traza_Roles $role)
    {
        return view('trazas.roleShow', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function indexHistorialSesion(Request $request)
    {
        $request->all();
        if(isset($request->filtro) && $request->filtro == 1)
        {
                if($request->fecha_inicio != null && $request->fecha_fin == null)
                {
                    Alert()->error('Error en el Filtrado','Atención: Al filtrar por fecha, debes colocar fecha de Inicio y Fin (Desde y Hasta)');
                    return back();
                }
                $queryBuilder = Historial_Sesion::query();
                if($request->fecha_inicio != null && $request->fecha_fin != null)    
                {
                    $inicio = date('Y-m-d H:i:s', strtotime($request->fecha_inicio));
                    $fin = date('Y-m-d H:i:s', strtotime($request->fecha_fin.' 23:59:59'));
                    $queryBuilder->WhereBetween('login', [$inicio, $fin]);
                }
                if($request->id_usuario != null)
                {
                    $queryBuilder->Where('id_user', $request->id_usuario);
                }
                $historial_sesion = $queryBuilder->orderBy('login', 'desc')->paginate(10);
        }else{

            if(isset($request->buscador) && is_numeric($request->buscador))
            {
                if($request->tipo_busqueda == 'cedula'){
                    $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->Where('persons.cedula', '=', $request->buscador)->orderBy('login', 'DESC')->paginate(10);
                    
                }else if($request->tipo_busqueda == 'credencial'){
                    $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('login', 'DESC')->paginate(10);
                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $historial_sesion = Historial_Sesion::orderBy('login', 'DESC')->paginate(10);
                }
            }else if(isset($request->buscador) && is_string($request->buscador)){

                if($request->tipo_busqueda == 'jerarquia'){
                    $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('nomenclador.jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
                    ->Where('jerarquia.valor', 'ilike', '%'.$request->buscador.'%')->orderBy('login', 'DESC')->paginate(10);

                }else if($request->tipo_busqueda == 'usuario'){
                    $historial_sesion = Historial_Sesion::Where('users', 'ilike', '%'.$request->buscador.'%')->orderBy('login', 'DESC')->paginate(10);

                }else if($request->tipo_busqueda == 'nombre'){
                    $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->Where('persons.primer_nombre', 'ilike', '%'.$request->buscador.'%')->orderBy('login', 'DESC')->paginate(10);

                }else if($request->tipo_busqueda == 'apellido'){
                    $historial_sesion = Historial_Sesion::join('users', 'users.id', '=', 'historial_sesion.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->Where('persons.primer_apellido', 'ilike', '%'.$request->buscador.'%')->orderBy('login', 'DESC')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $historial_sesion = Historial_Sesion::orderBy('login', 'DESC')->paginate(10);
                }
            }else{
                $historial_sesion = Historial_Sesion::orderBy('login', 'DESC')->paginate(10);
            }
        }

        $accion = Traza_Acciones::pluck('valor', 'id')->all();
        $user = User::pluck('users', 'id')->all();

        return view('trazas.historialsesionIndex', compact('historial_sesion', 'user', 'accion'));
    }

    public function indexSesiones(Request $request)
    {
        $request->all();
        if(isset($request->filtro) && $request->filtro == 1)
        {
            if($request->fecha_inicio != null && $request->fecha_fin == null)
            {
                Alert()->error('Error en el Filtrado','Atención: Al filtrar por fecha, debes colocar fecha de Inicio y Fin (Desde y Hasta)');
                return back();
            }
            $queryBuilder = Traza_Sessions::query();
            if($request->fecha_inicio != null && $request->fecha_fin != null)    
            {
                $inicio = date('Y-m-d H:i:s', strtotime($request->fecha_inicio));
                $fin = date('Y-m-d H:i:s', strtotime($request->fecha_fin.' 23:59:59'));
                $queryBuilder->WhereBetween('created_at', [$inicio, $fin]);
            }
            if($request->id_accion != null)
            {
                $queryBuilder->Where('id_accion', $request->id_accion);
            }
            if($request->id_usuario != null)
            {
                $queryBuilder->Where('id_user', $request->id_usuario);
            }
            $sesiones = $queryBuilder->orderBy('created_at', 'desc')->paginate(10);
        }else{

            if(isset($request->buscador) && is_numeric($request->buscador))
            {
                if($request->tipo_busqueda == 'cedula'){
                    $sesiones = Traza_Sessions::join('users', 'users.id', '=', 'traza_sessions.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_sessions.id', 'traza_sessions.id_user', 'traza_sessions.id_accion', 'traza_sessions.valores_modificados', 'traza_sessions.created_at')
                    ->Where('persons.cedula', '=', $request->buscador)->orderBy('traza_sessions.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'credencial'){
                    $sesiones = Traza_Sessions::join('users', 'users.id', '=', 'traza_sessions.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->select('traza_sessions.id', 'traza_sessions.id_user', 'traza_sessions.id_accion', 'traza_sessions.valores_modificados', 'traza_sessions.created_at')
                    ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('traza_sessions.created_at', 'desc')->paginate(10);
                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $sesiones = Traza_Sessions::orderBy('created_at', 'desc')->paginate(10);
                }
            }else if(isset($request->buscador) && is_string($request->buscador)){

                if($request->tipo_busqueda == 'usuario'){
                    $sesiones = Traza_Sessions::join('users', 'users.id', '=', 'traza_sessions.id_user')
                    ->select('traza_sessions.id', 'traza_sessions.id_user', 'traza_sessions.id_accion', 'traza_sessions.valores_modificados', 'traza_sessions.created_at')
                    ->Where('users', 'LIKE', '%'.$request->buscador.'%')->orderBy('traza_sessions.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'nombre'){
                    $sesiones = Traza_Sessions::join('users', 'users.id', '=', 'traza_sessions.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_sessions.id', 'traza_sessions.id_user', 'traza_sessions.id_accion', 'traza_sessions.valores_modificados', 'traza_sessions.created_at')
                    ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('traza_sessions.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'apellido'){
                    $sesiones = Traza_Sessions::join('users', 'users.id', '=', 'traza_sessions.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('traza_sessions.id', 'traza_sessions.id_user', 'traza_sessions.id_accion', 'traza_sessions.valores_modificados', 'traza_sessions.created_at')
                    ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('traza_sessions.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'accion'){
                    $sesiones = Traza_Sessions::join('traza_acciones', 'traza_acciones.id', '=', 'traza_sessions.id_accion')
                    ->select('traza_sessions.id', 'traza_sessions.id_user', 'traza_sessions.id_accion', 'traza_sessions.valores_modificados', 'traza_sessions.created_at')
                    ->Where('traza_acciones.valor', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('traza_sessions.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'valores_modificados'){
                    $sesiones = Traza_Sessions::select('traza_sessions.id', 'traza_sessions.id_user', 'traza_sessions.id_accion', 'traza_sessions.valores_modificados', 'traza_sessions.created_at')
                    ->Where('valores_modificados', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('traza_sessions.created_at', 'desc')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $sesiones = Traza_Sessions::orderBy('created_at', 'desc')->paginate(10);
                }
            }else{
                $sesiones = Traza_Sessions::orderBy('created_at', 'desc')->paginate(10);
            }
        }

        $accion = Traza_Acciones::pluck('valor', 'id')->all();
        $user = User::pluck('users', 'id')->all();

        return view('trazas.sesionesIndex', compact('sesiones', 'user', 'accion'));
    }

    public function showSesiones(Traza_Sessions $sesion)
    {
        return view('trazas.sesioneShow', compact('sesion'));
    }

    public function index_permisos(Request $request)
    {
        $request->all();
        if(isset($request->filtro) && $request->filtro == 1)
        {
            if($request->fecha_inicio != null && $request->fecha_fin == null)
            {
                Alert()->error('Error en el Filtrado','Atención: Al filtrar por fecha, debes colocar fecha de Inicio y Fin (Desde y Hasta)');
                return back();
            }
            $queryBuilder = Traza_Permisos::query();
            if($request->fecha_inicio != null && $request->fecha_fin != null)    
            {
                $inicio = date('Y-m-d H:i:s', strtotime($request->fecha_inicio));
                $fin = date('Y-m-d H:i:s', strtotime($request->fecha_fin.' 23:59:59'));
                $queryBuilder->WhereBetween('created_at', [$inicio, $fin]);
            }
            if($request->id_accion != null)
            {
                $queryBuilder->Where('id_accion', $request->id_accion);
            }
            if($request->id_usuario != null)
            {
                $queryBuilder->Where('id_user', $request->id_usuario);
            }
            $permisos = $queryBuilder->orderBy('created_at', 'desc')->paginate(10);
        }else{

            if(isset($request->buscador) && is_numeric($request->buscador))
            {
                if($request->tipo_busqueda == 'cedula'){
                    $permisos = Traza_Permisos::join('users', 'users.id', '=', 'permisos.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('permisos.id', 'permisos.id_user', 'permisos.id_accion', 'permisos.valores_modificados', 'permisos.created_at')
                    ->Where('persons.cedula', '=', $request->buscador)->orderBy('permisos.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'credencial'){
                    $permisos = Traza_Permisos::join('users', 'users.id', '=', 'permisos.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->select('permisos.id', 'permisos.id_user', 'permisos.id_accion', 'permisos.valores_modificados', 'permisos.created_at')
                    ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('permisos.created_at', 'desc')->paginate(10);
                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $permisos = Traza_Permisos::orderBy('created_at', 'desc')->paginate(10);
                }
            }else if(isset($request->buscador) && is_string($request->buscador)){

                if($request->tipo_busqueda == 'usuario'){
                    $permisos = Traza_Permisos::join('users', 'users.id', '=', 'permisos.id_user')
                    ->select('permisos.id', 'permisos.id_user', 'permisos.id_accion', 'permisos.valores_modificados', 'permisos.created_at')
                    ->Where('users', 'LIKE', '%'.$request->buscador.'%')->orderBy('permisos.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'nombre'){
                    $permisos = Traza_Permisos::join('users', 'users.id', '=', 'permisos.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('permisos.id', 'permisos.id_user', 'permisos.id_accion', 'permisos.valores_modificados', 'permisos.created_at')
                    ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('permisos.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'apellido'){
                    $permisos = Traza_Permisos::join('users', 'users.id', '=', 'permisos.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('permisos.id', 'permisos.id_user', 'permisos.id_accion', 'permisos.valores_modificados', 'permisos.created_at')
                    ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('permisos.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'accion'){
                    $permisos = Traza_Permisos::join('traza_acciones', 'traza_acciones.id', '=', 'permisos.id_accion')
                    ->select('permisos.id', 'permisos.id_user', 'permisos.id_accion', 'permisos.valores_modificados', 'permisos.created_at')
                    ->Where('traza_acciones.valor', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('permisos.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'valores_modificados'){
                    $permisos = Traza_Permisos::select('permisos.id', 'permisos.id_user', 'permisos.id_accion', 'permisos.valores_modificados', 'permisos.created_at')
                    ->Where('valores_modificados', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('permisos.created_at', 'desc')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $permisos = Traza_Permisos::orderBy('created_at', 'desc')->paginate(10);
                }
            }else{
                $permisos = Traza_Permisos::orderBy('created_at', 'desc')->paginate(10);
            }
        }

        $accion = Traza_Acciones::pluck('valor', 'id')->all();
        $user = User::pluck('users', 'id')->all();

        return view('trazas.permisosIndex', compact('permisos', 'user', 'accion'));
    }

    public function show_permisos(Traza_Permisos $permiso)
    {
        return view('trazas.permisoShow', compact('permiso'));
    }

    public function indexRutasAlmacenamiento(Request $request)
    {
        $request->all();
        if(isset($request->filtro) && $request->filtro == 1)
        {
            if($request->fecha_inicio != null && $request->fecha_fin == null)
            {
                Alert()->error('Error en el Filtrado','Atención: Al filtrar por fecha, debes colocar fecha de Inicio y Fin (Desde y Hasta)');
                return back();
            }
            $queryBuilder = Traza_Rutas_Almacenamiento::query();
            if($request->fecha_inicio != null && $request->fecha_fin != null)    
            {
                $inicio = date('Y-m-d H:i:s', strtotime($request->fecha_inicio));
                $fin = date('Y-m-d H:i:s', strtotime($request->fecha_fin.' 23:59:59'));
                $queryBuilder->WhereBetween('created_at', [$inicio, $fin]);
            }
            if($request->id_accion != null)
            {
                $queryBuilder->Where('id_accion', $request->id_accion);
            }
            if($request->id_usuario != null)
            {
                $queryBuilder->Where('id_user', $request->id_usuario);
            }
            $rutas = $queryBuilder->orderBy('created_at', 'desc')->paginate(10);
        }else{

            if(isset($request->buscador) && is_numeric($request->buscador))
            {
                if($request->tipo_busqueda == 'cedula'){
                    $rutas = Traza_Rutas_Almacenamiento::join('users', 'users.id', '=', 'rutas_almacenamiento.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('rutas_almacenamiento.id', 'rutas_almacenamiento.id_user', 'rutas_almacenamiento.id_accion', 'rutas_almacenamiento.valores_modificados', 'rutas_almacenamiento.created_at')
                    ->Where('persons.cedula', '=', $request->buscador)->orderBy('rutas_almacenamiento.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'credencial'){
                    $rutas = Traza_Rutas_Almacenamiento::join('users', 'users.id', '=', 'rutas_almacenamiento.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->select('rutas_almacenamiento.id', 'rutas_almacenamiento.id_user', 'rutas_almacenamiento.id_accion', 'rutas_almacenamiento.valores_modificados', 'rutas_almacenamiento.created_at')
                    ->Where('funcionarios.credencial', '=', $request->buscador)->orderBy('rutas_almacenamiento.created_at', 'desc')->paginate(10);
                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $rutas = Traza_Rutas_Almacenamiento::orderBy('created_at', 'desc')->paginate(10);
                }
            }else if(isset($request->buscador) && is_string($request->buscador)){

                if($request->tipo_busqueda == 'usuario'){
                    $rutas = Traza_Rutas_Almacenamiento::join('users', 'users.id', '=', 'rutas_almacenamiento.id_user')
                    ->select('rutas_almacenamiento.id', 'rutas_almacenamiento.id_user', 'rutas_almacenamiento.id_accion', 'rutas_almacenamiento.valores_modificados', 'rutas_almacenamiento.created_at')
                    ->Where('users', 'LIKE', '%'.$request->buscador.'%')->orderBy('rutas_almacenamiento.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'nombre'){
                    $rutas = Traza_Rutas_Almacenamiento::join('users', 'users.id', '=', 'rutas_almacenamiento.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('rutas_almacenamiento.id', 'rutas_almacenamiento.id_user', 'rutas_almacenamiento.id_accion', 'rutas_almacenamiento.valores_modificados', 'rutas_almacenamiento.created_at')
                    ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('rutas_almacenamiento.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'apellido'){
                    $rutas = Traza_Rutas_Almacenamiento::join('users', 'users.id', '=', 'rutas_almacenamiento.id_user')
                    ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
                    ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
                    ->select('rutas_almacenamiento.id', 'rutas_almacenamiento.id_user', 'rutas_almacenamiento.id_accion', 'rutas_almacenamiento.valores_modificados', 'rutas_almacenamiento.created_at')
                    ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('rutas_almacenamiento.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'accion'){
                    $rutas = Traza_Rutas_Almacenamiento::join('traza_acciones', 'traza_acciones.id', '=', 'rutas_almacenamiento.id_accion')
                    ->select('rutas_almacenamiento.id', 'rutas_almacenamiento.id_user', 'rutas_almacenamiento.id_accion', 'rutas_almacenamiento.valores_modificados', 'rutas_almacenamiento.created_at')
                    ->Where('traza_acciones.valor', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('rutas_almacenamiento.created_at', 'desc')->paginate(10);

                }else if($request->tipo_busqueda == 'valores_modificados'){
                    $rutas = Traza_Rutas_Almacenamiento::select('rutas_almacenamiento.id', 'rutas_almacenamiento.id_user', 'rutas_almacenamiento.id_accion', 'rutas_almacenamiento.valores_modificados', 'rutas_almacenamiento.created_at')
                    ->Where('valores_modificados', 'LIKE', '%'.$request->buscador.'%')
                    ->orderBy('rutas_almacenamiento.created_at', 'desc')->paginate(10);

                }else{
                    Alert()->warning('Búsqueda no permitida');
                    $rutas = Traza_Rutas_Almacenamiento::orderBy('created_at', 'desc')->paginate(10);
                }
            }else{
                $rutas = Traza_Rutas_Almacenamiento::orderBy('created_at', 'desc')->paginate(10);
            }
        }

        $accion = Traza_Acciones::pluck('valor', 'id')->all();
        $user = User::pluck('users', 'id')->all();

        return view('trazas.rutasAlmacenamientoIndex', compact('rutas', 'user', 'accion'));
    }

    public function showRutasAlmacenamiento(Traza_Rutas_Almacenamiento $ruta)
    {
        return view('trazas.rutasAlmacenamientoShow', compact('ruta'));
    }

}
