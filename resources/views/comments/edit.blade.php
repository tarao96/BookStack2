@extends('layouts.app')

@section('content')
    <div class="card-header">コメント編集</div>
    <div class="card-body">
        <form action="{{ route('comments.update', $comment) }}">
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <label for="body">コメント内容</label>
                <textarea name="body" id="body" class="form-control">{{ $comment->body }}</textarea>
            </div>
        </form>
    </div>
@endsection