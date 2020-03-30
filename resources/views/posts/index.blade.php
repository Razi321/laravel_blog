@extends('layouts.app')

@section('content')
    <h1>posts</h1>
    @if (count($posts) > 0 )
    @foreach ($posts as $post)

        <div class ='card p-3 mt-3 mb-3'>
        <div class="row">
            <div class="col-md-4 col-sm-4">
            <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">

            </div>
            <div class="col-md-8 col-sm-8">
                <h2 > <a href="/Posts/{{$post->id}}">   {{$post->title}} </a></h2>
                <small>Written on {{$post->created_at}} by {{$post->user->first_name}}</small>
            </div>

        </div>

        </div>
    @endforeach

    {{$posts->links()}}


    @else
    <p>no post found</p>
    @endif
@endsection
