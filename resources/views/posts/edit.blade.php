@extends('layouts.app')
@section('content')
 <h1>Edit post</h1>
    {!! Form::open(['action' => ['PostController@update' , $post->id] , 'method' => ' Post','enctype'=>'multipart/form-data']) !!}


    <div class ='form-group'>
        {{Form::label('title' , 'Title')}}
        {{Form::text('title' , $post->title, ['class' => 'form-control' , 'placeholder' => 'Title'])}}
    </div>


    <div class ='form-group'>
        {{Form::label('body' , 'body')}}
        {{Form::textarea('body' , $post->body, ['class' => 'form-control' , 'placeholder' => 'body text'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image') }}
    </div>
    {{Form::hidden('_method' , 'PUT')}}
    {{Form::submit('submit' , ['id'=>'#editor','class'=> 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
