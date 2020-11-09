@extends('adminlte::page')

@section('title', 'AFP - Entradas')
@section('content_header')
    <h1>Entradas</h1>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th># Invoice</th>
                        <th>Supplier</th>
                        <th>Date</th>
                        <th>Code</th>
                        <th>Product</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($entradas as $entrada)
                        <tr>
                            <td><a href="{{route('order.edit', $entrada->orderid)}}" target="_blank">{{$entrada->po_number}}</a></td>
                            <td>{{$entrada->company}}</td>
                            <td>{{$entrada->date}}</td>
                            <td>{{$entrada->code}}</td>
                            <td>{{$entrada->product}}</td>
                            <td class="bg-success" style="text-align:center">{{$entrada->quantity}}</td>
                            {{-- <td>
                                {{-- <button class="show-modal btn btn-danger btn sm" data-toggle="modal" data-target="#deleteModal" 
                                    data-id="{{$salida->id}}"
                                    data-employee_id="{{$salida->employee_id}}" 
                                    data-product_id="{{$salida->product_id}}"
                                    data-quantity="{{$salida->quantity}}"> 
                                    <i class="fa fa-trash"></i>
                                </button> 
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$entradas->links()}}
        </div>
    </div>

    <!-- The Delete Modal -->
    {{-- <div class="modal fade danger" id="deleteModal">
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

