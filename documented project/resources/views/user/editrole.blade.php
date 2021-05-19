@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-2">
            <h4><b>Name: </b>{{$user->name}}</h4>
            <h4><b>Surname: </b>{{$user->surname}}</h4>
            <h4><b>Email: </b>{{$user->email}}</h4>
            <h4><b>Currently: </b>{{$user->role->type}}</h4>
        </div>
        <div class="col-md-4">
            <form class="form" action="/user/role/edit/{{$user->id}}" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="type">Select role:</label>
                    <select class="form-control" id="type" name="type">
                        @foreach($roles as $role)
                            @if($role->type != 'admin')
                                <option value="{{$role->id}}">{{$role->type}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
                <a href="/admin-panel" class="btn btn-danger">Back</a>
            </form>
        </div>
    </div>


@endsection