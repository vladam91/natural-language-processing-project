@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="row" style="background-color: white">
                <div class="col-md-10">
                    <h1>{{$post->title}}</h1>
                </div>
                <div class="col-md-2">
                    <h3>By: {{$post->user->name}}</h3>
                </div>
            </div>
            <div class="row" style="background-color: white">
                <div class="col-md-12">
                    {!! $post->body !!}
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="/text-posts/create/comment/{{$post->id}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea class="form-control" name="body" id="body" cols="30" rows="5" required>
                                {{old('body')}}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" href="#collapsecoms">Comments </a>
                                </h4>
                            </div>
                            <div id="collapsecoms" class="panel-collapse collapse">
                                <div class="panel-body">
                                    @foreach($comments->reverse() as $comment)
                                        <div class="row">
                                            <div class="col-md-10 col-md-offset-1" style="background: ghostwhite">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4>
                                                            {{$comment->user->name}}:
                                                            @can('delete', $comment)
                                                                <a href="/text-post-comment/delete/{{$comment->id}}" class="pull-right text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                            @endcan
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {{$comment->body}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection