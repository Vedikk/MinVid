@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach($users as $user)
            <div class="col-md-3 col-sm-4 user_block_all_users ">
                <a href="{{ route('UserPage', ['id'=>$user->id]) }}" style="background: url('/avatars/{{ $user->avatar }}');  background-size: contain;" class="user_link_all_users">
                    <h3 class="user_name_all_users">  {{ $user->name }}</h3>
                </a>

            </div>
        @endforeach
    </div>
@endsection