@extends('adminlte::page')

@section('title', 'AFP - Edit Role')
@section('content_header')
    <h1>Edit Role</h1>
@endsection
@section('content')


    <div class="card">
        <div class="card-body">

            @include('custom.message')

                <form action="{{route('role.update', $role->id)}}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="container">
                        <h3>Required Data</h3>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name" name="name" value="{{old('name', $role->name)}}">
                        </div>
                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" class="form-control" id="slug" placeholder="Slug" name="slug" value="{{old('slug', $role->slug)}}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Description">{{old('description', $role->description)}}</textarea>
                        </div>

                        <hr>

                        <h3>Full Access</h3>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="full-access" id="fullaccessyes" value="yes"
                                @if (old('full-access')=='yes')
                                    checked
                                @endif
                            >
                            <label class="form-check-label" for="fullaccessyes">Yes</label>
                            </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="full-access" id="fullaccessno" value="no"
                                @if (old('full-access')=='no')
                                    checked
                                @endif
                                @if (old('full-access')=== null )
                                    checked
                                @endif
                            >
                            <label class="form-check-label" for="fullaccessno">No</label>
                        </div>

                            <hr>

                            <hr>

                        <h3>Permission List</h3>
                            @foreach ($permissions as $permission)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$permission->id}}" id="permission_{{$permission->id}}" name="permission[]"
                                        @if (is_array(old('permission')) && in_array("$permission->id", old('permission')))
                                            checked

                                        @elseif (is_array($permission_role) && in_array("$permission->id", $permission_role))
                                            checked
                                        @endif
                                    >
                                    <label class="form-check-label" for="permission_{{$permission->id}}">
                                     {{$permission->id}} - {{$permission->name}}
                                     <em>({{$permission->description}})</em>
                                    </label>
                                </div>
                            @endforeach

                        <hr>
                        <input class="btn btn-primary" type="submit" value="Save">
                    
                    </div>

                </form>

        </div>
    </div>

@stop

