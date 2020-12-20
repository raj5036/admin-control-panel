@extends('layouts.admin')

@section('content')
    
    <h1>Replies</h1>


    @if (count($replies))
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Body</th>
                <th scope="col">Respective Post</th>
                <th scope="col">Created At</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($replies as $reply)
                    <tr>
                        <th scope="row">{{$reply->id}}</th>
                        <td>{{$reply->author}}</td>
                        <td>{{$reply->email}}</td>
                        <td>{{$reply->body}}</td>
                        <td><a href="{{route('home.post',$reply->comment->post->id)}}">{{$reply->comment->post->title}}</a></td>
                        <td>{{$reply->created_at->diffForHumans()}}</td>
                        <td>
                            @if($reply->is_active == 1)
                                {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}


                                <input type="hidden" name="is_active" value="0">


                                    <div class="form-group">
                                        {!! Form::submit('Un-approve', ['class'=>'btn btn-warning']) !!}
                                    </div>
                                {!! Form::close() !!}


                        @else
                                {!! Form::open(['method'=>'PATCH', 'action'=> ['CommentRepliesController@update', $reply->id]]) !!}


                                <input type="hidden" name="is_active" value="1">


                                <div class="form-group">
                                    {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                                </div>
                                {!! Form::close() !!}
                        @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=> ['CommentRepliesController@destroy', $reply->id]]) !!}
          
          
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}
          
          
          
                        </td>
                    </tr>
                @endforeach            
            </tbody>
        </table>
    @else 
        <h1 class="lead">No Replies</h1>
    @endif

    

@endsection