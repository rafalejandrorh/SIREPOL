<?php

namespace App\Http\Controllers;

use App\Models\Jerarquia;
use Illuminate\Http\Request;

class JerarquiaController extends Controller
{
    public function getJerarquiaByOrganismo(Request $request)
    {
        $jerarquia = Jerarquia::Where('id_organismo', $request->jerarquia)->select('valor', 'id')->get();
        return response()->json($jerarquia);
    }
}
