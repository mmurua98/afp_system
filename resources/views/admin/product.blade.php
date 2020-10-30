@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Products</h1>
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
                    <h4 class="modal-title">New Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('product.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="category_id">Category:</label>
                            <select class="form-control" name="category_id" id="category_id">
                                <option value="" disabled selected>-- Seleccione una categoría--</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Code:</label>
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" class="form-control" id="type" name="type">
                        </div>
                        <div class="form-group">
                            <label for="minimum">Minimum:</label>
                            <input type="text" class="form-control" id="minimum" name="minimum">
                        </div>
                        <div class="form-group">
                            <label for="maximum">Maximum:</label>
                            <input type="text" class="form-control" id="maximum" name="maximum">
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
                        <th>Category</th>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Type</th>
                        <th>Minimum</th>
                        <th>Maximum</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($products as $product)
                        <tr>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->code}}</td>
                            <td>{{$product->name}}</td>
                            <td>${{$product->price}}</td>
                            <td>{{$product->type}}</td>
                            <td class="bg-danger">{{$product->minimum}}</td>
                            <td class="bg-success">{{$product->maximum}}</td>
                            <td>
                                <button class="show-modal btn btn-warning btn sm" data-toggle="modal" data-target="#editModal" 
                                    data-id="{{$product->id}}"
                                    data-category_id="{{$product->category_id}}"
                                    data-code="{{$product->code}}"  
                                    data-name="{{$product->name}}" 
                                    data-price="{{$product->price}}"
                                    data-type="{{$product->type}}" 
                                    data-minimum="{{$product->minimum}}" 
                                    data-maximum="{{$product->maximum}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <button class="show-modal btn btn-danger btn sm" data-toggle="modal" data-target="#deleteModal" 
                                    data-id="{{$product->id}}"
                                    data-category_id="{{$product->category_id}}" 
                                    data-code="{{$product->code}}" 
                                    data-name="{{$product->name}}" 
                                    data-price="{{$product->price}}"
                                    data-type="{{$product->type}}" 
                                    data-minimum="{{$product->minimum}}" 
                                    data-maximum="{{$product->maximum}}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$products->links()}}
        </div>
    </div>

     <!-- The Edit Modal -->
     <div class="modal fade" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Product</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('product.update')}}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="id" name="id" value="{{$category->id}}">
                        <div class="form-group">
                            <label for="category_id">Category:</label>
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="code">Code:</label>
                            <input type="text" class="form-control" id="code" name="code">
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" class="form-control" id="price" name="price">
                        </div>
                        <div class="form-group">
                            <label for="type">Type:</label>
                            <input type="text" class="form-control" id="type" name="type">
                        </div>
                        <div class="form-group">
                            <label for="minimum">Minimum:</label>
                            <input type="text" class="form-control" id="minimum" name="minimum">
                        </div>
                        <div class="form-group">
                            <label for="maximum">Maximum:</label>
                            <input type="text" class="form-control" id="maximum" name="maximum">
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
                    <form action="{{route('product.destroy')}}" method="POST">
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
            var category_id = button.data('category_id')
            var code = button.data('code')
            var name = button.data('name')
            var price = button.data('price')
            var type = button.data('type')
            var minimum = button.data('minimum')
            var maximum = button.data('maximum')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #category_id').val(category_id);
            modal.find('.modal-body #code').val(code);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #price').val(price);
            modal.find('.modal-body #type').val(type);
            modal.find('.modal-body #minimum').val(minimum);
            modal.find('.modal-body #maximum').val(maximum);
        });

        $('#deleteModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')

            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        });
    });
    
</script>
