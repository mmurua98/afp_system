@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>IVA</h1>
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
                    <h4 class="modal-title">New IVA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('iva.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            <input type="text" class="form-control" id="tipo" name="tipo">
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor:</label>
                            <input type="text" class="form-control" id="valor" name="valor">
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
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($tiposIva as $iva)
                        <tr>
                            <td>{{$iva->tipo}}</td>
                            <td>{{$iva->valor}}</td>
                            <td>
                                <button class="show-modal btn btn-warning btn sm" data-toggle="modal" data-target="#editModal" 
                                    data-id="{{$iva->id}}"
                                    data-tipo="{{$iva->tipo}}" 
                                    data-valor="{{$iva->valor}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="show-modal btn btn-danger btn sm" data-toggle="modal" data-target="#deleteModal" 
                                    data-id="{{$iva->id}}"
                                    data-tipo="{{$iva->tipo}}" 
                                    data-valor="{{$iva->valor}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- The Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit IVA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('iva.update')}}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="id" name="id" value="{{$iva->id}}">
                        <div class="form-group">
                            <label for="tipo">Tipo:</label>
                            <input type="text" class="form-control" id="tipo" name="tipo">
                        </div>
                        <div class="form-group">
                            <label for="valor">Valor:</label>
                            <input type="text" class="form-control" id="valor" name="valor">
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
    </div>

    <!-- The Delete Modal -->
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
                    <form action="{{route('iva.destroy')}}" method="POST">
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
    </div>
@stop

<script>
    document.addEventListener("DOMContentLoaded", function(event){
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var tipo = button.data('tipo')
            var valor = button.data('valor')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #tipo').val(tipo);
            modal.find('.modal-body #valor').val(valor);
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        });
    });
    
</script>
