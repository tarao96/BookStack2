@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row m-3">
            @if($posts->count() <= 0)
                <p>表示する投稿はありません</p>
            @else
                @foreach($posts as $post)
                    <div class="card mb-3 mx-auto" style="width: 300px; margin-right: 30px;">
                        @if($post->file_name)
                            <img class="card-img-top" src="{{ Storage::url($post->file_name) }}" alt=" ">
                            <!-- 参考 <img class="user_icon mb-3" src="{{ Storage::disk('s3')->url($post->) -->
                        @else
                            <img class="card-img-top" src="../../../sincerely-media-CXYPfveiuis-unsplash.jpg" alt=" ">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{!! link_to_route('posts.show', $post->title, $post) !!}</h5>
                            <p class="card-text text-truncate" style="max-width: 300px;">{{ $post->thoughts }}</p>
                        </div>
                    </div>
                @endforeach
                {{ $posts->links() }}
            @endif
    </div>
</div>

@endsection