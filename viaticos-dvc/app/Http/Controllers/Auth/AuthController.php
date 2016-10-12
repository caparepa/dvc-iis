<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Exception;

use App\Models\User;
use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\QueryException;
use Illuminate\Contracts\Validation\ValidationException;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
        $this->redirectPath = route('viaticos/dashboard');
    }

    private function redirectAfterLogin( $message = null )
    {

        $user = Auth::user();

        if($user->rol != 'guest'){
            return redirect()
                ->intended( route('viaticos/dashboard') );
        }else{
            return redirect('/error');
        }

    }

    public function getRegister()
    {
        return view('auth.register');
    }

    public function postRegister(Request $request)
    {
        try {

            /*$validator = Validator::make($request->all(), [
                'nombre' => 'required|max:64',
                'apellido' => 'required|max:64',
                'email' => 'required|email|max:64|unique:users',
                'password' => 'required|confirmed|min:6',
            ]);

            if($validator->fails()){
                $messages = $validator->messages();
                throw new ValidationException($messages);
            }*/

            $usuario = new User;
            $usuario->nombre = $request->nombre;
            $usuario->apellido = $request->apellido;
            $usuario->cedula = $request->cedula;
            $usuario->rif = $request->rif;
            $usuario->telefono_hab = $request->telefono_hab;
            $usuario->telefono_cell = $request->telefono_cell;
            $usuario->email = $request->email;
            $usuario->password = \Hash::make($request->password);
            $usuario->rol = Usuario::ROL_USUARIO;
            $usuario->avatar = Usuario::DEFAULT_AVATAR;
            $usuario->status = Usuario::STATUS_PENDING;

            if($usuario->save()){
                return redirect( route('auth/login') )
                    ->with('message', 'Su cuenta ha sido creada.<br>
                        Pronto recibirá un mensaje en su correo con instrucciones para su acceso.');

            } else {
                dd('0a');
                throw new QueryException('Error al guardar usuario.');
            }


        } catch (ValidationException $e){
            $errors = $e->errors();
            \Log::info('ValidationException:');
            \Log::error($errors->getMessages());
            return back()
                ->withInput()
                ->with('message', 'Ha ocurrido un error de validación de datos.');
        } catch (QueryException $e) {
            $exMessage = $e->getMessage();
            \Log::info('QueryException:');
            \Log::error($exMessage);
            return back()
                ->withInput()
                ->with('message', 'Ha ocurrido un error. Por favor intente de nuevo.');
        }

    }

    public function getLogin(){
      return view('auth.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = [
            'email' =>  $request->email,
            'password'  =>  $request->password,
            'status' => Usuario::STATUS_ACTIVE
        ];

        $remember = $request->input('remember', false);

        if( Auth::attempt($credentials, $remember) ) {
            if(in_array(Auth::user()->rol, [Usuario::ROL_ADMIN, Usuario::ROL_USUARIO])){
                // login success
                return $this->redirectAfterLogin();
            }else{
                $message = 'Este usuario no tiene permisos para acceder al sistema.';
                Auth::logout();
                return redirect( route('auth/login'))
                    ->withInput()
                    ->with('error', $message);
            }
        }
        else {
            // login fail

            $message = 'Usuario o contraseña incorrectos.';

            $usuario = Usuario::where('email', $request->input('email'))
                    ->first();

            if( $usuario ) {
                switch($usuario->status) {
                    case Usuario::STATUS_PENDING:
                    case Usuario::STATUS_BLOCKED:
                        $message = '¡Su cuenta no se encuentra activa!<br>
                            Por favor, póngase en contacto con un administrador del sistema.';
                        break;
                    case Usuario::STATUS_INACTIVE:
                        $message = '¡Su cuenta ha sido desactivada!<br>
                            Por favor, póngase en contacto con un administrador del sistema.';
                }
            }

            return redirect( route('auth/login') )
                ->withInput()
                ->with('error', $message);
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect( route('auth/login') );
    }

    public function getActivate()
    {

    }

    public function postActivate(Request $request)
    {

    }

    public function validateEmail(Request $request)
    {
        $available = true;
        $message = 'valido!';
        $id = $request->id;
        $email = $request->email;

        $usuario = Usuario::where('email', $request->email)->first();

        if($usuario){
            $available = false;
            $message = 'Correo electrónico ya en uso.';
        }else{
            $available = true;
            $message = 'Correo electrónico disponible.';
        }

        return response()->json([
            'valid' => $available,
            'message' => $message
        ]); 
    }
}
