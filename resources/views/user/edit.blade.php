@extends('adminlte::page')

@section('title', 'AFP - Edit User')
@section('content_header')
    <h1>Edit User</h1>
@endsection
@section('content')


    <div class="card">
        <div class="card-body">

            @include('custom.message')

            <form action="{{route('user.update', $user->id)}}" method="POST">
                @csrf
                @method('PUT')

                <div class="container">
                    <h3>Required Data</h3>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{old('name', $user->name)}}">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{old('email', $user->email)}}">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control" name="roles" id="roles">
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}"
                                    @isset($user->roles[0]->name)
                                        @if($role->name == $user->roles[0]->name)
                                            selected
                                        @endif
                                    @endisset>
                                    {{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <hr>

                    <input class="btn btn-primary" type="submit" value="Save">
            
                </div>

            </form>


        </div>
    </div>

@stop

