@extends('adminlte::page')

@section('title', 'AFP - Salidas')
@section('content_header')
    <h1>Salidas</h1>
@endsection
@section('content')

    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
        Add New
    </button>

    <!-- The Modal -->
    <div class="modal fade" id="addModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Nueva Salida</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('salidas.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="employee_id">Employee:</label>
                            <select class="form-control" name="employee_id" id="employee_id" required>
                                <option value="" disabled selected>-- Seleccione un empleado--</option>
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->code.' - '.$employee->name.' '.$employee->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Product:</label>
                            <select class="form-control" name="product_id" id="product_id" required>
                                <option value="" disabled selected>-- Seleccione un producto--</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" required>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Date</th>
                        <th>Code</th>
                        <th>Product</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Options</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($salidas as $salida)
                        <tr>
                            <td>{{$salida->employee->code}}</td>
                            <td>{{$salida->date}}</td>
                            <td>{{$salida->product->code}}</td>
                            <td>{{$salida->product->name}}</td>
                            <td class="bg-danger text-center">{{$salida->quantity}}</td>
                            <td class="text-center">
                                <button class="show-modal btn btn-warning btn sm" data-toggle="modal" data-target="#editModal" 
                                    data-id="{{$salida->id}}"
                                    data-employee_id="{{$salida->employee_id}}" 
                                    data-product_id="{{$salida->product_id}}"
                                    data-quantity="{{$salida->quantity}}"> 
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                {{-- <button class="show-modal btn btn-danger btn sm" data-toggle="modal" data-target="#deleteModal" 
                                    data-id="{{$salida->id}}"
                                    data-employee_id="{{$salida->employee_id}}" 
                                    data-product_id="{{$salida->product_id}}"
                                    data-quantity="{{$salida->quantity}}"> 
                                    <i class="fa fa-trash"></i>
                                </button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$salidas->links()}}
        </div>
    </div>

      <!-- The Edit Modal -->
     {{-- <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('salidas.update')}}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="id" name="id" value="{{$salidas->id}}">
                        <div class="form-group">
                            <label for="employee_id">Employee:</label>
                            <select class="form-control" name="employee_id" id="employee_id">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name.' '.$employee->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Product:</label>
                            <select class="form-control" name="product_id" id="product_id">
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="text" class="form-control" id="quantity" name="quantity">
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- <!-- The Delete Modal -->
    <div class="modal fade danger" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Confirmation</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('salidas.destroy')}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <input type="hidden" id="id" name="id" value="">
                        <p class="text-center">Are you sure you want to delete this?</p>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">No, Cancel</button>
                            <button type="submit" class="btn btn-success">Yes, Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@stop

<script>
    document.addEventListener("DOMContentLoaded", function(event){
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var employee_id = button.data('employee_id')
            var product_id = button.data('product_id')
            var quantity = button.data('quantity')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #employee_id').val(employee_id);
            modal.find('.modal-body #product_id').val(product_id);
            modal.find('.modal-body #quantity').val(quantity);
        });

        // $('#deleteModal').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget)
        //     var id = button.data('id')

        //     var modal = $(this)
        //     modal.find('.modal-body #id').val(id);
        // });
    });
    
</script>
