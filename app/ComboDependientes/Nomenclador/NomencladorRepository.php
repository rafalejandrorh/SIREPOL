<?php
namespace App\ComboDependientes\Nomenclador;

use App\ComboDependientes\Base\BaseRepository;
use App\Models\Geografia;
/**
 * 
 */
class NomencladorRepository extends BaseRepository
{
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
		return $this->GetModel()->all()->pluck($val1, $val2);
	}
	/**
	 * [PluckNomenclador description]
	 * @param [type] $val1 [description]
	 * @param [type] $val2 [description]
	 */
	public function PluckNomenclador($val1, $val2)
	{
		return $this->GetModel()->where($val1,$val2)->pluck('valor','id')->all(); 
	}
}
