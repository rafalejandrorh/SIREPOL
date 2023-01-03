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
use App\Http\Controllers\UserController;
use App\Models\Sessions;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function login(Request $request)
    {
        $validacion_user = User::Where('users', $request->users)->exists();
        if($validacion_user == true)
        {
            $users = User::Where('users', '=', $request->users)->get();
            $id_user = $users[0]['id'];
            $password = $users[0]['password'];

            $validacion_sesion = Sessions::Where('user_id', $id_user)->exists();
            if($validacion_sesion == false)
            {   
                $validacion_password = Hash::check(request('password'), $password);
                if($validacion_password == true)
                {
                    $this->validateLogin($request);

                    // If the class is using the ThrottlesLogins trait, we can automatically throttle
                    // the login attempts for this application. We'll key this by the username and
                    // the IP address of the client making these requests into this application.
                    if (method_exists($this, 'hasTooManyLoginAttempts') &&
                        $this->hasTooManyLoginAttempts($request)) {
                        $this->fireLockoutEvent($request);

                        return $this->sendLockoutResponse($request);
                    }

                    if ($this->attemptLogin($request)) {
                        if ($request->hasSession()) {
                            $request->session()->put('auth.password_confirmed_at', time());
                        }

                        return $this->sendLoginResponse($request);
                    }

                    // If the login attempt was unsuccessful we will increment the number of attempts
                    // to login and redirect the user back to the login form. Of course, when this
                    // user surpasses their maximum number of attempts they will get locked out.
                    $this->incrementLoginAttempts($request);

                    return $this->sendFailedLoginResponse($request);
                }else{
                    Alert()->warning('Contraseña Incorrecta');
                    return back();
                }
            }else{
                Alert()->warning('El Usuario ya posee una sesión activa');
                return back(); 
            }
        }else{
            Alert()->warning('Usuario Incorrecto');
            return back();
        }
    }

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

        $response = $this->authenticated($request, $this->guard()->user());

        if($response)
        {
            Alert()->warning('Atención', 'Por Razones de Seguridad, debe cambiar su contraseña.');
            return app(UserController::class)->settings($response);
        }else{
            Alert()->toast('Inicio de Sesión Exitoso','success');
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
        }
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

        return $user->password_status;
    }

    public function logout(Request $request)
    {
        event(new LogoutHistorialEvent(session('id_historial_sesion'), $request->id, null));
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
        
        return redirect('/');
    }

}
