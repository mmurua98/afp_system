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
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'order.index');
        $orders = Order::all();
        $products = Product::all();
        $suppliers = Supplier::with('tipoiva')->get();
        $requireEmployees = RequireEmployee::all();
        $orderstatus = OrderStatus::where('id', '=', '1')->get();
        return view('orders.order', compact('orders', 'products', 'suppliers', 'requireEmployees', 'orderstatus'));
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
        Gate::authorize('haveaccess', 'order.store');
        //$data2 = json_decode($request->getContent(), true);
        $data = (array) json_decode($request->getContent());
        $serie = "N".date('y');
        //$folio = Order::where('supplier_id', $data['data']->supplier_id)->max('folio') + 1;
        //$folio = DB::raw('IFNULL(max(Folio) FROM orders WHERE supplier_id = 1 AND serie = "N" + (SELECT DATE_FORMAT(CURDATE(), "%y")))');
        $folio = DB::table('orders')
                ->select(DB::raw('IFNULL(max(folio),0) + 1 AS folio'))
                ->where('supplier_id', '=', $data['data']->supplier_id)->where('serie', '=', "N- + (DATE_FORMAT(CURDATE(), '%y')")
                ->get();
        $po_number = $serie.'-'.$folio[0]->folio;
        $date = \getdate();
        //dd($folio[0]->folio);

        //dd($data, $data['data'], $data['data']->details, $data['data']->supplier_id, $po_number);
        $id = Auth::id();
        //dd($id);
        $orden = new Order();
        $orden->user_id = $id;
        $orden->orderstatus_id = $data['data']->orderstatus_id;
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

        if($orden->save()) {

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
                $product->save();
            }
        }
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
    public function edit($id)
    {
        //Gate::authorize('haveaccess', 'order.edit');
        //$orders = Order::all();
        $orders = DB::table('orders')
            ->join('suppliers', 'orders.supplier_id','suppliers.id')
            ->join('require_employees', 'orders.require_employee_id','require_employees.id')
            ->join('orderstatus', 'orders.orderstatus_id','orderstatus.id')
            ->select('orders.id', 'orderstatus.name AS status', 'orders.po_number','orders.date','orders.description',
                    'suppliers.company','suppliers.raz_social','suppliers.phone','suppliers.email', 'suppliers.location',
                    'orders.total', (DB::raw('CONCAT(require_employees.name," ",require_employees.last_name) AS name')))
            ->where('orders.id', '=', $id)
            ->get();
        //$order_details = OrderDetail::all()->where('order_id', '=',$id);
        $order_details = DB::table('order_details')
            ->join('products', 'order_details.product_id','products.id')
            ->select('order_details.id', 'order_details.order_id', 'order_details.product_id', 'products.name AS product', 
                    'order_details.price', 'order_details.quantity', 'order_details.iva', 'order_details.product_total', DB::raw("0 AS eliminar"))
            ->where('order_details.order_id', '=', $id)
            ->get();

        $products = Product::all();

        $suppliers = DB::table('orders')
            ->join('suppliers', 'orders.supplier_id','suppliers.id')
            ->join('tipos_ivas', 'suppliers.tipoiva_id', '=', 'tipos_ivas.id')
            ->select('suppliers.id', 'suppliers.company', 'tipos_ivas.tipo', 'tipos_ivas.valor')
            ->where('orders.id', '=', $id)
            ->get();
        $requireEmployees = RequireEmployee::all();

        $orderstatus = DB::table('orders')
            ->join('suppliers', 'orders.supplier_id','suppliers.id')
            ->join('orderstatus', 'orders.orderstatus_id','orderstatus.id')
            ->select('orders.id', 'orders.po_number', 'orderstatus.name')
            ->where('orders.id', '=', $id)
            ->get();

        return view('orders.orderedit', compact('orders', 'products', 'suppliers', 'requireEmployees', 'orderstatus', 'order_details'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request, $id);
        //Gate::authorize('haveaccess', 'order.update');
        $data = (array) json_decode($request->getContent());

        $userid = Auth::id();
        $orden = Order::find($id);
        $orden->user_id = $userid;
        $orden->orderstatus_id = $data['data']->orderstatus_id;
        $orden->total = $data['data']->total;
        $orden->description = $data['data']->description;
        $orden->require_employee_id = $data['data']->require_employee_id;
        //dd($orden);

        //guardar
        if ($orden->save()) {
            //$orden->id;

            //GUARDAR ENTRADA DE PRODUCTO A ALMACEN
            $movimiento = new MovimientoAlmacen();
            $movimiento->movement_type_id = 1; //entrada
            $movimiento->user_id = $userid;
            $movimiento->folio = 1;
            $movimiento->comment = 'dsf';
            $movimiento->order_id = $orden->id;
            $movimiento->save();

            //le asigna el id de la orden a cada detalle
            foreach ($data['data']->details as $item) {
                $seguardo = false;
                $item->order_id = $orden->id;

                    //eliminar
                if ($item->eliminar > 0) {
                    if($item->id > 0){
                        $detail = OrderDetail::find($item->id);
                        $detail->delete();
                    }
                } else {
                    
                    if($item->id > 0)
                    {
                        $product = OrderDetail::find($item->id);
                        $product->order_id =  $item->order_id;
                        $product->product_id =  $item->product_id;
                        $product->price =  $item->price;
                        $product->quantity =  $item->quantity;
                        $product->iva =  $item->iva;
                        $product->product_total =  $item->product_total;
                        $seguardo = $product->save();
                    }else{
                        $product = new OrderDetail();
                        $product->order_id =  $item->order_id;
                        $product->product_id =  $item->product_id;
                        $product->price =  $item->price;
                        $product->quantity =  $item->quantity;
                        $product->iva =  $item->iva;
                        $product->product_total =  $item->product_total;
                        $seguardo = $product->save();
                    }
                }
                

                if($data['data']->orderstatus_id = 2){

                   // GUARDAR ENTRADA DETALLE ALMACEN
                    if($seguardo){
                        $movimientoDetalle = new MovimientoAlmacenDetalle();
                        $movimientoDetalle->movimientoalmacen_id= $movimiento->id;
                        $movimientoDetalle->movement_type_id = 1; //entrada
                        $movimientoDetalle->warehouse_id = 1;
                        $movimientoDetalle->product_id = $item->product_id;
                        $movimientoDetalle->quantity = $item->quantity;
                        $movimientoDetalle->comment = 'prueba';
                        
                        $movimientoDetalle->save();

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
                    }
                }
                
            }

            //elimina productos
            /*foreach($data['detailsDelete']->details as $item){
                $detail = OrderDetail::find($item->id);
                $detail->delete();
            }*/
        }

            //dd($data, $data['data']->details);
            //DB::table('order_details') -> insert($data['data']->details); //<-- this is better, one query.
        //return back()->with('message','Warden Detached successfully');
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
