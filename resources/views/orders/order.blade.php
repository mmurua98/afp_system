<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}
@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Create Purchase Order</h1>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="supplier_id">Supplier:</label>
                        <select class="form-control" name="supplier_id" id="supplier_id">
                            <option value="" disabled selected>-- Seleccione un proveedor--</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" data-valoriva={{$supplier->tipoiva->valor}} data-iva={{$supplier->tipoiva->tipo}}>{{ $supplier->company}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="require_employee_id">Require by:</label>
                        <select class="form-control" name="require_employee_id" id="require_employee_id">
                            <option value="" disabled selected>-- Seleccione un empleado--</option>
                            @foreach($requireEmployees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name.' '.$employee->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        {{-- <input type="hidden" class="form-control" id="iva" name="iva"> --}}
                        <label for="iva">IVA:</label>
                        <input type="text" class="form-control" id="iva" name="iva" readonly>
                    </div>
                </div>
                <div class="col-9">
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="description" class="form-control" id="description" name="description">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <select class="form-control" name="product_id" id="product_id" style="width: 250px;">
                    <option value="" disabled selected>-- Seleccione un producto--</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price={{$product->price}}>{{ $product->name}}</option>
                     @endforeach
                </select>
                <button id="add" class="btn btn-success btn sm" data-toggle="modal" data-target="#editModal">
                    <i class="fa fa-plus"></i>
                </button>
            </div>

            <table id="tblDetails" class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>IVA</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <button type="submit" id="save" class="btn btn-primary">Create</button>
        </div>
    </div>
@stop

<script>
    document.addEventListener("DOMContentLoaded", function(event){

        //import axios from 'axios';

        //valor iva proveedor
        let valorIVA = 0;
        
        //obtiene el tipo de iva dependiendo el proveedor
        $('#supplier_id').on('change', function() {
            $('#iva').val($(this).find(':selected').data('iva'));
            valorIVA = $(this).find(':selected').data('valoriva')
        });
        

        $(document).ready(function(){
        
            let productsDetail = [];
            let productos =  {!! json_encode($products) !!};
            let tblDetails;


            // crea objeto detalle
            function productsOrder(id, idProducto, product, quantity, price, total) {
                //debugger;
                this.registro = productsDetail.length + 1,
                this.id = id,
                this.order_id = 0,
                this.product_id = idProducto,
                this.product = product,
                this.quantity = quantity,
                this.price = price,
                //this.iva= 0,
                this.iva = (valorIVA * (quantity * price)).toFixed(2),
                this.product_total = total
            }
     
            $('#add').on('click', function(){  
                
                var productoSeleccionado = $('#product_id').find(':selected').val()
                var productoSeleccionadoText =  $('#product_id').find(':selected').text()
                var price =  productos.filter(x => x.id  == productoSeleccionado)[0].price

                var quantity = 1
                var iva = (valorIVA * (quantity * price)).toFixed(2)
                var total =  ( (price * quantity) + (+ iva) ).toFixed(2); 
                
                //debugger;
                var item = new productsOrder(0, productoSeleccionado, productoSeleccionadoText, 1, price, + total);
                productsDetail.push(item)

                 //Cargamos la tabla de los productos
                $.cargarDetallesTabla(productsDetail, false);
            });  

            $.cargarDetallesTabla = function(data, disabled){
                if (tblDetails != null && tblDetails != undefined) {
                    tblDetails.destroy();
                }

                const ButtonContent = '<button type="button" class="btn btn-danger eliminarDetalle"> <i class="fas fa-minus"></i> </button>';

                tblDetails = $('.data-table').DataTable({
                    aaData: data,
                    searching: false,
                    bPaginate: false,
                    bFilter: false,
                    bSort: false,
                    iDisplayLength: 10,
                    aLengthMenu: [[5, 10, -1], [5, 10, "All"]],
                    processing: true,
                    serverSide: false,
                    columns: [
                        {data: 'product', name: 'product'},
                        {data: null, name: 'quantity'},
                        {data: null, name: 'price'},
                        {data: null, name: 'iva'},
                        {data: null, name: 'total'},
                        {data: null, name: 'acciones'}
                    ],
                    fnCreatedRow: function (nRow, aData, iDataIndex) {                       
                        // TEXTBOX CANTIDAD
                        var textCantidad = disabled == true ? ' <input type="number"  disabled="disabled" class="form-control numbersOnly txtCantidad" min="1" value="' + aData.quantity + '" >  ' : ' <input type="number"  class="form-control numbersOnly txtCantidad"  value="' + aData.quantity + '" >';
                        $('td:eq(1)', nRow).html(textCantidad);

                        // TEXTBOX PRECIO
                        var textPrecio = disabled == true ? ' <input type="number"  disabled="disabled" class="form-control numbersOnly txtPrecio" min="1" value="' + aData.price + '" >  ' : ' <input type="number"  class="form-control numbersOnly txtPrecio"  value="' + aData.price + '" >';
                        $('td:eq(2)', nRow).html(textPrecio);

                        // LABEL IVA
                        $('td:eq(3)', nRow).html('<label  name="text" class="control-label  lbliva" >' + parseFloat(aData.iva).toFixed(2) + '  </label>');
                       
                        // LABEL TOTAL
                        $('td:eq(4)', nRow).html('<label  name="text" class="control-label  lbltotal" >' + parseFloat(+aData.price + +aData.iva).toFixed(2) + '  </label>');
                        
                        // BOTON ELIMINAR
                        $('td:eq(5)', nRow).html(ButtonContent);
                    }
                });

                /*** ELIMINAR FILA ORDEN ***/
                $('#tblDetails tbody button.eliminarDetalle').click(function (e) {
                    var DatosTabla = tblDetails.rows().data();

            
                    if (DatosTabla != undefined) {
                        //Quitar la fila Seleccionada de las filas del array dr ls otfrn
                        var FilaSeleccionada = tblDetails.row($(this).parents('tr')).data();

                        if (FilaSeleccionada != undefined && FilaSeleccionada != null) {                         
                            productsDetail = $.grep(productsDetail, function (data, index) {
                                return data.registro != FilaSeleccionada.registro;
                            });
                            tblDetails.row($(this).parents('tr')).remove().draw();
                        }
                    }
                    e.stopPropagation();
                    e.preventDefault();
                });

                /*** CANTIDAD ***/
                $('#tblDetails tbody input.txtCantidad').change(function (e) {
                    var DatosTabla = tblDetails.rows().data();

                    if (DatosTabla != undefined) {
                        var FilaSeleccionada = tblDetails.row($(this).parents('tr')).data();

                        if (FilaSeleccionada != undefined && FilaSeleccionada != null) {
                            var cantidad = $(this).val();

                            var precio = FilaSeleccionada.price * 1;

                            FilaSeleccionada.quantity = cantidad * 1;

                            if (precio > 0 && precio != "") {

                                /*IVA*/
                                var iva = valorIVA * ( parseFloat(FilaSeleccionada.quantity) * parseFloat(FilaSeleccionada.price) );
                                FilaSeleccionada.iva = iva.toFixed(2);
                                $(this).parents('tr').find('.lbliva').text(FilaSeleccionada.iva);

                                //total
                                var total = iva + (parseFloat(cantidad) * parseFloat(FilaSeleccionada.price));
                                FilaSeleccionada.product_total = total.toFixed(2);

                                $(this).parents('tr').find('.lbltotal').text(FilaSeleccionada.product_total);
                            }
                        }
                    }
                    e.stopPropagation();
                    e.preventDefault();
                });

                /*** PRECIO ***/
                $('#tblDetails tbody input.txtPrecio').change(function (e) {

                    var DatosTabla = tblDetails.rows().data();

                    if (DatosTabla != undefined) {
                        var FilaSeleccionada = tblDetails.row($(this).parents('tr')).data();

                        if (FilaSeleccionada != undefined && FilaSeleccionada != null) {

                            var precio = $(this).val();

                            precio = parseFloat(precio).toFixed(2);

                            $(this).val(precio);

                            FilaSeleccionada.price = precio;

                            if (precio > 0 && precio != "") //Calculamos y cargamos el total
                            {

                                /*IVA*/
                                var iva = valorIVA * ( parseFloat(FilaSeleccionada.quantity) * parseFloat(FilaSeleccionada.price) );
                                FilaSeleccionada.iva = iva.toFixed(2);

                                $(this).parents('tr').find('.lbliva').text(FilaSeleccionada.iva);


                                var total = iva + (parseFloat(FilaSeleccionada.quantity) * parseFloat(FilaSeleccionada.price));
                                FilaSeleccionada.product_total = total.toFixed(2);

                                $(this).parents('tr').find('.lbltotal').text(FilaSeleccionada.product_total);

                                
                            }
                        }
                    }

                    e.stopPropagation();
                    e.preventDefault();
                });
            }

            $('#save').on('click', function(){
                //debugger;
                const data = {
                    supplier_id: $('#supplier_id').find(':selected').val(),
                    require_employee_id: $('#require_employee_id').find(':selected').val(),
                    description: $('#description').val(),
                    //total: productsDetail.reduce((sum, { price, quantity }) => sum + price * quantity, 0),
                    total: productsDetail.map(x => x.product_total).reduce(function(a, b){return (+a) + (+b);}),
                    details: productsDetail
                }

                axios.post('/order', {
                    data: JSON.parse(
                        JSON.stringify({
                            supplier_id: $('#supplier_id').find(':selected').val(),
                            require_employee_id: $('#require_employee_id').find(':selected').val(),
                            description: $('#description').val(),
                            //total: productsDetail.reduce((sum, { price, quantity }) => sum + price * quantity, 0),
                            total: productsDetail.map(x => x.product_total).reduce(function(a, b){return (+a) + (+b);}),
                            details: productsDetail
                        })
                    )
                })
                .then(function (response) {
                    window.location.href = "/historial";
                    console.log(response);
                })
                .catch(function (error) {
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });  
            })

        });
    });
</script>
