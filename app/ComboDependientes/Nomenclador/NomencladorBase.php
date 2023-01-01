<?php 
namespace App\ComboDependientes\Nomenclador;

use App\ComboDependientes\Base\AbstractRepository as Repository;
use App\Models\Geografia;
/**
* 
*/
class NomencladorBase extends Repository
{

	private $datos;
	private $status;
	
	public function GetModel()
	{
		return new Geografia();
	}
	/**
	 * [Pluck description]
	 * @param [type] $val1 [description]
	 * @param [type] $val2 [description]
	 */
	public function Pluck($val1, $val2)
	{
		//return $this->GetModel()->all()->where($val1, $val2)->pluck('valor', 'id_hijo');
		return $this->GetModel()->all()->where($val1, $val2)->sortBy('valor')->pluck('valor', 'id_hijo');
	}

	public function Combos()
	{
	  return $combo =
	  [
		'estados'=> $this->GetModel()->Where('id_padre', 107)->pluck('valor','id'),
		'municipios'=> $this->GetModel()->Where('id_padre', 108)->pluck('valor','id'),
		'parroquias'=> $this->GetModel()->Where('id_padre', 109)->pluck('valor','id'),
		// 'caracteristicas'=> $this->GetModel()->Where('id_padre', 238)->orderBy('valor')->pluck('valor','id'),
		// //'caracteristicas'=> $this->GetModel()->Where('id_padre', 238)->pluck('valor','id'),
		// 'descripcion'=> $this->GetModel()->Where('id_padre', 239)->pluck('valor','id'),
		// 'participacion'=> $this->GetModel()->Where('id_padre', 31)->orderBy('valor')->pluck('valor','id'),
		// 'rango'=> $this->GetModel()->Where('id_padre', 32)->pluck('valor','id'),

	  ];
	}

	public function nomencladorCombo($id) {
		return $this->GetModel()->GetAll()->where('id_padre', '=', $id)->pluck('valor', 'id');
	  }
	
	/**
	 * [PluckNomenclador description]
	 * @param [type] $val1 [description]
	 * @param [type] $val2 [description]
	 */
	public function Combo($var)
	{
		return $this->GetModel()->Where('id',$var)->pluck('valor','id'); 
	}

	public function Delitos()
	{
		return $this->GetModel()->Where('id_padre','=',94); 
	}
}
