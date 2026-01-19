<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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


    public function showLoginForm()
    {
        return view('public.login');
    }



    public function login(Request $request)
    {
        // $this->clearLoginAttempts($request);

        //validar login

        // return var_dump( Hash::make("123123"));


        $captcha = $request->get('captcha');



        if ($captcha !=session('captcha')) {
            return response()->json([
                'success' => false,
                'errors' => 'Captcha incorrecto'
            ], 422);
        }


        $rules = [
            'usuario' => 'required|string|min:3|max:150',
            'password' => 'required|string|min:3|max:150'
        ];



        $validador = Validator::make($request->all(), $rules, [
            'usuario.required' => 'El Usuario es requerido',
            'usuario.min' => 'El usuario debe tener al menos 3 caracteres',
            'usuario.max' => 'El usuario debe tener como maximo 150 caracteres',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 3 caracteres',
            'password.max' => 'La contraseña debe tener como maximo 150 caracteres',
            'captcha.required' => 'El captcha es requerido',
            'tokenCaptcha.required' => 'Error en el captcha, recargue el captcha e intente nuevamente'
        ]);



        if ($validador->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validador->errors(),
            ], 422);
        }


        $credentials = array_merge($this->credentials($request), ['estado_usuario' => 'ACTIVO']);


        if (Auth::attempt($credentials)) {

            session()->forget('intentosFallidos');

            $request->session()->regenerate();


            $datosUsuario = Auth::user();
            $persona = $datosUsuario->persona;
            $roles = User::getRol($datosUsuario->id_rol_fk);


            // $request->session()->put('idUsuario', Auth::id());

            $request->session()->put('nombreUsuario', $datosUsuario->usuario);

            $request->session()->put('rolesUsuario', $roles);

            $request->session()->put('avatarUsuario',  $datosUsuario->us_avatar);

            User::verifyUserAvatar($persona, $datosUsuario->usuario);

            $request->session()->put('nombreCompletoUsuario', $persona->nombre . ' ' . $persona->paterno . ' ' . $persona->materno);


            $this->clearLoginAttempts($request);


            return response()->json([
                'success' => true,
                'message' => 'Bienvenido al sistema, sera redireccionado en 3 segundos',
                'url' => session('url.intended') ?? route('admin.home')
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => 'Usuario o contraseña incorrectos',
        ], 422);
    }


    public function username()
    {

        return 'usuario';
    }
}
