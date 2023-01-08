<?php

namespace App\Http\Controllers;

use App\Events\TrazasEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfiguracionesController extends Controller
{
    function __construct()
    {
        $this->middleware('can:configuraciones.index')->only('index');
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
}
