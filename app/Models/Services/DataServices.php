<?php

namespace App\Models\Services;

require_once('Constantes.php');

use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ResennaController;
use Illuminate\Database\Eloquent\Model;

class DataServices extends Model
{
    private $metodo;
    private $parametros = array();

	public function getMetodo() {
        return $this->metodo;
    }
    
    public function setMetodo($metodo) {
        $this->metodo = $metodo;
        return $this;
    }

    public function getParametros() {
        return $this->parametros;
    }
    
    public function setParametros($parametros) {
        $this->parametros = $parametros;
        return $this;
    }

    function __construct(FuncionarioController $funcionario, ResennaController $resenna)
    {
        $this->funcionario = $funcionario;
        $this->resenna = $resenna;
    }

    public function Servicios(){
        if($this->metodo == ConsultaFuncionario){
            $result = $this->funcionario->SearchFuncionario($this->parametros);
        }else if($this->metodo == ConsultaResennado){
            $result = $this->resenna->SearchResennado($this->parametros);
        }else if($this->metodo == Login){
            //$result = $this->funcionario->SearchFuncionario($this->parametros);
        }else if($this->metodo == Logout){
            //$result = $this->funcionario->SearchFuncionario($this->parametros);
        }
        return $result;
    }

}