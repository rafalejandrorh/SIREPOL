<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Geografia_Venezuela;

class GeografiaVenezuelaController extends Controller
{

    public function getCombos($tipo,$id)
    {
        // dd($tipo.'-'.$id);
      if($id == 9865879){
        $arreglo = Geografia_Venezuela::all()->where('id_padre','=',$tipo)->pluck('valor','id');
        foreach ($arreglo as $code => $name) {
            echo "<option value=\"$code\">$name</option>";
        }
      }else{
        $arreglo = Geografia_Venezuela::all()
        ->where('id_hijo','=',$id)
        ->where('id_padre','=',$tipo)
        ->pluck('valor','id');
        foreach ($arreglo as $code => $name) {
            echo "<option value=\"$code\">$name</option>";
        }  
      }
    } 

}
