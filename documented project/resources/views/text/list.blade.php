@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="background-color: white">
            <div class="row" style="margin-top: 20px; margin-bottom: 50px">
                <div class="col-md-10">
                    <form action="/text-posts/search/" method="post">
                        {!! csrf_field() !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search posts..." required>
                            <span class="input-group-btn"><button class="btn btn-default" type="submit">
                                    <i class="fa fa-search" aria-hidden="true"></i></button></span>
                        </div>
                    </form>
                </div>
                <div class="col-md-1">
                    <img src="/img/algolia.svg" class="img-responsive" alt="Powered by: Algolia">
                </div>
            </div>
            @if(count($posts) == 0)
                <div class="row">
                    <h3 class="text-muted text-center">No posts found</h3>
                </div>
            @endif
            @foreach($posts->reverse() as $post)
                <div class="row" >
                    <div class="col-md-10">
                        <a href="/text-post/{{$post->id}}" class="text-info"><h1>{{$post->title}}</h1></a>
                        <hr/>
                        <h4>{{$post->description}}</h4>
                        <h6>@if($post->type === 'free')<span class="bg-success"> @else <span class="bg-warning">@endif
                                    <a href="/text-posts/type/{{$post->type}}" class="text-info">{{$post->type}}</a></span> | <span class="bg-info">
                            <a href="/text-posts/cat/{{$post->category->id}}" class="text-info">{{$post->category->name}}</a></span>
                        </h6>
                        @can('delete', $post)
                            <a href="/text-posts/delete/{{$post->id}}" class="btn btn-sm btn-danger pull-right">Delete</a>
                        @endcan
                    </div>
                    <div class="col-md-2">
                        <a href="/text-posts/user/{{$post->user->id}}" class="text-info"><h3>By: {{$post->user->name}}</h3></a>
                    </div>
                </div>
                <hr/>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            {!! $posts->render() !!}
        </div>
    </div>

@endsection