@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="/Posts/create" class="btn btn-primary">Create post </a>
                    <br>

                   <h3> You are logged in!</h3>
                   @if(count($Posts) >0)
                   <table class="table table-striped">
                       <tr>
                           <th>Title</th>
                           <th></th>
                           <th></th>
                       </tr>
                       @foreach ($Posts as $post)
                       <tr>
                       <td>{{$post->title}}</td>
                       <td> <a href="/Posts/{{$post->id}}/edit" class="btn btn-warning"> Edit</a></td>
                        <td>

{!!Form::open(['action'=>['PostController@destroy' , $post->id] , 'method' =>'POST' , 'class' =>'float-right'])!!}


{{Form::hidden('_method' , 'DELETE')}}
{{Form::submit('Delete' , ['class'=>'btn btn-danger'])}}
{!!Form::close()!!}
                        </td>
                    </tr>

                       @endforeach


                   </table>

                   @else
                   <h5>you have no posts</h5>
                   @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
