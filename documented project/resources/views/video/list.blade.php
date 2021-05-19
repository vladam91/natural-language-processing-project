@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="background-color: white">
            <div class="row" style="margin-top: 20px; margin-bottom: 50px">
                <div class="col-md-10">
                    <form action="/video-posts/search/" method="post">
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
            @if(count($videoposts) == 0)
                <div class="row">
                    <h3 class="text-muted text-center">No posts found</h3>
                </div>
            @endif
            @foreach($videoposts->reverse() as $videopost)
                <div class="row" >
                    <div class="col-md-10">
                        <a href="/video-post/{{$videopost->id}}" class="text-info"><h1>{{$videopost->title}}</h1></a>
                        <hr/>
                        <h4>{{$videopost->description}}</h4>
                        <h6>@if($videopost->type === 'free')<span class="bg-success"> @else <span class="bg-warning">@endif
                                    <a href="/video-posts/type/{{$videopost->type}}" class="text-info">{{$videopost->type}}</a></span> | <span class="bg-info">
                            <a href="/video-posts/cat/{{$videopost->category->id}}" class="text-info">{{$videopost->category->name}}</a></span>
                        </h6>
                        @can('delete', $videopost)
                            <a href="/video-posts/delete/{{$videopost->id}}" class="btn btn-sm btn-danger pull-right">Delete</a>
                        @endcan
                    </div>
                    <div class="col-md-2">
                        <a href="/video-posts/user/{{$videopost->user->id}}" class="text-info"><h3>By: {{$videopost->user->name}}</h3></a>
                    </div>
                </div>
                <hr/>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            {!! $videoposts->render() !!}
        </div>
    </div>

@endsection