<?php

namespace App\Http\Controllers\Viaticos;

use Illuminate\Http\Request;

use App\Models\Cuenta;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CuentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        //
        $cuentas = Cuenta::get();
        return view('viaticos.cuentas.index', ['cuentas' => $cuentas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        //
        $cuenta = new Cuenta();

        return view('viaticos.cuentas.create', ['cuenta' => $cuenta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request)
    {
        //
        $data = [
            'nombre' => $request->nombre,
            'codigo' => $request->codigo
        ];

        $cuenta = Cuenta::create($data);

        if($cuenta){
            return redirect( 'viaticos/cuentas' )
                ->with('success', 'Cuenta creada.');
        }else{
            return redirect( 'viaticos/cuentas' )
                ->with('error', 'Error al crear cuenta.');
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
        $cuenta = Cuenta::find($id);

        return view('viaticos.cuentas.view', ['cuenta' => $cuenta]);

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
        $cuenta = Cuenta::find($id);

        return view('viaticos.cuentas.edit', ['cuenta' => $cuenta]);

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
        $cuenta = Cuenta::find($id);

        $cuenta->nombre = $request->nombre;
        $cuenta->codigo = $request->codigo;

        if($cuenta->update()){
            return redirect( 'viaticos/cuentas' )
                ->with('success', 'Cuenta creada.');
        }else{
            return redirect( 'viaticos/cuentas' )
                ->with('error', 'Error al crear cuenta.');
        }

        //yay!
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
        $cuenta = Cuenta::find($id);

        if($cuenta->delete($id)){
            return redirect( 'viaticos/cuentas' )
                ->with('success', 'Cuenta eliminada.');
        }else{
            return redirect( 'viaticos/cuentas' )
                ->with('error', 'Error al eliminar cuenta.');
        }
    }

    public function getValidateCodigo(Request $request)
    {

        $available = true;
        $message = 'valido!';
        $codigo = $request->codigo;

        $cuenta = Cuenta::where('codigo', $codigo)->first();

        if($cuenta){
            $available = false;
            $message = 'Este código está actualmente en uso.';
        }else{
            $available = true;
            $message = 'Código disponible.';
        }

        return response()->json([
            'valid' => $available,
            'message' => $message
        ]);
        
    }
}
