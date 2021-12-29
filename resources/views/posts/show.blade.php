@extends('layouts.app')

@section('content')
<div class="card" style="width: 500px;">
    <div class="card-header">{{ $post->title }}</div>
    <div class="card-body">
        <img class="card-img-top" src="../../uploads/D7493486-7A27-46C9-97E5-FB0CA35C2240_1_105_c.jpeg" alt=" ">
        <div class="card-body">
        @if($post_points)
            @foreach($post_points as $post_point)
                @if($post_point)
                <h2>ポイント</h2>
                <p>{!! nl2br(e($post_point)) !!}</p>
                @endif
            @endforeach
        @else
            <p>ポイントの記載がありません</p>
        @endif
            <h2>感想</h2>
            <p>{!! nl2br(e($post->thoughts)) !!}</p>
        {{-- 編集ボタン --}}
        {{ link_to_route('posts.edit','投稿を編集', $post, ['class' => 'btn btn-success']) }}

        {{-- 削除ボタン --}}
        <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
            @csrf
            @method('delete')
            <input type="submit" class="btn btn-danger mt-3" value="投稿を削除する" onclick='return confirm("本当に削除しますか？");'>
        </form>
        </div>
    </div>
</div>
@endsection