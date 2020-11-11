@extends('adminlte::page')

@section('title', 'AFP - Suppliers')
@section('content_header')
    <h1>Suppliers</h1>
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
                    <h4 class="modal-title">New Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('supplier.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="company">Company:</label>
                            <input type="text" class="form-control" id="company" name="company" required>
                        </div>
                        <div class="form-group">
                            <label for="raz_social">Razón Social:</label>
                            <input type="text" class="form-control" id="raz_social" name="raz_social">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" id="location" name="location" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Lastname:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="tipoiva_id">Iva:</label>
                            <select class="form-control" name="tipoiva_id" id="tipoiva_id" required>
                                <option value="" disabled selected>-- Seleccione un IVA--</option>
                                @foreach($tiposIva as $iva)
                                    <option value="{{ $iva->id }}">{{ $iva->tipo }}</option>
                                @endforeach
                            </select>
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
                        <th>Company</th>
                        <th>Raz.Social</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Name</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Iva</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($suppliers as $supplier)
                        <tr>
                            <td>{{$supplier->company}}</td>
                            <td>{{$supplier->raz_social}}</td>
                            <td>{{$supplier->phone}}</td>
                            <td>{{$supplier->location}}</td>
                            <td>{{$supplier->name}}</td>
                            <td>{{$supplier->last_name}}</td>
                            <td>{{$supplier->email}}</td>
                            <td>{{$supplier->tipoiva->tipo}}</td>
                            <td>
                                <button class="show-modal btn btn-warning btn sm" data-toggle="modal" data-target="#editModal" 
                                    data-id="{{$supplier->id}}"
                                    data-company="{{$supplier->company}}"
                                    data-raz_social="{{$supplier->raz_social}}" 
                                    data-phone="{{$supplier->phone}}" 
                                    data-location="{{$supplier->location}}"
                                    data-name="{{$supplier->name}}" 
                                    data-last_name="{{$supplier->last_name}}" 
                                    data-email="{{$supplier->email}}"
                                    data-tipoiva_id="{{$supplier->tipoiva_id}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="show-modal btn btn-danger btn sm" data-toggle="modal" data-target="#deleteModal" 
                                    data-id="{{$supplier->id}}"
                                    data-company="{{$supplier->company}}" 
                                    data-raz_social="{{$supplier->raz_social}}" 
                                    data-phone="{{$supplier->phone}}" 
                                    data-location="{{$supplier->location}}"
                                    data-name="{{$supplier->name}}" 
                                    data-last_name="{{$supplier->last_name}}" 
                                    data-email="{{$supplier->email}}"
                                    data-tipoiva_id="{{$supplier->tipoiva_id}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$suppliers->links()}}
        </div>
    </div>

    <!-- The Edit Modal -->
    <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('supplier.update')}}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="id" name="id" value="{{$supplier->id}}">
                        <div class="form-group">
                            <label for="company">Company:</label>
                            <input type="text" class="form-control" id="company" name="company">
                        </div>
                        <div class="form-group">
                            <label for="raz_social">Razón Social:</label>
                            <input type="text" class="form-control" id="raz_social" name="raz_social">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="location">Location:</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Lastname:</label>
                            <input type="text" class="form-control" id="last_name" name="last_name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="tipoiva_id">Iva:</label>
                            <select class="form-control" name="tipoiva_id" id="tipoiva_id">
                                @foreach($tiposIva as $iva)
                                    <option value="{{ $iva->id }}">{{ $iva->tipo }}</option>
                                @endforeach
                            </select>
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
                    <form action="{{route('supplier.destroy')}}" method="POST">
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
            var company = button.data('company')
            var raz_social = button.data('raz_social')
            var phone = button.data('phone')
            var location = button.data('location')
            var name = button.data('name')
            var last_name = button.data('last_name')
            var email = button.data('email')
            var tipoiva_id = button.data('tipoiva_id')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #company').val(company);
            modal.find('.modal-body #raz_social').val(raz_social);
            modal.find('.modal-body #phone').val(phone);
            modal.find('.modal-body #location').val(location);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #last_name').val(last_name);
            modal.find('.modal-body #email').val(email);
            modal.find('.modal-body #tipoiva_id').val(tipoiva_id);
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        });
    });
    
</script>
