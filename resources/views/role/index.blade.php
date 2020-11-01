@extends('adminlte::page')

@section('title', 'Roles')
@section('content_header')
    <h1>Roles</h1>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">

            <a href="{{route('role.create')}}" class="btn btn-primary float-left">
                Create
            </a>
            <br><br>

            @include('custom.message')

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Full-Access</th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>      
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>{{$role->slug}}</td>
                            <td>{{$role->description}}</td>
                            <td>{{$role['full-access']}}</td>
                            <td><a class="btn btn-success" href="{{route('role.edit', $role->id)}}">Edit</a></td>
                            <td>
                                <form action="{{route('role.destroy', $role->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" >Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$roles->links()}}
        </div>
    </div>

@stop
