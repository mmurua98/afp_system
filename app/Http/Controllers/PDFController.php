<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;


class PDFController extends Controller
{
    /*public function PDF(){
        $orders = Order::all();
        $pdf = \PDF::loadView('orders.reporte', compact('orders'));
        return $pdf->stream('ordenpdf.pdf');
    }*/

    public function PDF($id){
        //$orders = DB::table('orders')->where('id', '=', 87)->get();
        //$orders = Order::findOrfail($id);
        //$orderdetails = OrderDetail::findOrfail($id);
        //$orderdetails = DB::table('order_details')->where('order_details.order_id', '=', 87)->get();
        $orders = DB::table('orders')
            ->join('suppliers', 'orders.supplier_id','suppliers.id')
            ->join('require_employees', 'orders.require_employee_id','require_employees.id')
            ->select('orders.id', 'orders.po_number','orders.date','suppliers.company','suppliers.raz_social','suppliers.phone', 'suppliers.email', 'suppliers.location',
                    'orders.total', (DB::raw('CONCAT(require_employees.name," ",require_employees.last_name) AS name')))
            ->where('orders.id', '=', $id)
            ->get();


        DB::statement(DB::raw('SET @row_number = 0'));
        $orderdetails = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->select(DB::raw('@row_number:=@row_number+1 AS line'),'order_details.id', 'order_details.order_id', 'products.name', 'products.type',
                     'order_details.price', 'order_details.quantity', 'order_details.iva',
                     (DB::raw('(order_details.product_total - order_details.iva) AS totalSinIva')) )
            ->where('order_details.order_id', '=', $id)
            ->get();

        $instructions = DB::table('orders')
            ->select('orders.id', 'orders.description')
            ->where('orders.id', '=', $id)
            ->get();

        $dateNumber = DB::table('orders')
            ->select(DB::raw('id, po_number, DATE_FORMAT(date,"%d-%b-%y") as date '))
            ->where('id', '=', $id)
            ->get();

        $totales = DB::table('orders')
            ->join('suppliers', 'orders.supplier_id','suppliers.id')
            ->join('order_details', 'orders.id','order_details.order_id')
            ->join('tipos_ivas', 'suppliers.tipoiva_id','tipos_ivas.id')
            ->select('orders.id', 
                    DB::raw('SUM(order_details.product_total - order_details.iva) AS totalSinIva'),
                    DB::raw('SUM(order_details.iva) AS iva'),
                    'tipos_ivas.tipo', 'orders.total',
                    'orders.total')
            ->where('orders.id', '=', $id)
            ->get();

        //dd($id);
        //return view ('orders.reporte');
        $fileName = 'reporte.pdf';
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 10,
            'margin_right' => 10,
            'margin_top' => 10,
            'margin_bottom' => 10,
            'margin_header' => 10,
            'margin_footer' => 10,
        ]);
        $html = \View::make('orders.reporte', compact('orders', 'orderdetails', 'instructions', 'dateNumber', 'totales') );
        $html = $html->render();
        //$stylesheet = file_get_contents(url('/css/reporte.css'));
        //$mpdf->WriteHTML($stylesheet, 1);
        $mpdf->WriteHTML($html);
        $mpdf->Output($fileName,'I');
    }
   
}
