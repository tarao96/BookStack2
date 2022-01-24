@extends('layouts.app')

@section('content')
<div class="card mx-auto" style="width: 900px;">
    <h5 class="card-header p-3">タイトル: {{ $post->title }}</h5>
    <div class="card-body">
        @if($post->file_name)
            <img class="card-img-top" id="post_show_img" src="{{ Storage::disk('s3')->url($post->file_name) }}" alt=" ">
        @else
            <img class="card-img-top" id="post_show_img" src="../../../sincerely-media-CXYPfveiuis-unsplash.jpg" alt=" ">
        @endif
        <h5 class="card-title" style="margin-left: 30px; margin-top: 30px;">投稿者: {{ $post->user->name }}</h5>
        <div class="card-body">
        @if($post_points)
            @foreach($post_arrays as $post_array)
                @if($post_array['point'] && $post_array['content'])
                <div class="content-wrapper">
                    <div class="point">
                        <h3 style="margin-left: 20px;">{!! nl2br(e($post_array['point'])) !!}</h3>
                    </div>
                    <p class="content">{!! nl2br(e($post_array['content'])) !!}</p>
                </div>
                @endif
            @endforeach
        @else
            <p>ポイントの記載がありません</p>
        @endif
        <div class="thought-wrapper">
            <h2>感想</h2>
            <p class="content">{!! nl2br(e($post->thoughts)) !!}</p>
        </div>

        {{-- 編集・削除ボタン --}}    
        @if($post->user->id == Auth::id())
        {{-- 編集ボタン --}}
        {{ link_to_route('posts.edit','投稿を編集', $post, ['class' => 'btn btn-success']) }}

        {{-- 削除ボタン --}}
        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger mt-3" value="投稿を削除する" onclick='return confirm("本当に削除しますか？");'>
        </form>
        @endif

        {{-- ブックマークボタン --}}
        @if($post->user->id != Auth::id())
            {{-- ブックマーク解除 --}}
            @if($bookmark->exists())
            <form method="POST" action="{{ route('bookmarks.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="submit" value="ブックマークを解除" class="btn btn-danger">
            </form>  
            @else
            {{-- ブックマーク追加 --}}
            <form method="POST" action="{{ route('bookmarks.store') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="submit" value="ブックマークに追加" class="btn btn-primary">
            </form>
            @endif
        @endif
        </div>
    </div>
</div>

<div class="card mt-3 p-3 mx-auto" style="width: 900px;">
    <h5 class="card-title">コメント投稿</h5>
    <div class="card-body">
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <div class="form-group row">
                <div class="col-sm-10">
                    <input type="hidden" value="{{ $post->id }}" name="post_id">
                    <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                    <textarea name="body" id="body" class="form-control" placeholder="コメントを入力してください"></textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary mt-2" value="コメントする">
        </form>
    </div>
</div>

{{-- コメント一覧 --}}
    <div class="card mt-3 p-3 mx-auto" style="width: 900px;">
    @if($comments->count() <= 0)
        <p class="mt-3">表示するコメントがありません</p>
    @else
        <h5 class="card-title">コメント一覧</h5>
        @foreach($comments as $comment)
        @if($comment->post_id == $post->id)
        <div class="card mt-5 p-3 mx-auto" style="width: 800px;">
            <h5 class="card-title">{{ $comment->user->name }}さん</h5>
            <div class="card-body">
                {{ $comment->body }}
            </div>
        </div>
            {{-- コメント編集ボタン --}}
            @if($comment->user_id == Auth::id())
                {{ link_to_route('comments.edit', 'コメントを編集', $comment, ['class' => 'btn btn-success col-sm-2 mt-3', 'style' => 'margin-left: 30px;']) }}
            {{-- コメント削除 --}}
                <form method="POST" action="{{ route('comments.destroy', $comment->id) }}">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" value="{{ $post->id }}" name="{{ $post->id }}">
                    <input type="submit" value="コメントを削除" onclick="return confirm('本当に削除しますか？')" class="btn btn-danger mt-3" style="margin-left: 30px;">
                </form>
            @endif
        @endif
        @endforeach
    </div>
@endif
@endsection