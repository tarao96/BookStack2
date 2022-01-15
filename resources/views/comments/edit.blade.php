@extends('layouts.app')

@section('content')
    <div class="card-header">コメント編集</div>
    <div class="card-body">
        <form method="POST" action="{{ route('comments.update', $comment) }}">
            @csrf
            @method('PATCH')
            <input type="hidden" value="{{ $comment->post->id }}" name="$comment_post_id">
            <div class="form-group row">
                <label for="body">コメント内容</label>
                <div class="col-sm-10">
                    <textarea name="body" id="body" class="form-control">{{ $comment->body }}</textarea>
                </div>
            </div>
            <input type="submit" value="コメントを更新" class="btn btn-primary mt-3">
        </form>
    </div>
@endsection