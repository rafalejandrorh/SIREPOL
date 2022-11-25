<?php

namespace App\Http\Controllers;

use App\Models\Sessions;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    function __construct()
    {
        $this->middleware('can:sessions.index')->only('index');
        $this->middleware('can:sessions.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->tipo_busqueda == 'cedula'){
            $sessions = Sessions::join('users', 'users.id', '=', 'sessions.user_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->orderBy('last_activity', 'DESC')
            ->Where('persons.cedula', '=', $request->buscador)->paginate(10);

        }else if($request->tipo_busqueda == 'credencial'){
            $sessions = Sessions::join('users', 'users.id', '=', 'sessions.user_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->orderBy('last_activity', 'DESC')
            ->Where('funcionarios.credencial', '=', $request->buscador)
            ->paginate(10);

        }else if($request->tipo_busqueda == 'jerarquia'){
            $sessions = Sessions::join('users', 'users.id', '=', 'sessions.user_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
            ->orderBy('last_activity', 'DESC')
            ->Where('jerarquia.valor', 'ilike', '%'.$request->buscador.'%')
            ->paginate(10);

        }else if($request->tipo_busqueda == 'usuario'){
            $sessions = Sessions::join('users', 'users.id', '=', 'sessions.user_id')
            ->Where('users.users', 'ilike', '%'.$request->buscador.'%')->paginate(10);

        }else if($request->tipo_busqueda == 'nombre'){
            $sessions = Sessions::join('users', 'users.id', '=', 'sessions.user_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_nombre', 'ilike', '%'.$request->buscador.'%')
            ->paginate(10);

        }else if($request->tipo_busqueda == 'apellido'){
            $sessions = Sessions::join('users', 'users.id', '=', 'sessions.user_id')
            ->join('funcionarios', 'funcionarios.id', '=', 'users.id_funcionario')
            ->join('persons', 'persons.id', '=', 'funcionarios.id_person')
            ->Where('persons.primer_apellido', 'ilike', '%'.$request->buscador.'%')
            ->paginate(10);

        }else{
            $sessions = Sessions::orderBy('last_activity', 'DESC')
            ->paginate(10);
        }

        return view('sessions.index', compact('sessions'));
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
        //
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
    public function destroy(Request $request)
    {
        Sessions::where('id', $request->session)->delete();

        Alert()->success('La Sesión ha sido finalizada Exitosamente');
        return redirect()->route('sessions.index');
    }
}
