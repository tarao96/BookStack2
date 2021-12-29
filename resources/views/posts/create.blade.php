@extends('layouts.app')

@section('content')
    <div class="card-header">新規投稿</div>
    <div class="card-body">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            @include('posts._form')
        </form>
    </div>
@endsection