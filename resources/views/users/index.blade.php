@extends('layouts.default')
@section('title', '所有用户')

@section('content')
    <div class="col-md-offset-2 col-md-8">
        <h1>所有用户</h1>
        <u1 class="users">
            @foreach ($users as $user)
                @include('users._user')
            @endforeach
        </u1>

        {!! $users->render() !!}
    </div>
@stop