<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $listado['clientes'] = cliente::paginate(5);
        return view('clientes.index', $listado);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Acceder a create.blade.php de la vista para crear los clientes
        return view ('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validacion = [
            'id' => 'required|string|max:12',
            'nombres' => 'required|string|max:25',
            'apellidos' => 'required|string|max:25',
            'correo' => 'required|string|max:30',
            'foto' => 'required|image', 
        ];
        
        $msj = [
            'id.required' => 'El documento es requerido',
            'nombres.required' => 'Los nombres son requeridos',
            'apellidos.required' => 'Los apellidos es requerido',
            'correo.required' => 'El correo es requerido',
            'foto.required' => 'La foto es requerida'
        ];
        
        $this-> validate($request, $validacion, $msj);

        // $datosCliente = request()->all();
        $datosCliente = request()->except('_token');
        if($request->hasFile('foto')){
            $datosCliente['foto']=$request->file('foto')->store('uploads','public');
        }
        cliente::insert($datosCliente);
        // return response()->json($datosCliente);
        return redirect('/')->with('mensaje','Registro ingresado con exito');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $cliente = cliente::findOrfail($id);
        return view('clientes.update', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $validacion = [
            'id' => 'required|string|max:12',
            'nombres' => 'required|string|max:25',
            'apellidos' => 'required|string|max:25',
            'correo' => 'required|string|max:30'
        
        ];
        
        $msj = [
            'id.required' => 'El documento es requerido',
            'nombres.required' => 'Los nombres son requeridos',
            'apellidos.required' => 'Los apellidos es requerido',
            'correo.required' => 'El correo es requerido',
    
        ];
        
        if($request->hasFile('foto')){
            $validacion = ['foto' => 'required|max:1000|mimes:jpg,png,jpeg'];
            $msj =['foto.required'=> 'La foto es requerida' ];
        }
        $this-> validate($request, $validacion, $msj);
        $datos = request()->except(['_token','_method']);
        cliente::where('id','=',$id)->update($datos);

        //Verificar si el usuario tiene una nueva foto, en caso verdadero cargarla
        //Si no selecciono una foto sigue con la que ya tenia anteriormente
        cliente::where('id','=',$id)->update($datos);
        $cliente = cliente::findOrfail($id);
        return redirect('/')->with('mensaje','Registro actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $cliente = cliente::findOrFail($id);
        if(Storage::delete('public/'.$cliente->foto)){
            cliente::destroy($id);
        }
        return redirect('/')->with('mensaje','Registro eliminado con exito');

    }
}
