<?php

namespace App\Http\Controllers;

use App\Models\pedido;
use Illuminate\Http\Request;


class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pedidos = Pedido::with('cliente')->paginate(5);
        return view('pedidos.index', compact('pedidos'));
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Acceder a create.blade.php de la vista para crear los clientes
        return view ('pedidos.create');
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
            'producto' => 'required|string|max:25',
            'precio' => 'required|string|max:25',
            'id' => 'required|string|max:12'

        ];
        
        $msj = [
            'producto.required' => 'El producto es requerido',
            'precio.required' => 'El precio es requerido',
            'id.required' => 'El documento es requerido'
        ];
        
        $this-> validate($request, $validacion, $msj);

        //$datosPedido = request()->all();
        $datosPedido = request()->except('_token');
        pedido::insert($datosPedido);
        // return response()->json($datosPedido);
        return redirect('pedido')->with('mensaje','Registro ingresado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $pedido = pedido::findOrfail($id);
        return view('pedidos.update', compact('pedido'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //
         $validacion = [
            'producto' => 'required|string|max:25',
            'precio' => 'required|string|max:25',
            'id' => 'required|string|max:12'
        
        ];
        
        $msj = [
            'producto.required' => 'El producto es requerido',
            'precio.required' => 'El precio es requerido',
            'id.required' => 'El documento es requerido'
    
        ];

        $this-> validate($request, $validacion, $msj);
        //
        $datos = request()->except(['_token','_method']);
        pedido::where('id','=',$id)->update($datos);

        $pedido = pedido::findOrfail($id);
        return redirect('pedido')->with('mensaje','Registro actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        pedido::destroy($id);
        return redirect('pedido')->with('mensaje','Registro eliminado con exito');
    }
}
