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
        //$this->redirectPath = route('viaticos/dashboard');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:usuarios',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    private function redirectAfterLogin( $message = null )
    {

        $user = Auth::user();

        if($user->rol != 'guesy'){
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
        dd($request);

        try {
            
        } catch (Exception $e) {
            
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
