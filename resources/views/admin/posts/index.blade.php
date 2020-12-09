@extends('layouts.admin')

@section('content')
    
    <h1>Posts</h1>

    <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Photo</th>
            <th scope="col">User</th>
            <th scope="col">Category ID</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Created At</th>
            <th scope="col">Updated At</th>
          </tr>
        </thead>

        <tbody>
            @if (count($posts)>0)
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$post->id}}</th>
                        <td><img height="50px" src="{{$post->photo ? $post->photo->file : '/images/placeholder.gif'}}" alt=""></td>
                        <td>{{$post->user->name}}</td>
                        <td>{{$post->category_id}}</td>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td>{{$post->created_at->diffForHumans()}}</td>
                        <td>{{$post->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
      </table>

@endsection