<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class EntradasProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'entradas.index');
        /*$entradas = DB::table('orders')
            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->join('suppliers', 'orders.supplier_id', '=', 'suppliers.id')
            ->select('orders.po_number', 'suppliers.company', 'orders.date','products.code', 'products.name', 'order_details.quantity')
            ->orderBy('orders.id', 'desc')
            ->simplePaginate(12);*/
        $entradas = DB::table('movimiento_almacen_detalles')
            ->join('movimiento_almacens','movimiento_almacen_detalles.movimientoalmacen_id', '=', 'movimiento_almacens.id')
            ->join('movement_types','movimiento_almacen_detalles.movement_type_id','=','movement_types.id')
            ->join('products','movimiento_almacen_detalles.product_id','=','products.id')
            ->join('orders','movimiento_almacens.order_id','=','orders.id')
            ->join('suppliers','orders.supplier_id','=','suppliers.id')
            ->select('movimiento_almacen_detalles.id','orders.id AS orderid','movement_types.name  AS movimiento','orders.po_number',
                    'suppliers.company','products.code','products.name AS product', 'orders.date', 'movimiento_almacen_detalles.quantity')
            ->where('movimiento_almacen_detalles.movement_type_id', '=', '1')
            ->orderBy('orders.id', 'desc')
            ->simplePaginate(12);
        return view('inventario.entradas', ['entradas' => $entradas]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
