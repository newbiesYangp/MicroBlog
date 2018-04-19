@extends('layouts.default')
@section('content')
    <div class="jumbotron">
        <h1>Welcome to MicroBlog</h1>
        <p class="lead">
            你现在所看到的是<a href="http://.com">微博项目</a>主页
        </p>
        <p>
            一切，又将重新启动！
        </p>
        <p>
            <a href="{{ route('signup') }}" class="btn btn-lg btn-success" role="button">现在注册</a>
        </p>
    </div>
@stop