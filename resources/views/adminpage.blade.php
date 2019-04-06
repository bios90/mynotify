@extends('layouts.default')
@section('content')

    <div class="container p-5">

        {!! Form::open(['method'=>'POST','action'=>'AdminController@send']) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title:'); !!}
            {!! Form::text('title', null,['class'=>'form-control']); !!}
        </div>

        <div class="form-group">
            {!! Form::label('message1', 'Message 1:'); !!}
            {!! Form::textarea('message1', null,['class'=>'form-control','rows'=>3]); !!}
        </div>

        <div class="form-group">
            {!! Form::label('message2', 'Message 2:'); !!}
            {!! Form::textarea('message2', null,['class'=>'form-control','rows'=>3]); !!}
        </div>

        <div class="form-group">
            {!! Form::label('message3', 'Message 3:'); !!}
            {!! Form::textarea('message3', null,['class'=>'form-control','rows'=>3]); !!}
        </div>

        <div class="form-group">
            {!! Form::label('url', 'Image Url :'); !!}
            {!! Form::text('url', null,['class'=>'form-control']); !!}
        </div>

        <div class="row">
            <div class="col">
                @foreach($users as $user)

                    <div class="form-check form-check-inline p-3">
                        <input class="form-check-input" type="checkbox" id="cheb{{$user->id}}" name="users[]"
                               value="{{$user->id}}">
                        <label class="form-check-label" for="cheb{{$user->id}}">{{$user->name}}</label>
                    </div>

                @endforeach
            </div>
        </div>

        <div class="form-group">
            {!! Form::submit('Submit',['class'=>'btn btn-primary btn-block']); !!}
        </div>


        {!! Form::close() !!}

    </div>

@stop