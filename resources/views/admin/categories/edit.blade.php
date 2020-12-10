@extends('layouts.admin')

@section('content')
    
    <h1>Update this Category</h1>

    <div class="col-sm-6">
        {!! Form::model($category,['method'=>'PUT', 'action'=> ['AdminCategoriesController@update',$category->id]]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control'])!!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>
        {!! Form::close() !!}

        
            {!! Form::model($category,['method'=>'DELETE', 'action'=> ['AdminCategoriesController@destroy',$category->id]]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>
            {!! Form::close() !!}
    </div>


@endsection