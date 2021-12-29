@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row m-3">
            @if($users->count() <= 0)
                <p>表示するユーザーがいません</p>
            @else
                @foreach($users as $user)
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('storage/images/'.$user->user_image) }}" alt=" " class="mb-3" style="border-radius: 50%; width: 50px;">
                            <h5 class="card-title">{!! link_to_route('users.show', $user->name, $user) !!}</h5>
                        </div>
                    </div>          
                @endforeach
            @endif
        </div>
    </div>
@endsection