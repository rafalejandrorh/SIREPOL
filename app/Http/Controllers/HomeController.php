<?php

namespace App\Http\Controllers;

use App\Models\Resenna;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $countSessions = Sessions::count();
        $countUsers = User::Where('status', true)->count();
        $countResennasDia = Resenna::Where('created_at', date('Y-m-d'))->count();
        $QR = QrCode::size(160)->style('round')->geo(10.249304786553445, -66.85708425051814);
        return view('home', compact('QR', 'countSessions', 'countUsers', 'countResennasDia'));
    }
}
