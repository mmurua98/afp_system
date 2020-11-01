<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Product;
use App\Models\SalidasProducto;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SalidasProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'salidas.index');
        $employees = Employee::all();
        $products = Product::all();
        $salidas = SalidasProducto::orderBy('id', 'desc')->simplePaginate(10);
        return view('inventario.salidas', compact('salidas', 'employees', 'products'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('haveaccess', 'salidas.store');
        $id = Auth::id();
        /*SalidasProducto::create($request->all()); AQUI ESTAS GUARDANDO, ESTA BIEN PERO ESA FORMA NO NOS SIRVE PORQUE NO SABEMOS QUE ID TIENE,
        return back();*/

        $salida = new SalidasProducto(); //AQUI ESTAS CREANDO UN OBJETO DE ESA TABLA, NECEITAS LLENAS LOS DATOS,QUE VIENEN EN EL REWQUEST
        $salida->employee_id = $request->employee_id;
        $salida->product_id = $request->product_id;
        $salida->quantity = $request->quantity;
        //LE SIGUES CON LOS DEMAS

        if($salida->save()){
            $movimiento = new MovimientoAlmacen();
            $movimiento->movement_type_id = 2; //salida
            $movimiento->user_id = $id;;
            $movimiento->folio = 1;
            $movimiento->comment = 'dsf';
            $movimiento->salida_id = $salida->id; //si guarda, con esteya tienes el id, 
            $movimiento->save();

            $movimientoDetalle = new MovimientoAlmacenDetalle();
            $movimientoDetalle->movimientoalmacen_id= $movimiento->id;
            $movimientoDetalle->movement_type_id = 2; //salida
            $movimientoDetalle->warehouse_id = 1;
            $movimientoDetalle->product_id = $salida->product_id;
            $movimientoDetalle->quantity = $salida->quantity;
            $movimientoDetalle->comment = 'prueba';
            $movimientoDetalle->save();
        }

        //AGREGAR STOCK A CADA PRODUCTO
         $stock = Stock::where('product_id', '=', $salida->product_id)->get()->toArray();
        //dd($stock[0]['id']);
        if (count($stock) > 0) {
            $stockUpdate = Stock::find($stock[0]['id']);
            $stockUpdate->stock = $stock[0]['stock'] - $salida->quantity;
            $stockUpdate->save();
            //$stockUpdate->update($request->all());
        }else{
            $stockNuevo = new Stock();
            $stockNuevo->product_id = $movimientoDetalle->product_id;
            $stockNuevo->warehouse_id = $movimientoDetalle->warehouse_id;
            $stockNuevo->stock = $movimientoDetalle->quantity;
            $stockNuevo->save();
        }
        //$stock->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalidasProducto  $salidasProducto
     * @return \Illuminate\Http\Response
     */
    public function show(SalidasProducto $salidasProducto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalidasProducto  $salidasProducto
     * @return \Illuminate\Http\Response
     */
    public function edit(SalidasProducto $salidasProducto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SalidasProducto  $salidasProducto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Gate::authorize('haveaccess', 'salidas.update');
        $salidas = SalidasProducto::findOrFail($request->id);
        $salidas->update($request->all());
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalidasProducto  $salidasProducto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Gate::authorize('haveaccess', 'salidas.destroy');
        $salidas = SalidasProducto::findOrFail($request->id);
        $salidas->delete($request->all());
        return back();
    }
}
