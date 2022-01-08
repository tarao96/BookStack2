@extends('layouts.app')
@section('content')
    <div class="card-header">ユーザー編集</div>
    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <label for="name">ユーザー名</label>
                <div class="col-sm-10">
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="user_image">ユーザー画像</label>
                <div class="col-sm-10">
                    <input type="file" name="user_image" id="user_image" class="form-control">
                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="email">Eメールアドレス</label>
                <div class="col-sm-10">
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="password">パスワード</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control">
                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="password-confirm">パスワード確認</label>
                <div class="col-sm-10">
                    <input type="password" name="password-confirm" class="form-control">
                </div>
            </div>

            <div class="form-group row mt-3">
                <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary mt-3" value="更新する">
                    {{ link_to_route('users.show', '詳細に戻る', $user->id, ['class' => 'btn btn-secondary mt-3']) }}
                </div>
            </div>
        </form>
    </div>
@endsection