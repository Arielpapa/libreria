<?php

namespace App\Http\Controllers;

use App\Models\Pedidos;
use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PedidosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = DB::table('pedidos')->get();

        return view('modulos.Pedidos')->with('pedidos', $pedidos);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        $datos = request();
        Pedidos::create([
            'fecha_entrega'=>$datos['fecha_entrega'],
            'fecha_envio'=>$datos['fecha_envio'],
            'estado'=>'Solicitado',
            'cantidad'=>0
        ]);
        return redirect('Pedidos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function show(Pedidos $pedidos)
    {
        //
    }

    public function Gestionar($id)
    {
        $pedido = Pedidos::find($id);
        $libros= Libro::all();
        $librosP = DB::table('pedido_l')->where('id_pedido', $id)->get();

        return view('modulos.Gestionar-Pedido', compact('pedido', 'libros', 'librosP'));
    }

    
    public function CambiarEstado($id)
    {
        $pedido =Pedidos::find($id);

        if($pedido->estado == "Solicitado"){
            DB::table('pedidos')->where('id', $id)->update(['estado'=>'En Camino']);

        }else{
            DB::table('pedidos')->where('id', $id)->update(['estado'=>'Recibido']);
        }

        return redirect('Gestionar-Pedido/'.$id);
    }

    public function QuitarLibroP($id)
    {
        
        $datos = request();
        $pedido = Pedidos::find($id);

        $cantidadN = $pedido->cantidad - $datos["cantidad"];

        DB::table('pedidos')->where('id',$id)->update(['cantidad'=>$cantidadN]);

        DB::table('pedido_l')->where('id', $datos["id"])->delete();

        return redirect('Gestionar-Pedido/'.$id);
    }

    public function VerificarPedido($id)
    {
        
        $datos = request();
        $libro=Libro::find($datos["id_libro"]);
        $stockN = $libro->stock + $datos["cantidad"];

        DB::table('libros')->where('id', $datos["id_libro"])->update(['stock'=>$stockN]);
        DB::table('pedido_l')->where('id',$datos["lp_id"])->update(['estado'=>'Verificado']);

        return redirect('Gestionar-Pedido/'.$id);
    }



    public function LibroPedido($id)
    {
        $datos = request();

        DB::table('pedido_l')->insert([
            'id_pedido'=>$id,
            'id_libro'=>$datos["id_libro"],
            'cantidad'=>$datos["cantidad"],
            'estado'=>""
        ]);

        $pedido = Pedidos::find($id);

        $cantidadN = $pedido->cantidad + $datos["cantidad"];

        DB::table('pedidos')->where('id',$id)->update(['cantidad'=>$cantidadN]);


        return redirect('Gestionar-Pedido/'.$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedidos $pedidos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedidos $pedidos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedidos  $pedidos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedidos $pedidos)
    {
        //
    }
}
