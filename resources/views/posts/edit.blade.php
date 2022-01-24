@extends('layouts.app')

@section('content')
    <div class="card-header">投稿編集</div>
    <div class="card-body">
        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
        <div class="form-group row">
            <label for="title">タイトル</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control" value="{{ $post->title }}">
            </div>
        </div>

        <div class="from-group row mt-3">
            <label for="file_name">画像ファイル</label>
            <div class="col-sm-10">
                <input type="file" name="file_name" class="form-control">
            </div>
        </div>

        @for($i = 1; $i < 6; $i++)
        <div class="form-group row post-form-group" style="margin-top: 50px;">
            <label for="point{{ $i }}">ポイント{{ $i }}</label>
            <div class="col-sm-10">
                <input type="text" name="point{{ $i }}" class="form-control">
            </div>
            <label for="content{{ $i }}">内容</label>
            <div class="col-sm-10">
                <textarea name="content{{ $i }}" class="point-form form-control">{{ old('content$i') }}</textarea>
            </div>
        </div>
        @endfor

        <div class="form-group row mt-3">
            <label for="thoughts">感想</label>
            <div class="col-sm-10">
                <textarea name="thoughts" class="point-form form-control">{{ $post->thoughts }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <div class="col-sm-10">
                <input type="submit" class="btn btn-primary" value="更新する">
                {{ link_to_route('posts.index', '一覧に戻る', null, ['class' => 'btn btn-secondary']) }}
            </div>
        </div>
        </form>
    </div>
@endsection