@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    Users
                                </a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Surname</th>
                                        <th>Email</th>
                                        <th>Subbed?</th>
                                        <th>Role</th>
                                        <th>Edit Role</th>
                                        <th>Ban</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <th>
                                                {{$user->id}}
                                            </th>
                                            <td>
                                                {{$user->name}}
                                            </td>
                                            <td>
                                                {{$user->surname}}
                                            </td>
                                            <td>
                                                {{$user->email}}
                                            </td>
                                            <td>
                                                @if($user->subscribed('main'))
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                {{$user->role->type}}
                                            </td>
                                            <td>
                                                @if(!$user->isAdmin())
                                                    <a href="/user/role/{{$user->id}}" class="btn btn-sm btn-default">Edit</a>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!$user->isAdmin())
                                                    @if($user->isBanned())
                                                        <a href="/user/unban/{{$user->id}}" class="btn btn-sm btn-success">Unban</a>
                                                    @else
                                                        <a href="/user/ban/{{$user->id}}" class="btn btn-sm btn-danger">Ban</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td style="text-align: center">
                                                @if(!$user->isAdmin())
                                                    <a href="/user/delete/{{$user->id}}" ><i class="fa fa-trash" style="color: red" aria-hidden="true"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Text Posts
                            </a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <th>
                                            {{$post->id}}
                                        </th>
                                        <td>
                                            {{$post->title}}
                                        </td>
                                        <td>
                                            {{$post->user->name}}
                                        </td>
                                        <td>
                                            <a href="/admin/delete/text/{{$post->id}}" ><i class="fa fa-trash" style="color: red" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Video Posts
                            </a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($videos as $video)
                                    <tr>
                                        <th>
                                            {{$video->id}}
                                        </th>
                                        <td>
                                            {{$video->title}}
                                        </td>
                                        <td>
                                            {{$video->user->name}}
                                        </td>
                                        <td>
                                            <a href="/video-posts/delete/{{$video->id}}" ><i class="fa fa-trash" style="color: red" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection