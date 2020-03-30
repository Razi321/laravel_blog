@extends('layouts.app')

@section('content')
<a href="/Posts" class="btn btn-outline-secondary" >Go back</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <br>
    <br>

    <div>
        {!!$post->body!!}
    </div>
<hr>
<small>Written on {{$post->created_at}} by {{$post->user->first_name}}</small>
<hr>
@auth
@if(Auth::user()->id ==$post->user_id)
<a href="/Posts/{{$post->id}}/edit" class="btn btn-outline-secondary">Edit</a>

{!!Form::open(['action'=>['PostController@destroy' , $post->id] , 'method' =>'POST' , 'class' =>'float-right'])!!}


{{Form::hidden('_method' , 'DELETE')}}
{{Form::submit('Delete' , ['class'=>'btn btn-danger'])}}
{!!Form::close()!!}
@endif
@endauth
@endsection
