<?php
namespace App\ComboDependientes\Base;


/**
* Fabrica de Repositorios se encarga de crear los diferentes tipos de repositorios.
*/
abstract class AbstractRepository
{
	abstract public function GetModel();

    /**
     * find function
     *
     * @param [type] $id
     * @return void
     */
    public function GetFind($id)
    {
        return $this->GetModel()->find($id);
    }
    /**
     * getAll function
     *
     * @return void
     */
    public function GetAll()
    {
        return $this->GetModel()->all();
    }

    public function Where($var1, $var2)
    {
        return $this->GetModel()->where($var1, $var2)->get();
    }
    /**
     * getAll function
     *
     * @return void
     */
    public function GetAllWhere($val1, $val2)
    {
        return $this->GetModel()->where($val1, $val2)->all();
    }
    /**
     * Undocumented function
     *
     * @return void
     */
    public function Count()
    {
        return count($this->GetModel()->all());
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function CountWhere($val1, $val2)
    {
        return count($this->GetModel()->where($val1, $val2)->all());
    }
    /**
     * Undocumented function
     *
     * @param [type] $var comparada
     * @param [type] $var2 igualada
     * @return void
     */
    public function Search($var, $var2)
    {
        return $this->GetModel()->where($var, $var2);
    }
    /**
     * create function
     *
     * @param [type] $data
     * @return void
     */
    public function Create(array $data)
    {
        return $this->GetModel()->create($data);
    }
    /**
     * update function
     *
     * @param [type] $object
     * @param [type] $data
     * @return void
     */
    public function Update(array $data, $id)
    {
        $object = $this->GetModel()->find($id);
        $object->fill($data);
        return $object->save();
    }
    /**
     * delete function
     *
     * @param [type] $object
     * @return void
     */
    public function Delete($object)
    {
        //si object es un id
        if (is_numeric($object)) {
            $object = $this->GetModel()->find($object);
        }
        $object->delete();
        
	}
}