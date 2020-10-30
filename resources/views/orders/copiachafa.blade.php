@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Add Purchase Order</h1>
@endsection
@section('content')


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="supplier_id">Supplier:</label>
                        <select class="form-control" name="supplier_id" id="supplier_id">
                            <option value="">-- Seleccione un proveedor--</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->company}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="employee_id">Require by:</label>
                        <select class="form-control" name="employee_id" id="employee_id">
                            <option value="">-- Seleccione un empleado--</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name.' '.$employee->last_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="description" class="form-control" id="description" name="description">
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <select class="form-control" name="product_id" id="product_id" style="width: 250px;">
                <option value="">-- Seleccione un producto--</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-price={{$product->price}}>{{ $product->name}}</option>
                 @endforeach
            </select>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>
                            <button id="add" class="btn btn-success btn sm" data-toggle="modal" data-target="#editModal">
                                <i class="fa fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody id="tbProdQuantity">
                    {{-- <tr>
                        <td>
                            <select class="form-control" name="product_id" id="product_id">
                                <option value="">-- Seleccione un producto--</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price={{$product->price}}>{{ $product->name}}</option>
                                 @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="quantity" name="quantity">
                        </td>
                        <td>
                            <input type="text" class="form-control price" id="price" name="price" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control" id="totalproduct" name="totalproduct" readonly>
                        </td>
                    <td>
                            <button class="show-modal btn btn-danger btn sm removeItems" id="remove" data-toggle="modal" data-target="#deleteModal">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr> --}}
                </tbody>
            </table>
        </div>
    </div>
@stop

<script>
    document.addEventListener("DOMContentLoaded", function(event){
        // var productsOrder = {
        //     id = 0,
        //     product = '',
        //     quantity = 0,
        //     price = 0,
        //     total = 0
        // }

        

        $(document).ready(function(){  
            let productsDetail = [];

            // var productsOrder = {
            //     id = 0,
            //     product = '',
            //     quantity = 0,
            //     price = 0,
            //     total = 0
            // }

            function productsOrder(id, idProducto, product, quantity, price,total) {
                this.id = id,
                this.idProducto = idProducto,
                this.product = product,
                this.quantity = quantity,
                this.price = price,
                this.total = total
            }

           // var test = new productsOrder(0, 0, 0,0,0);
            var productos =  {!! json_encode($products) !!};
            //productsDetail.push(test)


            var i=1;  
     
            $('#add').on('click', function(){  
                //i++;  
                debugger;
                var productoSeleccionado = $('#product_id').find(':selected').val()
                var productoSeleccionadoText =  $('#product_id').find(':selected').text()
                var price =  productos.filter(x => x.id  == productoSeleccionado)[0].price
                var item = new productsOrder(0, productoSeleccionado, productoSeleccionadoText,1,price, price);
                productsDetail.push(item)

                //$('#tbProdQuantity').append('<tr id="row'+i+'"><td><select class="form-control" name="product_id" id="product_id"><option value="">-- Seleccione un producto--</option>@foreach($products as $product) <option value="{{ $product->id }}" data-price={{$product->price}}>{{ $product->name}}</option>  @endforeach </select></td> <td><input type="text" class="form-control" id="quantity" name="quantity"></td> <td><input type="text" class="form-control price" id="price" name="price" readonly></td> <td><input type="text" class="form-control" id="totalproduct" name="totalproduct" readonly></td> <td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"> <i class="fas fa-minus"></i> </button></td> </tr>');  
            });  

            $(document).on('click', '.btn_remove', function(){  
                var button_id = $(this).attr("id");   
                $('#row'+button_id+'').remove();  
            });  
        }); 

        /*const selectElement = document.querySelector('#product_id');

      */

        /*selectElement.addEventListener('change', (event) => {
            const result = app.filter(x =>x.product_id == event.target.value);
            debugger;*/
            //const resultado = document.querySelector('.resultado');
            //resultado.textContent = `Te gusta el sabor ${event.target.value}`;
       // })

        //obtiene el precio dependiendo el producto
        $('#product_id').on('change', function() {
            $('.price')
            .val(
                $(this).find(':selected').data('price')
                );
        });

        //Calcula el total quantity*price
        $('#quantity').keyup(function() {
            var quantity = parseFloat($("#quantity").val());
            var price = parseFloat($("#price").val());

            var total = (quantity * price).toFixed(2);

            parseFloat($("#totalproduct").val(total)); // sets the total price input to the quantity * price
        });


        // var productsOrder = {
        //     id = 0,
        //     product = '',
        //     quantity = 0,
        //     price = 0,
        //     total = 0
        // }
    });
</script>
