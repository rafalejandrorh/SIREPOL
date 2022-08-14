<?php

namespace App\Http\Controllers;

use App\Models\Caracteristicas_Resennado;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\Resenna;
use App\Models\Genero;
use App\Models\Geografia_Venezuela;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ResennaController extends Controller
{
    function __construct()
    {

        $this->middleware('can:resenna.index')->only('index');
        $this->middleware('can:resenna.create')->only('create');
        $this->middleware('can:resenna.show')->only('show');
        $this->middleware('can:resenna.edit')->only('edit', 'update');
        $this->middleware('can:resenna.destroy')->only('destroy');
 
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resenna = Resenna::paginate(5);
        return view('resenna.index', ['resennas' => $resenna]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genero = Genero::pluck('valor', 'id')->all();
        $estado_civil = Caracteristicas_Resennado::Where('id_padre', 241)->pluck('valor', 'id')->all();
        $profesion = Caracteristicas_Resennado::Where('id_padre', 234)->pluck('valor', 'id')->all();
        $motivo_resenna = Caracteristicas_Resennado::Where('id_padre', 94)->pluck('valor', 'id')->all();
        $tez = Caracteristicas_Resennado::Where('id_padre', 240)->pluck('valor', 'id')->all();
        $contextura = Caracteristicas_Resennado::Where('id_padre', 243)->pluck('valor', 'id')->all();
        $estado = Geografia_Venezuela::Where('id_padre', 107)->pluck('valor', 'id')->all();
        //$funcionario_resenna = Funcionario::all();
        //$funcionario_aprehensor = Funcionario::all();
        $funcionario_resenna = Funcionario::join('persons', 'persons.id', '=', 'funcionarios.id_person')
        ->join('jerarquia', 'jerarquia.id', '=', 'funcionarios.id_jerarquia')
        ->select('funcionarios.id', 'persons.primer_nombre', 'persons.primer_apellido', 'jerarquia.valor')->get();
        return view('resenna.create', compact('genero', 'estado_civil', 'profesion', 'motivo_resenna', 'tez', 'contextura', 'estado', 'funcionario_resenna'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
