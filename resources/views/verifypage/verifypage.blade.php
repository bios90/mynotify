@extends('layouts.default')
@section('content')

    <div class="container p-5">
        @if($errors && count($errors) > 0)
            <div class="alert alert-danger" role="alert">
                @foreach($errors as $error)

                    <p class="m-3 p-0">{{$error}}</p>

                @endforeach
            </div>
        @endif

        @if($result)
            <div class="alert alert-success" role="alert">


                    <p class="m-3 p-0 text-center">Email успешно подтвержден</p>


            </div>
        @endif
    </div>