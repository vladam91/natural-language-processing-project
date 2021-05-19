@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    Welcome, {{\Illuminate\Support\Facades\Auth::user()->name}}!
                </div>

                <div class="panel-body">
                    <div class="col-md-10">
                        <table>
                            <tr>
                                @for($i = 0; $i < count($categories); $i++)
                                    @if($i % 4 == 0 and $i != 0)
                            </tr>
                                    <tr>
                                    @endif
                                        <td>
                                            <h3 class="text-center">{{$categories[$i]->name}}</h3><hr><a href="#modal{{$categories[$i]->name}}" role="button" data-toggle="modal"><img src="{{$categories[$i]->url}}"></a>
                                        </td>

                                @endfor
                                    </tr>
                        </table>

                        @for($i = 0; $i < count($categories); $i++)
                            <div class="modal fade" id="modal{{$categories[$i]->name}}">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <!-- header -->
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title">Choose tutorials:</h3>
                                        </div>

                                        <!-- body (form) -->
                                        <div class="modal-body">
                                            <a href="text-posts/cat/{{$categories[$i]->id}}">Text Tutorials</a><br>
                                            <a href="video-posts/cat/{{$categories[$i]->id}}">Video Tutorials</a>
                                        </div>
                                        <!-- button -->
                                    </div>
                                </div>
                            </div>
                        @endfor

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
