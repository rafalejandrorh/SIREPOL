<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Funcionario;
use App\Models\Traza_User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Alert;

class UserController extends Controller
{
    function __construct()
    {

        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create');
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.update_status')->only('update_status');
        
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

        if($request->tipo_busqueda == 'cedula'){
            $user = User::join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.cedula', '=', $request->buscador)->paginate(10);
        }else if($request->tipo_busqueda == 'credencial'){
            $user = User::join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->Where('funcionarios.credencial', '=', $request->buscador)->paginate(10);
        }else if($request->tipo_busqueda == 'jerarquia'){
            $user = User::join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
            ->Where('jerarquia.valor', 'LIKE', '%'.$request->buscador.'%')->paginate(10);
        }else if($request->tipo_busqueda == 'usuario'){
            $user = User::Where('users', 'LIKE', '%'.$request->buscador.'%')->paginate(10);
        }else if($request->tipo_busqueda == 'estatus'){
            if($request->buscador == 'activo' || $request->buscador == 'Activo' || $request->buscador == 'ACTIVO'){
                $status = true;
            }else if($request->buscador == 'inactivo' || $request->buscador == 'Inactivo' || $request->buscador == 'INACTIVO'){
                $status = false;
            }
            $user = User::Where('status', '=', $status)->paginate(10);
        }else if($request->tipo_busqueda == 'nombre'){
            $user = User::join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_nombre', 'LIKE', '%'.$request->buscador.'%')->paginate(5);

        }else if($request->tipo_busqueda == 'apellido'){
            $user = User::join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_apellido', 'LIKE', '%'.$request->buscador.'%')->paginate(5);

        }else{
            $user = User::paginate(10);
        }
        
        return view('users.index', ['Users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','id')->all();
        $funcionarios = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
        ->select('funcionarios.id', 'persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor')->get();
        return view('users.create',compact('roles', 'funcionarios'));
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

        $user = Validator::make($request,User::returnValidations(),User::returnMessages())->validate();
        
        $usuario = new User();

        $obtener_usuario = $usuario->where('id_funcionario','=',$request['id_funcionario'])->get();
        $validar_usuario = $usuario->where('id_funcionario','=',$request['id_funcionario'])->exists();
        if($validar_usuario == true){
            Alert()->info('El funcionario ya posee un Usuario.');
            return redirect()->route('users.index');
        } 

        if($validar_usuario == false){

            $request['password'] = bcrypt($request['password']);
            
            $usuario->id_funcionario = $request['id_funcionario'];
            $usuario->users = $request['users'];
            $usuario->password = $request['password'];
            $usuario->status = 'true';
            $usuario->save();

            $usuario->assignRole($request['roles']);

            $roles = Role::get();
            $roles_for = $roles->Where('id', $request['roles']);
            foreach($roles_for as $roles){
                $rol = $roles['valor'];
            }

            $id_user = Auth::user()->id;
            $id_Accion = 1; //Registro
            $trazas = Traza_User::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
            'valores_modificados' => 'Datos de Usuario: '.$request['users'].' || Activo || '.$rol]);

            Alert()->success('Usuario Creado Satisfactoriamente');
            return redirect()->route('users.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $roles = Role::pluck('name','id')->all();
        return view('users.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name','id')->all();
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        $user->id;
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->roles()->sync($request->roles);

        $roles = Role::Where('id', $request['roles'])->get();
        foreach($roles as $role){
            $rol = $role['name'];
        }

        $id_user = Auth::user()->id;
        $id_Accion = 2; //Actualización
        $trazas = Traza_User::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
        'valores_modificados' => 'Datos de Usuario: '.$request['users'].' || Activo || '.$rol]);
    
        Alert()->success('Usuario Actualizado Satisfactoriamente');
        return redirect()->route('users.index');
    }

    public function ResetPassword($id){
        
        $user = User::join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
        ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->select('persons.cedula', 'users.users')->Where('users.id', $id)->get();
        foreach($user as $usr)
        {
            $password = 'pm*'.$usr['cedula'].'..';
            $usuario = $usr['users'];
        }
        $bcrypt = bcrypt($password);
        $reset_password = User::find($id, ['id']);
        $reset_password->update(['password'=>$bcrypt]);

        $id_user = Auth::user()->id;
        $id_Accion = 2; //Actualización
        $trazas = Traza_User::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
        'valores_modificados' => 'Se reseteó la contraseña del Usuario: '.
        $usuario.'. Se colocó la contraseña genérica']);

        Alert()->success('Reinicio de Contraseña realizado', 'Nueva Contraseña: '.$password);
        return back(); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_status($id)
    {
        $user = User::Where('id', $id)->get();
        
        foreach($user as $usr)
        {
            $status = $usr['status'];
            $usuario = $usr['users'];
        }

        if($status == true)
        {
            $estatus = false;
            $notificacion = 'Inactivo';
        }else{
            $estatus = true;
            $notificacion = 'Activo';
        }
        $users = User::find($id, ['id']);
        $users->update(['status' => $estatus]);

        $id_user = Auth::user()->id;
        $id_Accion = 2; //Actualización
        $trazas = Traza_User::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
        'valores_modificados' => 'Datos de Usuario: '.
        $usuario.' || '.$notificacion]);

        Alert()->success('Estatus de Usuario Actualizado', 'Nuevo Estatus: '.$notificacion);
        return redirect()->route('users.index');
    }
}
