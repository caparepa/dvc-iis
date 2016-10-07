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
            $usuario->rol = User::ROL_USUARIO;
            $usuario->avatar = User::DEFAULT_AVATAR;
            $usuario->status = User::STATUS_PENDING;

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
        dd($request);
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

        $usuario = User::where('email', $request->email)->first();

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
