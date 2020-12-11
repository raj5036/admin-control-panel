@extends('layouts.admin')

@section('content')
    
    <h1>Media</h1>
    @if ($photos)
  
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Created_at</th>
            </tr>
            </thead>
    
                <tbody>
                    @foreach ($photos as $photo)
                        
                    
                        <tr>      
                            <td>{{$photo->id}}</td>
                            <td><img height="50" src="{{$photo->file}}" alt=""></td>
                            <td>{{$photo->created_at ? $photo->created_at->diffForHumans() : "No date found!"}}</td>
                            <td>

                                {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminMediasController@destroy', $photo->id]]) !!}
        
        
                                     <div class="form-group">
                                         {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                                     </div>
                                {!! Form::close() !!}
        
        
        
        
                            </td>
                        </tr>
                    
                    @endforeach
                </tbody>

            
        </table>

      @endif
@endsection