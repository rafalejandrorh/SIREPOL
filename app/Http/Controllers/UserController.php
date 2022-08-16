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

class UserController extends Controller
{
    function __construct()
    {

        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create');
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.destroy')->only('destroy');
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(5);
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
                    $request = $request->all();
                    $usuario = User::find($obtener_usuario[0]['id']);
                    $request['password'] = bcrypt($request['password']);
                    $usuario->update(['status' => 'true', 'password' => $request['password'], 
                    'users' => $request['user'], 'id_funcionario' => $obtener_funcionario[0]['id']]);
                    $usuario->assignRole($request['roles']);
                    return redirect()->route('users.index')->with('registrar', 'Ok');
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
            $funcionario->id_estatus = $request['estatus_funcionario'];
            $funcionario->save();
            $id_funcionario = $funcionario->id;

            $usuario->id_funcionario = $id_funcionario;
            $usuario->users = $request['user'];
            $usuario->password = $request['password'];
            $usuario->status = 'true';
            $usuario->save();

            $usuario->assignRole($request['roles']);

            return redirect()->route('users.index')->with('registrar', 'Ok');
        }

        if($validar_persona == true and $validar_funcionario == false){

            $obtener_funcionario = $funcionario->where('id_person','=',$obtener_persona[0]['id'])->get();
            $request = $request->all();
            $request['password'] = bcrypt($request['password']);

            $funcionario->credencial = $request['credencial'];
            $funcionario->id_jerarquia = $request['id_jerarquia'];
            $funcionario->telefono = $request['telefono'];
            $funcionario->id_person = $obtener_persona[0]['id'];
            $funcionario->id_estatus = $request['estatus_funcionario'];
            $funcionario->save();
            $id_funcionario = $funcionario->id;

            $usuario->id_funcionario = $id_funcionario;
            $usuario->users = $request['user'];
            $usuario->password = $request['password'];
            $usuario->status = 'true';
            $usuario->save();

            $usuario->assignRole($request['roles']);

            return redirect()->route('users.index')->with('registrar', 'Ok');
        }
        
        if($validar_persona == true and $validar_funcionario == true and $validar_usuario == false){

            $request = $request->all();
            $password = $request['password'];
            $bcrypt = bcrypt($password);

            $usuario->id_funcionario = $obtener_funcionario[0]['id'];
            $usuario->users = $request['user'];
            $usuario->password = $bcrypt;
            $usuario->status = 'true';
            $usuario->save();

            $usuario->assignRole($request['roles']);


            return redirect()->route('users.index')->with('registrar', 'Ok');
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
    public function update(Request $request, $id)
    {

        $user = User::find($id, ['id']);
        $user->update($request->all('users'));
        $user->funcionario()->update($request->all('credencial', 'id_jerarquia', 'telefono', 'id_estatus'));
        $user->funcionario->person()->update($request->all('primer_nombre', 'segundo_nombre', 'primer_apellido',
        'segundo_apellido', 'id_genero', 'fecha_nacimiento', 'id_estado_nacimiento'));
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->roles()->sync($request->roles);
    
        return redirect()->route('users.index')->with('Datos actualizados con éxito')->with('editar', 'Ok');
    }

    public function ResetPassword($id){
        
        $user = User::join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
        ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->select('persons.cedula')->Where('users.id', $id)->get();
        foreach($user as $usr)
        {
            $password = 'pm*'.$usr['cedula'].'..';
        }
        $bcrypt = bcrypt($password);
        $reset_password = User::find($id, ['id']);
        $reset_password->update(['password'=>$bcrypt]);
        return back()->with('reset', 'Ok'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id, ['id']);
        if($user['status'] == true)
        {
            $status = false;
        }else{
            $status = true;
        }
        $user->update(['status' => $status]);
        return redirect()->route('users.index')->with('status', 'Ok');
    }
}
