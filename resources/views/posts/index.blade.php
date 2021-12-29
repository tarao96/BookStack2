@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row m-3">
            @if($posts->count() <= 0)
                <p>表示する投稿はありません</p>
            @else
                @foreach($posts as $post)
                    <div class="card" style="width: 300px;">
                        <img class="card-img-top" src="{{ Storage::url($post->file_name) }}" alt=" ">
                        <div class="card-body">
                            <h5 class="card-title">{!! link_to_route('posts.show', $post->title, $post) !!}</h5>
                            <p class="card-text text-truncate">{{ $post->thoughts }}</p>
                        </div>
                    </div>
                @endforeach
            @endif
    </div>
</div>

@endsection