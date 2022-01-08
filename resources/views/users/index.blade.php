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
                            <img src="{{ asset('storage/images/'.$user->user_image) }}" alt=" " style="border-radius: 50%; width: 50px;">
                            {!! link_to_route('users.show', $user->name, $user, ['class' => 'text-secondary text-decoration-none h5']) !!}
                        </div>
                    </div>          
                @endforeach
            @endif
        </div>
    </div>
@endsection