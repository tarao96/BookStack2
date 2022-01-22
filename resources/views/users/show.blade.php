@extends('layouts.app')
@section('content')

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a href="#user" class="nav-link active" data-toggle="tab">ユーザー</a>
        </li>
        <li class="nav-item">
            <a href="#bookmark" class="nav-link" data-toggle="tab">ブックマーク</a>
        </li>
        <li class="nav-item">
            <a href="#comment" class="nav-link" data-toggle="tab">コメント</a>
        </li>
    </ul>

    <div class="tab-content">
        <div id="user" class="tab-pane active">
            <div class="card-header" style="text-align: center;">ユーザー登録情報</div>
            <div class="card-body" style="text-align: center;">
                <div class="mb-5">
                    @if($user->user_image)
                        <img class="user_icon mb-3" src="data:image/jpeg;base64,{{ $user->user_image }}" alt=" ">
                    @else
                        <img class="user_icon mb-3" src="../../../社長のアイコン.jpeg" alt=" ">
                    @endif
                    <h2>ユーザー名: {{ $user->name }}</h2>
                    <h5>メールアドレス: {{ $user->email }}</h5>
                </div>
                @if($user->id == Auth::id())
                {{-- 編集ボタン --}}
                {{ link_to_route('users.edit', 'ユーザー情報を編集する', $user, ['class' => 'btn btn-success']) }}
                {{-- 削除ボタン --}}
                <form method="POST" action="{{ route('users.destroy', $user->id) }}" style="text-align: center">
                    @csrf
                    @method('delete')
                    <input type="submit" value="退会する" class="btn btn-danger mt-3" onclick="return confirm('退会すると、ユーザー情報が削除されます。本当に退会しますか？')">
                </form>
                @endif
            </div>
        </div>

        <div id="bookmark" class="tab-pane">
            <div class="card-header" style="text-align: center;">ブックマーク</div>
            <div class="card-body">
                <div class="container">
                    <div class="row m-3">
                        @foreach($bookmarks as $bookmark)
                        <div class="card mb-3 mx-auto" style="width: 300px; margin-right: 30px;">
                                @if($bookmark->post->file_name)
                                    <img class="card-img-top" src="{{ Storage::url($bookmark->post->file_name) }}" alt=" ">
                                @else   
                                    <img class="card-img-top" src="../../../sincerely-media-CXYPfveiuis-unsplash.jpg" alt=" ">
                                @endif
                            <div class="card-body">
                                <h5 class="card-title">{!! link_to_route('posts.show', $bookmark->post->title, $bookmark->post) !!}</h5>
                                <p class="card-text text-truncate" style="max-width: 300px;">{{ $bookmark->post->thoughts }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="comment" class="tab-pane">
                <div class="card-header" style="text-align: center;">コメント</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row m-3">
                            @foreach($comments as $comment)
                            <div class="card mb-3 mx-auto" style="width: 300px; margin-right: 30px;">
                                    @if($comment->post->file_name)
                                        <img class="card-img-top" src="{{ Storage::url($comment->post->file_name) }}" alt=" ">
                                    @else   
                                        <img class="card-img-top" src="../../../sincerely-media-CXYPfveiuis-unsplash.jpg" alt=" ">
                                    @endif
                                <div class="card-body">
                                    <h5 class="card-title">{!! link_to_route('posts.show', $comment->post->title, $comment->post) !!}</h5>
                                    <p class="card-text text-truncate" style="max-width: 300px;">{{ $comment->post->thoughts }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection