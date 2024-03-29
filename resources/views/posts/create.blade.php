@extends('layouts.app')

@section('content')
 <h1>Create post</h1>
    {!! Form::open(['action' => 'PostController@store' , 'method' => 'POST' ,'enctype'=>'multipart/form-data']) !!}


    <div class ='form-group'>
        {{Form::label('title' , 'Title')}}
        {{Form::text('title' , '', ['class' => 'form-control' , 'placeholder' => 'Title'])}}
    </div>


    <div class ='form-group'>
        {{Form::label('body' , 'body')}}
        {{Form::textarea('body' , '', ['class' => 'form-control' , 'placeholder' => 'body text'])}}
    </div>
    <div class="form-group">
        {{Form::file('cover_image') }}
    </div>
    {{Form::submit('submit' , ['id'=>'#editor','class'=> 'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
