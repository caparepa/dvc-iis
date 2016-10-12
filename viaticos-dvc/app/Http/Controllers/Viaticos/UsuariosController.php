<?php

namespace App\Http\Controllers\Viaticos;

use App\Models\Usuario;
use App\Models\Area;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsuariosController extends ViaticosController
{

    /**
     * [__construct description]
     */
    public function __construct()
    {
        parent::__construct();
        view()->share('section', 'usuarios');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //
        $usuarios = Usuario::whereIn('status', [Usuario::STATUS_ACTIVE, Usuario::STATUS_INACTIVE])
                        ->orderBy('rol', 'ASC')
                        ->get();

        return view('viaticos.usuarios.index', ['usuarios' => $usuarios]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        //
        $usuario = new User();
        $roles = Usuario::getRolesArray();
        $areas = Area::get();

        return view('viaticos.usuarios.create', ['roles' => $roles, 'usuario' => $usuario, 'areas' => $areas]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email|max:64|unique:users'
        ]);


        $data = [
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'cedula' => $request->input('cedula'),
            'rif' => $request->input('rif'),
            'telefono_hab' => $request->input('telefono_hab'),
            'telefono_cell' => $request->input('telefono_cell'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'rol' => $request->input('rol'),
            'id_area' => $request->input('area'),
            'avatar' => $request->input('avatar'),
            'status' => Usuario::STATUS_ACTIVE
        ];        

        if($request->input('password')){
                $password_hash = \Hash::make($request->input('password'));
                $data['password'] = $password_hash;
        }

        // avatar
        $avatar = Usuario::DEFAULT_AVATAR;
        if( $request->hasFile('photo') && $request->file('photo')->isValid() ) {
            $file = $request->file('photo');
            $path = public_path('photos/usuarios');
            $filename = sha1($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $request->file('photo')->move($path, $filename);
            $avatar = '/photos/usuarios/' . $filename;
        }
        $data['avatar'] = $avatar;
        $usuario = Usuario::create($data);

        if( $usuario ) {
            return redirect( 'viaticos/usuarios' )
                ->with('success', 'Usuario creado.');
        }
        else {
            return back()
                ->withInput()
                ->with( 'viaticos/usuarios' );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getView($id)
    {
        //
        $usuario = Usuario::find($id);
        return view('viaticos.usuarios.view', ['usuario' => $usuario]);

    }

    public function getProfile()
    {
        $usuario = Auth::user();
        $id = $usuario->id;

        return redirect(url('viaticos/usuarios/edit/'.$id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        //
        $usuario = Usuario::find($id);
        $roles = Usuario::getRolesArray();
        $areas = Area::get();

        return view('viaticos.usuarios.edit', ['usuario' => $usuario, 'roles' => $roles, 'areas' => $areas]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request, $id)
    {
        //
        $usuario = Usuario::find($id);
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDelete($id)
    {
        //
        $usuario = Usuario::find($id);
        $usuario->status = Usuario::STATUS_DELETED;
        $usuario->update();
        $usuario->delete();

        //armar el flash de los mensajes
        return redirect( url('viaticos/usuarios') )
                ->with('error', 'Usuario eliminado.');
    }

    public function getValidateEmail(Request $request)
    {
        $available = true;
        $message = 'valido!';
        $id = $request->id;
        $email = $request->email;

        $usuario = Usuario::withTrashed()->where('email', $request->email)->first();

        if($usuario && $usuario->deleted_at == null){
            $available = false;
            $message = 'Este correo electrónico está actualmente en uso.';
        }else if($usuario && $usuario->deleted_at != null){
            $available = false;
            $message = 'Este correo electrónico no puede ser utilizado.';
        }

        //Si hay un valor de id, se esta editando el usuario actual
        if(isset($id) && !empty($id)){

            //Usuario que se está editando actualmente
            $usuario_edit = Usuario::find($id);

            //Si el correo introducido es igual al actual, se sobreescribe el valor de $available
            //Se puede utilizar el correo actual en el usuario que se esta editando
            if($email == $usuario_edit->email){
                $available = true;
                $message = 'Correo de usuario a editar.';
            }
        }

        return response()->json([
            'valid' => $available,
            'message' => $message
        ]); 
    }
}
