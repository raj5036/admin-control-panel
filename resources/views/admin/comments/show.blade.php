@extends('layouts.admin')

@section('content')
    
    <h1>Comments</h1>


    @if (count($comments))
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
                @foreach ($comments as $comment)
                    <tr>
                        <th scope="row">{{$comment->id}}</th>
                        <td>{{$comment->author}}</td>
                        <td>{{$comment->email}}</td>
                        <td>{{$comment->body}}</td>
                        <td><a href="{{route('home.post',$comment->post->id)}}">{{$comment->post->title}}</a></td>
                        <td>{{$comment->created_at->diffForHumans()}}</td>
                        <td>
                            @if($comment->is_active == 1)
                                {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}


                                <input type="hidden" name="is_active" value="0">


                                    <div class="form-group">
                                        {!! Form::submit('Un-approve', ['class'=>'btn btn-warning']) !!}
                                    </div>
                                {!! Form::close() !!}


                        @else
                                {!! Form::open(['method'=>'PATCH', 'action'=> ['PostCommentsController@update', $comment->id]]) !!}


                                <input type="hidden" name="is_active" value="1">


                                <div class="form-group">
                                    {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                                </div>
                                {!! Form::close() !!}
                        @endif
                        </td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=> ['PostCommentsController@destroy', $comment->id]]) !!}
          
          
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
        <h1 class="lead">No Comments</h1>
    @endif

    

@endsection