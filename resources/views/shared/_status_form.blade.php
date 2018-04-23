<form action="{{ route('statuses.store') }}" method="post">
    @include ('shared._errors')
    {{ csrf_field() }}
    <textarea name="content" id=""  rows="3" class="form-control" placeholder="聊聊新鲜事儿....">{{ old('content') }}</textarea>
    <button class="btn btn-primary pull-right">发布</button>
</form>