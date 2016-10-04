<?php

namespace App\Http\Controllers\Viaticos;

use Illuminate\Http\Request;

use App\Models\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuariosController extends Controller
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
        $usuarios = User::whereIn('status', [User::STATUS_ACTIVE, User::STATUS_INACTIVE])
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
        $roles = User::getRolesArray();

        return view('viaticos.usuarios.create', ['roles' => $roles, 'usuario' => $usuario]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        dd($request->cedula);
        /*
        $this->validate($request, [
            'email' => 'required|email|max:64|unique:users'
        ]);

        // avatar
        $avatar = Usuario::DEFAULT_AVATAR;
        if( $request->hasFile('photo') && $request->file('photo')->isValid() ) {
            $file = $request->file('photo');
            $path = public_path('photos/usuarios');
            $filename = sha1($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
            $request->file('photo')->move($path, $filename);
            $avatar = '/photos/usuarios/' . $filename;
        }
        $usuario = Usuario::create([
            'email'    => $request->input('email'),
            'nombre'   => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'cedula' => $request->inpu('cedula')
            'rol'      => lcfirst($request->input('rol')),
            'avatar'   => $avatar,
            'status'   => Usuario::STATUS_PENDING
        ]);

        if( $usuario ) {
            // dispatch event envio email
            $event = new EventUsuarioRegistrado($usuario, EventUsuarioRegistrado::REGISTRO_INVITACION);
            Event::fire($event);

            if( $usuario->isOperador() ) {
                $redirectUrl = url('admin/usuarios/concesionarios/'.$usuario->id);
            } else if( $usuario->isAdmin() ) {
                $redirectUrl = url('admin/usuarios');
            } else if( $usuario->isAdminConcesionario()){
                $redirectUrl = url('admin/usuarios/concesionarios/'.$usuario->id);
            }

            return redirect( $redirectUrl )
                ->with('success', 'Invitación enviada.');
        }
        else {
            return back()
                ->withInput()
                ->with('error', 'Ha ocurrido un error.');
        }*/
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
        return view('viaticos.usuarios.view', ['usuario' => $usuario]);

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
        $usuario = User::find($id);
        return view('viaticos.usuarios.edit', ['usuario' => $usuario]);

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
        $usuario = User::find($id);
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
        $usuario = User::find($id);
        $usuario->status = User::STATUS_DELETED;
        $usuario->update();
        $usuario->delete();

        //armar el flash de los mensajes
        return redirect( url('viaticos/usuarios') )
                ->with('error', 'Usuario eliminado.');
    }
}
