<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Historial_Sesion;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Arr;
use Illuminate\Http\JsonResponse;
use Alert;
use App\Events\LoginHistorialEvent;
use App\Events\LogoutHistorialEvent;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'users';
    }

    public function index()
    {
        //request:: root o url para ruta de aplicación

        //$QR = QrCode::size(80)->generate($url);
        return view('auth.login');
    }

    ///////////////////////////////////////////////////////////////////////

    public function credentials(Request $request)
    {
        //return $request->only($this->username(), 'password');

        $credenciales = $request->only($this->username(), 'password');
        $credenciales = Arr::add($credenciales, 'status', 'true');
        return $credenciales ;
        
    }

    public function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        Alert()->toast('Inicio de Sesión Exitoso','success');
        return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
    }

    public function authenticated(Request $request, $user)
    {

        if(session('id_historial_session') != null)
        {
            $sesion = Historial_Sesion::find(session('id_historial_sesion'), ['id']);
            $sesion->logout = now();
            $sesion->save();
            session()->forget('id_historial_sesion');
        };

        $explode = explode(' ', exec('getmac'));
        $MAC = $explode[0];

        $id_historial_sesion = event(new LoginHistorialEvent($user->id, $MAC));
        session(['id_historial_sesion' => $id_historial_sesion[0]]);

    }

    public function logout(Request $request)
    {
        event(new LogoutHistorialEvent(session('id_historial_sesion'), $request->id));
        session()->forget('id_historial_sesion');
        
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        if($request->id == 1){
            Alert()->toast('Haz cerrado sesión en el Sistema','info');
        }else if($request->id == 2){
            Alert()->toast('Cierre de Sesión por período de Inactividad','info');
        }
        
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

}
