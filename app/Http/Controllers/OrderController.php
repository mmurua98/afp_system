<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\TiposIva;
use App\Models\Employee;
use App\Models\MovimientoAlmacen;
use App\Models\MovimientoAlmacenDetalle;
use App\Models\Stock;
use App\Models\RequireEmployee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        $products = Product::all();
        $suppliers = Supplier::with('tipoiva')->get();
        $requireEmployees = RequireEmployee::all();
        return view('orders.order', compact('orders', 'products', 'suppliers', 'requireEmployees'));
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
        //$data2 = json_decode($request->getContent(), true);
        $data = (array) json_decode($request->getContent());
        $serie = 'N';
        $folio = Order::where('supplier_id', $data['data']->supplier_id)->max('folio') + 1;
        //$folio =DB::raw('IFNULL( downloads.is_download, 0) as is_download')
        $po_number = $serie.'-'.$folio;
        $date = \getdate();


        //dd($data, $data['data'], $data['data']->details, $data['data']->supplier_id, $po_number);
        $id = Auth::id();
        //dd($id);
        $orden = new Order();
        $orden->user_id = $id;
        $orden->po_number = $po_number;
        //$orden->date = $date;
        $orden->supplier_id = $data['data']->supplier_id;
        $orden->total = $data['data']->total;
        //$orden->description = 'test';
        $orden->description = $data['data']->description;
        $orden->serie = $serie;
        $orden->folio = $folio;
        $orden->require_employee_id = $data['data']->require_employee_id;
        //dd($orden);

        //dd($data, $data['data'], $data['data']->details, $data['data']->supplier_id, $po_number, $orden);

        //$orden->save();

        //guardar
        if ($orden->save()) {
            //$orden->id;

            //GUARDAR ENTRADA DE PRODUCTO A ALMACEN
            $movimiento = new MovimientoAlmacen();
            $movimiento->movement_type_id = 1; //entrada
            $movimiento->user_id = $id;
            $movimiento->folio = 1;
            $movimiento->comment = 'dsf';
            $movimiento->order_id = $orden->id;
            $movimiento->save();

            //le asigna el id de la orden a cada detalle
            foreach ($data['data']->details as $item) {
                $item->order_id = $orden->id;

                $product = new OrderDetail();
                $product->order_id =  $item->order_id;
                $product->product_id =  $item->product_id;
                $product->price =  $item->price;
                $product->quantity =  $item->quantity;
                $product->iva =  $item->iva;
                $product->product_total =  $item->product_total;
                //$product->require_by =  $item->require_by;
                //product->description =  'prueba';
                //dd($data['data']);

                // GUARDAR ENTRADA DETALLE ALMACEN
                if($product->save()){
                    $movimientoDetalle = new MovimientoAlmacenDetalle();
                    $movimientoDetalle->movimientoalmacen_id= $movimiento->id;
                    $movimientoDetalle->movement_type_id = 1; //entrada
                    $movimientoDetalle->warehouse_id = 1;
                    $movimientoDetalle->product_id = $item->product_id;
                    $movimientoDetalle->quantity = $item->quantity;
                    $movimientoDetalle->comment = 'prueba';
                    
                    $movimientoDetalle->save();
                }

                //AGREGAR STOCK A CADA PRODUCTO
                //$stock = DB::table('stocks')->where('product_id', '=', $item->product_id)->get();
                $stock = Stock::where('product_id', '=', $item->product_id)->get()->toArray();
                //dd($stock[0]['id']);
                if (count($stock) > 0) {
                    /*$stock->product_id = $movimientoDetalle->product_id;
                    $stock->warehouse_id = $movimientoDetalle->warehouse_id;*/
                    //$stock->stock = $stock->stock + $movimientoDetalle->quantity;
                    $stockUpdate = Stock::find($stock[0]['id']);
                    $stockUpdate->stock = $stock[0]['stock'] + $item->quantity;
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

                
            }
        }

            //dd($data, $data['data']->details);
            //DB::table('order_details') -> insert($data['data']->details); //<-- this is better, one query.
        //return back()->with('message','Warden Detached successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
