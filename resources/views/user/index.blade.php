@extends('adminlte::page')

@section('title', 'AFP - Users')
@section('content_header')
    <h1>Users</h1>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">


            @include('custom.message')

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role(s)</th>
                        <th colspan="2">Options</th>
                    </tr>
                </thead>
                <tbody>      
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @isset($user->roles[0]->name)
                                    {{$user->roles[0]->name}}
                                @endisset
                            </td>
                            <td><a class="btn btn-success" href="{{route('user.edit', $user->id)}}">Edit</a></td>
                            <td>
                                <form action="{{route('user.destroy', $user->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" >Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>

@stop
