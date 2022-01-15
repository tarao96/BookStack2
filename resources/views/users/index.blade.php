@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row m-3">
            @if($users->count() <= 0)
                <p>表示するユーザーがいません</p>
            @else
                @foreach($users as $user)
                    <div class="card mt-3" style="width: 700px;">
                        <div class="card-body">
                            @if($user->user_image)
                                <img class="user_small_icon" src="{{ asset('storage/images/'.$user->user_image) }}" alt=" ">
                            @else
                                <img class="user_small_icon mb-3" src="../../../社長のアイコン.jpeg" alt=" ">
                            @endif
                            {!! link_to_route('users.show', $user->name, $user, ['class' => 'text-secondary text-decoration-none h5']) !!}
                        </div>
                    </div>          
                @endforeach
            @endif
        </div>
    </div>
@endsection