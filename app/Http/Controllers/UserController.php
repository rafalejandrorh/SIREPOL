<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Person;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Estatus_Funcionario;
use App\Models\Funcionario;
use App\Models\Genero;
use App\Models\Geografia_Venezuela;
use App\Models\Jerarquia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Traza_User;
use Illuminate\Support\Facades\Validator;

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
        $genero = Genero::pluck('valor', 'id')->all();
        $jerarquia = Jerarquia::pluck('valor', 'id')->all();
        $estatus = Estatus_Funcionario::pluck('valor', 'id')->all();
        $estado = Geografia_Venezuela::Where('id_padre', 107)->pluck('valor', 'id')->all();
        return view('users.create',compact('roles', 'genero', 'jerarquia', 'estatus', 'estado'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = Validator::make($request->all(),User::returnValidations(),User::returnMessages())->validate();

        // if ($user->fails())
        // {
        //     return redirect()->back()->withInput()->withErrors($user->errors());
        // }

        $person = new Person();
        $funcionario = new Funcionario();
        $usuario = new User();

        $cedula = $request['cedula'];
        $obtener_persona = $person->where('cedula','=',$cedula)->get();
        $validar_persona = $person->where('cedula','=',$cedula)->exists();
        if($validar_persona == true){
            $obtener_funcionario = $funcionario->where('id_person','=',$obtener_persona[0]['id'])->get();
            $validar_funcionario = $funcionario->where('id_person','=',$obtener_persona[0]['id'])->exists();
            if($validar_funcionario == true){
                $obtener_usuario = $usuario->where('id_funcionario','=',$obtener_funcionario[0]['id'])->get();
                $validar_usuario = $usuario->where('id_funcionario','=',$obtener_funcionario[0]['id'])->exists();
                if($validar_usuario == true){
                    Alert()->info('El funcionario ya posee un Usuario.');
                    return redirect()->route('users.index');
                }
            }
        }     

        if($validar_persona == false){
            $request = $request->all();

            $request['password'] = bcrypt($request['password']);

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
            //$id_person = $person->Where('cedula', $request['cedula'])->pluck('id');

            $funcionario->credencial = $request['credencial'];
            $funcionario->id_jerarquia = $request['id_jerarquia'];
            $funcionario->telefono = $request['telefono'];
            $funcionario->id_person = $id_person;
            $funcionario->id_estatus = $request['id_estatus'];
            $funcionario->save();
            $id_funcionario = $funcionario->id;

            $usuario->id_funcionario = $id_funcionario;
            $usuario->users = $request['users'];
            $usuario->password = $request['password'];
            $usuario->status = 'true';
            $usuario->save();

            $usuario->assignRole($request['roles']);

            $geografia_venezuela = Geografia_Venezuela::get();
            $estatus_laboral = Estatus_Funcionario::get();
            $jerarquia = Jerarquia::get();
            $generos = Genero::get();
            $roles = Role::get();

            $genero_for = $generos->Where('id', $request['id_genero']);
            foreach($genero_for as $genero){
                $genero = $genero['valor'];
            }
            $estado_nacimiento_for = $geografia_venezuela->Where('id', $request['id_estado_nacimiento']);
            foreach($estado_nacimiento_for as $estado_nacimiento){
                $estado_nacimiento = $estado_nacimiento['valor'];
            }
            $id_jerarquia_for = $jerarquia->Where('id', $request['id_jerarquia']);
            foreach($id_jerarquia_for as $jerarquia){
                $jerarquia = $jerarquia['valor'];
            }
            $roles_for = $roles->Where('id', $request['roles']);
            foreach($roles_for as $roles){
                $rol = $roles['valor'];
            }
            $estatus_laboral_for = $estatus_laboral->Where('id', $request['id_estatus']);
            foreach($estatus_laboral_for as $estatus){
                $estatus_laboral = $estatus['valor'];
            }


            $id_user = Auth::user()->id;
            $id_Accion = 1; //Registro
            $trazas = Traza_User::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
            'valores_modificados' => 'Datos de Usuario: '.
            'V'.$request['cedula'].' || '.$request['primer_nombre'].' || '.$request['segundo_nombre'].' || '.$request['primer_apellido'].' || '.
            $request['segundo_apellido'].' || '.$genero.' || '.$request['fecha_nacimiento'].' || '.$estado_nacimiento.' || '.$request['credencial'].' || '.
            $jerarquia.' || '.$request['telefono'].' || '.$estatus_laboral.' || '.$request['users'].' || Activo || '.
            $rol]);

            Alert()->success('Usuario Creado Satisfactoriamente');
            return redirect()->route('users.index');
        }

        if($validar_persona == true and $validar_funcionario == false){

            $obtener_funcionario = $funcionario->where('id_person','=',$obtener_persona[0]['id'])->get();
            $request = $request->all();
            $request['password'] = bcrypt($request['password']);

            $funcionario->credencial = $request['credencial'];
            $funcionario->id_jerarquia = $request['id_jerarquia'];
            $funcionario->telefono = $request['telefono'];
            $funcionario->id_person = $obtener_persona[0]['id'];
            $funcionario->id_estatus = $request['id_estatus'];
            $funcionario->save();
            $id_funcionario = $funcionario->id;

            $usuario->id_funcionario = $id_funcionario;
            $usuario->users = $request['users'];
            $usuario->password = $request['password'];
            $usuario->status = 'true';
            $usuario->save();

            $usuario->assignRole($request['roles']);

            $jerarquia = Jerarquia::get();
            $roles = Role::get();
            $estatus_laboral = Estatus_Funcionario::get();
            $id_jerarquia_for = $jerarquia->Where('id', $request['id_jerarquia']);
            foreach($id_jerarquia_for as $jerarquia){
                $jerarquia = $jerarquia['valor'];
            }
            $roles_for = $roles->Where('id', $request['roles']);
            foreach($roles_for as $roles){
                $rol = $roles['valor'];
            }
            $estatus_laboral_for = $estatus_laboral->Where('id', $request['id_estatus']);
            foreach($estatus_laboral_for as $estatus){
                $estatus_laboral = $estatus['valor'];
            }

            $id_user = Auth::user()->id;
            $id_Accion = 1; //Registro
            $trazas = Traza_User::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
            'valores_modificados' => 'Datos de Usuario: '.
            $request['credencial'].' || '.
            $jerarquia.' || '.$request['telefono'].' || '.$estatus_laboral.' || '.$request['users'].' || Activo || '.
            $rol]);

            Alert()->success('Usuario Creado Satisfactoriamente','Atención: El ciudadano que registró no poseía registro como funcionario, se actualizó como funcionario y se asignó el Usuario');
            return redirect()->route('users.index');
        }
        
        if($validar_persona == true and $validar_funcionario == true and $validar_usuario == false){

            $request = $request->all();
            $password = $request['password'];
            $bcrypt = bcrypt($password);

            $usuario->id_funcionario = $obtener_funcionario[0]['id'];
            $usuario->users = $request['users'];
            $usuario->password = $bcrypt;
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
            'valores_modificados' => 'Datos de Usuario: '.
            $request['users'].' || Activo || '.$rol]);


            Alert()->success('Usuario Creado Satisfactoriamente','Atención: El funcionario ya estaba registrado en el sistema, solamente se creó y asignó el Usuario.');
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
        $genero = Genero::pluck('valor', 'id')->all();
        $jerarquia = Jerarquia::pluck('valor', 'id')->all();
        $estatus = Estatus_Funcionario::pluck('valor', 'id')->all();
        $estado = Geografia_Venezuela::Where('id_padre', 107)->pluck('valor', 'id')->all();
        return view('users.edit', compact('user', 'roles', 'genero', 'jerarquia', 'estatus', 'estado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  User $user)
    {
        
        $user->update($request->all());
        $user->id;
        $user->funcionario()->update($request->all('credencial', 'id_jerarquia', 'telefono', 'id_estatus'));
        $user->funcionario->person()->update($request->all('primer_nombre', 'segundo_nombre', 'primer_apellido',
        'segundo_apellido', 'id_genero', 'fecha_nacimiento', 'id_estado_nacimiento'));
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->roles()->sync($request->roles);

        $geografia_venezuela = Geografia_Venezuela::get();
        $jerarquia = Jerarquia::get();
        $generos = Genero::get();
        $estatus_laboral = Estatus_Funcionario::get();
        $roles = Role::Where('id', $request['roles'])->get();
        foreach($roles as $role){
            $rol = $role['name'];
        }
        $genero_for = $generos->Where('id', $request['id_genero']);
        foreach($genero_for as $genero){
            $genero = $genero['valor'];
        }
        $estado_nacimiento_for = $geografia_venezuela->Where('id', $request['id_estado_nacimiento']);
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
        $trazas = Traza_User::create(['id_user' => $id_user, 'id_accion' => $id_Accion, 
        'valores_modificados' => 'Datos de Usuario: '.
        'V'.$request['cedula'].' || '.$request['primer_nombre'].' || '.$request['segundo_nombre'].' || '.$request['primer_apellido'].' || '.
        $request['segundo_apellido'].' || '.$genero.' || '.$request['fecha_nacimiento'].' || '.$estado_nacimiento.' || '.$request['credencial'].' || '.
        $jerarquia.' || '.$request['telefono'].' || '.$estatus_laboral.' || '.$request['users'].' || Activo || '.
        $rol]);
    
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
