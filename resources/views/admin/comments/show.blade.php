@extends('layouts.admin')
@section('content')
    @if(count($comments) > 0)
        <h1>Comentarios</h1>
        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Usuario</th>
                <th>Cuerpo del mensaje</th>
                <th>Post</th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments as $comment)
                <tr>
                    <td>{{ $comment->id }}</td>
                    <td>{{ $comment->author }}</td>
                    <td>{{ $comment->body }}</td>
                    <td><a href="{{ route('home.post', $comment->post->id) }}">{{ $comment->post->title }}</a></td>
                    <td>
                        @if($comment->is_active == 1)
                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="0">
                            <div class="form-group">
                                {!! Form::submit('Desactivar', ['class'=>'btn btn-danger']) !!}
                            </div>
                            {!! Form::close() !!}
                        @else
                            {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            <input type="hidden" name="is_active" value="1">
                            <div class="form-group">
                                {!! Form::submit('Activar', ['class'=>'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}
                        @endif
                    </td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Eliminar', ['class'=>'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 class="text-center">Sin Comentarios</h1>
    @endif
@stop