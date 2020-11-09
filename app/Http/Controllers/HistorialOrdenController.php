<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class HistorialOrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('haveaccess', 'historial.index');
        $orders = DB::table('orders')
            ->join('orderstatus', 'orders.orderstatus_id','orderstatus.id')
            ->join('suppliers', 'orders.supplier_id','suppliers.id')
            ->select('orders.id','orders.po_number', 'orderstatus.name AS status', 'orders.date', 'suppliers.company', 'orders.total')
            ->orderBy('orders.id', 'desc')
            ->simplePaginate(10);
        return view('orders.historial', compact('orders'));
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
        /*$orders = Order::find($id);
        $view = \view('order.show', \compact('orders'));
        $pdf = \app::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('orders');*/

         //$orders = DB::table('orders')->where('id', '=', 87)->get();
         /*$orders = Order::findOrfail($id);
         $orderdetails = OrderDetail::findOrfail($id);

         $fileName = 'reporte.pdf';
         $mpdf = new \Mpdf\Mpdf([
             'margin_left' => 10,
             'margin_right' => 10,
             'margin_top' => 10,
             'margin_bottom' => 10,
             'margin_header' => 10,
             'margin_footer' => 10,
         ]);
         $html = \View::make('orders.reporte', compact('orders', 'orderdetails', 'id') );
         $html = $html->render();
         $mpdf->WriteHTML($html);
         $mpdf->Output($fileName,'I');*/
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
