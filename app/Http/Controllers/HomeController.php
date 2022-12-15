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
        $dateYM = date('Y-m');
        $dateY = date('Y');
        $dateYMD = date('Y-m-d');

        //$countSessions = Sessions::count();
        //$countUsers = User::Where('status', true)->count();
        $countResennasAnno = Resenna::WhereBetween('created_at', [$dateY.'-01-01', $dateY.'-12-31'])->count();
        $countResennasMes = Resenna::WhereBetween('created_at', [$dateYM.'-01', $dateYM.'-31'])->count();
        $countResennasDia = Resenna::Where('created_at', $dateYMD)->count();
        $QR = QrCode::size(170)->style('round')->geo(10.249304786553445, -66.85708425051814);
        //'countSessions', 'countUsers'
        return view('home', compact('QR', 'countResennasAnno', 'countResennasMes', 'countResennasDia'));
    }
}
