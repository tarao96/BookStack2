@extends('layouts.app')
@section('content')
    <div class="card-header" style="text-align: center;">ユーザー登録情報</div>
    <div class="card-body" style="text-align: center;">
        <div class="mb-5">
            <img src="{{ asset('storage/images/'.$user->user_image) }}" alt=" " class="mb-3" style="border-radius: 50%; width: 100px;">
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
@endsection