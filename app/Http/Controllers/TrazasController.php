<?php

namespace App\Http\Controllers;

use App\Models\Historial_Sesion;
use Illuminate\Http\Request;
use Alert;
use App\Models\Resenna;
use App\Models\Traza_Resenna;
use App\Models\Traza_Roles;
use App\Models\Traza_User;
use App\Models\User;
use Spatie\Permission\Models\Role;

class TrazasController extends Controller
{
    function __construct()
    {

        $this->middleware('can:trazas.index')->only('index');
 
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
    public function index_resenna()
    {
        $resennas = Traza_Resenna::paginate(10);
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
    public function index_usuarios()
    {
        $users = Traza_User::paginate(10);
        return view('trazas.users_index', compact('users'));
    }

    public function show_usuarios(Traza_User $user)
    {
        return view('trazas.users_show', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index_roles()
    {
        $roles = Traza_Roles::paginate(10);
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
    public function index_historial_sesion()
    {
        $historial_sesion = Historial_Sesion::paginate(10);
        return view('trazas.historial_sesion_index', compact('historial_sesion'));
    }

}
