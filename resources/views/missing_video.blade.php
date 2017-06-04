@extends('layouts.app')

@section('content')

    <div class="container">
        <img class="img-responsive pic_missing_video" src="/img/missing_video.jpg" alt="missing_video">
    </div>
    <div class="container">
        <h1 class="welcome_title">
            But we still have a lot of video
        </h1>
        @foreach($videos as $video)
            @if($video->deletedFlag)
                @continue
            @endif
            <div class="col-lg-3 col-md-4 col-sm-6 ">
                <a href="{{ route('videoPage', ['id'=>$video->id]) }}" class="video_link center-block"
                   title="{{ $video->video_name }}">
                    <span class="video_name">{{ $video->short_name }}</span>
                    <img src="{{ '../'.$video->screenshot_path }}" alt="last_update_video"
                         class="video_thumbnail img-thumbnail img-responsive">
                </a>
                <div class="video_descript_welcome">
                    <p>
                        <input class="kv-ltr-theme-fa-alt rating-loading welcome_video_rating"
                               value="{{ $video->ratingAvg() }}">
                        <span class="desc_span_welcome">
                                <a href="{{ route('UserPage', ['id'=> $video->user_id]) }}">
                                    {{ $video->user()->name }}
                                </a>
                            {{ $video->created_at}}
                            <i class="fa fa-eye" aria-hidden="true"></i> {{ $video->viewsCounter }}
                            <i class="fa fa-comments-o" aria-hidden="true"></i> {{ $video->commentsCount() }}
                            </span>
                        <br>
                    </p>
                </div>
            </div>
        @endforeach
    </div>

@endsection