<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Geografia;

class GeografiaVenezuelaController extends Controller
{

  public function getMunicipios($tipo, $id_hijo)
  {
    if($id_hijo == 9865879){
      $arreglo = Geografia::where('id_padre','=',$tipo)->pluck('valor','id')->get();
      foreach ($arreglo as $code => $name) {
          echo "<option value=\"$code\">$name</option>";
      }
    }else{
      $arreglo = Geografia::all()
      ->where('id_hijo','=',$id_hijo)
      ->where('id_padre','=',$tipo)
      ->pluck('valor','id');
      foreach ($arreglo as $code => $name) {
          echo "<option value=\"$code\">$name</option>";
      }  
    }
  } 

}
