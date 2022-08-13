<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;
use App\Models\Estatus_Funcionario;
use App\Models\Funcionario;
use App\Models\Genero;
use App\Models\Geografia_Venezuela;
use App\Models\Jerarquia;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $person = Person::all();
        $funcionario = Funcionario::all();

        return view('users.index', ['Users' => $user, 'persons' => $person, 'funcionario' => $funcionario]);
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
        //print_r($estado);die;
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
        if($validar_persona==true){
            $obtener_funcionario = $funcionario->where('id_person','=',$obtener_persona[0]['id'])->get();
            $validar_funcionario = $funcionario->where('id_person','=',$obtener_persona[0]['id'])->exists();
            if($validar_funcionario==true){
                $obtener_usuario = $usuario->where('id_funcionario','=',$obtener_funcionario[0]['id'])->get();
                $validar_usuario = $usuario->where('id_funcionario','=',$obtener_funcionario[0]['id'])->exists();
            }
        }
        
        Validator::make($request->all(),User::returnValidations(),User::returnMessages())->validate();        

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
            $usuario->save();

            $usuario->assignRole($request['roles']);

            // $funcionario = $person->create($request);
            // $user = $funcionario->person()->create($request); 
            // $role = $user->user()->create($request);
            //$role->roles()->sync($request['roles']);

            // dd ($funcionario);
            return redirect()->route('users.index')->with('Datos actualizados con éxito');
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
            $usuario->save();

            $usuario->assignRole($request['roles']);

            // $credencial = $request['credencial'];
            // $id_jerarquia = $request['id_jerarquia'];
            // $telefono = $request['telefono'];
            // $id_person = $obtener_persona[0]['id'];
            // $id_estatus = $request['estatus_funcionario'];
            //$user = $funcionario->create(['credencial' => $credencial,'id_jerarquia' => $id_jerarquia, 'telefono' => $telefono, 
            //'id_person' => $id_person, 'id_estatus'=> $id_estatus]); 
            //$role = $user->user()->create($request);
            //$role->roles()->sync($request['roles']);

            return redirect()->route('users.index')->with('Datos actualizados con éxito');
        }
        
        if($validar_persona == true and $validar_funcionario == true and $validar_usuario == false){

            $request = $request->all();
            $password = $request['password'];
            $bcrypt = bcrypt($password);

            $usuario->id_funcionario = $obtener_funcionario[0]['id'];
            $usuario->users = $request['user'];
            $usuario->password = $bcrypt;
            $usuario->save();

            $usuario->assignRole($request['roles']);

            // $usuario = $request['usuario'];
            // $email = $request['email'];
            // $funcionario = $obtener_funcionario[0]['id'];
            // $role = $usuario->create(['usuario'=> $usuario, 'email'=> $email, 'password'=> $bcrypt,'id_funcionario'=> $funcionario]);
            // $role->roles()->sync($request['roles']);


            return redirect()->route('users.index')->with('Datos actualizados con éxito');
            // dd($role);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::pluck('name','id')->all();
        $genero = Genero::pluck('valor', 'id')->all();
        $jerarquia = Jerarquia::pluck('valor', 'id')->all();
        $estatus = Estatus_Funcionario::pluck('valor', 'id')->all();
        $estado = Geografia_Venezuela::Where('id_padre', 107)->pluck('valor', 'id')->all();
        $user = User::find($id);
        return view('users.edit',compact('roles', 'genero', 'jerarquia', 'estatus', 'estado', ['user' => $user]));//
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        $usuario->delete();
        return redirect()->route('users.index');
    }
}
