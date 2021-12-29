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

        <div class="form-group row mt-3">
            <label for="point1">ポイント1</label>
            <div class="col-sm-10">
                <textarea name="point1" class="form-control">{{ $post->point1 }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="point2">ポイント2</label>
            <div class="col-sm-10">
                <textarea name="point2" class="form-control">{{ $post->point2 }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="point3">ポイント3</label>
            <div class="col-sm-10">
                <textarea name="point3" class="form-control">{{ $post->point3 }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="point4">ポイント4</label>
            <div class="col-sm-10">
                <textarea name="point4" class="form-control">{{ $post->point4 }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="point5">ポイント5</label>
            <div class="col-sm-10">
                <textarea name="point5" class="form-control">{{ $post->point5 }}</textarea>
            </div>
        </div>

        <div class="form-group row mt-3">
            <label for="thoughts">感想</label>
            <div class="col-sm-10">
                <textarea name="thoughts" class="form-control">{{ $post->thoughts }}</textarea>
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