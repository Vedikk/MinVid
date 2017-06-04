@extends('layouts.app')

@section('content')

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <img src="/avatars/{{ $user->avatar }}"  alt="user_avatar" class="user_avatar">
                            <h3>  {{ $user->name }}</h3><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="last_updates_home_cont container ">
            <h2 class="updates_title_home">{{ $user->name }} last updates!</h2>
            <div class="col-md-10 col-md-offset-1 owl-carousel home-carousel owl-theme  ">
                @foreach($videos as $video)
                    @if($video->deletedFlag)
                        @continue
                    @endif
                    <div class="last_video_home owl-item">
                        <a href="{{ route('videoPage', ['id'=>$video->id]) }}" class=" video_link center-block">
                            <img src="{{ ' http://dev.minvid/'.($video->screenshot_path) }}" alt="last_update_video"
                                 class="video_thumbnail img-thumbnail img-responsive"> <span class="video_name">{{ $video->video_name }}</span>
                        </a>
                    </div>

                @endforeach

            </div>
        </div>
    </div>

@endsection