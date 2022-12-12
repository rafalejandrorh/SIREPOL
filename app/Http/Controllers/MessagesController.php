<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function abstract()
    {
        // $data[] = array(
        //     'user' => 'rafael.rivero',
        //     'message' => 'hola mundo'
        // );
        // $data[] = array(
        //     'user' => 'fabian.rivero',
        //     'message' => 'hola tierra'
        // );
        $data = null;
        $user_id = Auth::user()->id;
        $user = new User();
        $dataUser = $user->WhereNot('id', $user_id)->orderBy('id', 'DESC')->get();
        if(count($dataUser) > 0)
        {
            $i = 0;
            while($i < count($dataUser)){
                $dataMessage = DB::select('SELECT * from messages WHERE (incoming_id_user = '.$dataUser[$i]['id'].'
                OR outgoing_id_user = '.$dataUser[$i]['id'].') AND (outgoing_id_user = '.$user_id.' 
                OR incoming_id_user = '.$user_id.') ORDER BY id DESC LIMIT 1');
                if(isset($dataMessage) && $dataMessage != null)
                {
                    strlen($dataMessage[0]->message) > 28 ? substr($dataMessage[0]->message, 0, 28).'...' : $dataMessage[0]->message = $dataMessage[0]->message; 
                    $dataMessage[0]->incoming_id_user == $user_id ? $dataMessage[0]->message = 'Tú: '.$dataMessage[0]->message : $dataMessage[0]->message = $dataMessage[0]->message;    
                    $data[] = array(
                        'incoming_id_user' => $dataMessage[0]->incoming_id_user,
                        'outgoing_id_user' => $dataMessage[0]->outgoing_id_user,
                        'message' => $dataMessage[0]->message
                    );
                };
                $i++;
            }

            // Falta pasar los usuarios en lugar de los user_id
    
            dd($data);die;
        }    


        $href = "http://192.168.0.101/SIREPOL/sesion";
        $data = null;
        $data.= '<a class="dropdown-item has-icon" href="'.$href.'"> Rafael Rivero</a>';
        $data.= '<a class="dropdown-item has-icon" href="'.$href.'"> Fabian Rivero</a>';
        return $data;
    }

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
