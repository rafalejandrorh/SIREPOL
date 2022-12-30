<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class MapsGeoreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

        /**
     * Display a search of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchLocation(Request $request)
    {
        if(isset($request->buscador))
        {
            try{
                $location = Mapper::location($request->buscador);
                $long = $location->getLongitude();
                $lat = $location->getLatitude();
                $geodata = array(
                    'busqueda' => $location->getSearch(),
                    'direccion' => $location->getAddress(),
                    'estado' => $location->getState(),
                    'ciudad' => $location->getCity(),
                    'municipio' => $location->getMunicipality(),
                    'sector' => $location->getSector(),
                    'calle' => $location->getStreet(),
                    'coordenadas' => $location->getLongitude().', '.$location->getLatitude()
                );
                Mapper::map(10.216264, -66.859045, ['marker' => false, 'zoom' => 6.5, 'center' => true, 'type' => 'TERRAIN']);
                Mapper::marker($lat, $long, ['animation' => 'DROP']);
            }catch (Exception $e){
                $long = 10.216264;
                $lat = -66.859045;
                Mapper::map($long, $lat, ['marker' => false, 'zoom' => 6.5, 'center' => true, 'type' => 'TERRAIN']);
                Alert()->warning('No se encontraron Resultados para su Búsqueda');
                return view('georeference.searchLocation');
            }
        }else{
            $geodata = null;
            $long = 10.216264;
            $lat = -66.859045;
            Mapper::map($long, $lat, ['marker' => false, 'zoom' => 6.5, 'center' => true, 'type' => 'TERRAIN']);
        }

        return view('georeference.searchLocation', compact('geodata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
