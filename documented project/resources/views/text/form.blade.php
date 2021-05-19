@extends('layouts.app')
@section('content')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">


            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif




            <form action="/create-post" method="post" enctype="multipart/form-data">

                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" class="form-control" name="description" value="{{old('description')}}" required>
                </div>

                <div class="form-group">
                    <label for="cat">Select category:</label>
                    <select class="form-control" id="cat" name="cat">
                        @foreach($cats as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">Type</label> <br/>
                    <label class="radio-inline"><input type="radio" name="type" value="free" checked>Free</label>
                    <label class="radio-inline"><input type="radio" name="type" value="paid">Paid</label>
                </div>

                <div class="form-group">
                    <label for="body">Your post</label>
                    <textarea name="body" class="form-control editor" rows="15">{!! old('body') !!}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection