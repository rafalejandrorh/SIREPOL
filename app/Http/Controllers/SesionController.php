<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SesionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = Auth::user()->id;
        $user = User::Where('id', $data)->get();
        return view('sesion.index', compact('user', 'data'));
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
       
        $persona = User::where('id', '=', $id)->first();
        $validacion_password = Hash::check(request('curr_password'), $persona->password);
        if($validacion_password == true)
        {
            $validacion_password_new = Hash::check(request('password'), $persona->password);
            if($validacion_password_new == false)
            {
                $request['password'] = bcrypt($request['password']);
                $user = User::find($id, ['id']);
                $user->update(['password' => $request['password']]);
                return back()->with('actualizacion', 'Ok');
            }else{
                return back()->with('actualizacion', 'Nok');
            }
            

        }else{
            return back()->with('error', 'Ok');
        }

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
