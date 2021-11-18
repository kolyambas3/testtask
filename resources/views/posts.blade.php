@extends('layouts.master')

@section('content')
    @can('employee', auth()->user())
        <a href="{{route('post.create')}}" class="btn btn-success">Create post</a>
    @endcan
    @foreach($posts as $post)
        <hr>
        <div class="col-lg-3 col-md-3 col-xs-3 mt-3">
            <h1>{{$post->name}}</h1>
            @can('manage', auth()->user())
                <a href="/user-posts/{{$post->user->id}}">User:{{$post->user->id}}</a>
            @endcan
            <br>
            <a href="/category/{{$post->category_id}}">Category:{{$post->category->name}}</a>
            <img src="{{asset('images').'/'.$post->image}}" width="300px" alt="">
            <form method="POST" action="/post/{{$post->id}}">
                @csrf
                {{method_field('DELETE')}}
                <div class="form-group">
                    <input type="submit" class="btn btn-danger" value="delete">
                </div>
            </form>
            @can('employee', auth()->user())
                <a href="/post/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
            @endcan
        </div>
    @endforeach
    <div class="d-flex justify-content-center">
        {!! $posts->links() !!}
    </div>
@endsection
