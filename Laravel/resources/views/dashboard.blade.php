@extends('layouts.master')

@section('title')
    Dashboard
@endsection
@section('content')
@include('includes.header')
@include('includes.message-block')
   
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>
            <form action="{{ route('post.create') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <input class="form-control" name='title' type="text" placeholder="Your title"><br>
                    <textarea class="form-control" name="body" id="new-post" rows="5" placeholder="Your Post"></textarea>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="file" name="image" placeholder="Choose image" id="image">
                    @error('image')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    </div>
                </div>
                   
                <button type="submit" class="btn btn-primary">Create Post</button>
                <input type="hidden" value="{{ Session::token() }}" name="_token">
            </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What other people say...</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{ $post->id }}">
                    <p>{{ $post->title }}</p>
                    <p>{{ $post->body }}</p>
                    <p class=”col-md-6 d-flex align-items-center justify-content-center”>
                        @if(($post->name)==='noimage.jpg')
                        <p>No Images </p>
                        
                        @else
                        <img src="../public/images/{{$post->name}}" alt="" width="200">
                        @endif
                    </p>
                    <div class="info">
                        Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
                    </div>
                    
                    <div class="interaction">
                        <a href="#" class="like">Like</a> |
                        <a href="#" class="like">Dislike</a>
                        @if(Auth::user() == $post->user)
                            |
                            <a href="#" class="edit">Edit</a> |
                            <a href="{{route('post.delete',['post_id'=>$post->id])}}">Delete</a>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>

@endsection