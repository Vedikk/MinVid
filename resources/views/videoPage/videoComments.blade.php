
    @foreach($rating as $r)
        @if(empty($r->comment))
            @continue
        @endif
        <div class="col-md-8 col-md-offset-2 comment_cont ">
            <div class="panel-heading ">
                <a href="{{ route('UserPage', ['id'=> $r->user_id]) }}">
                    <img src="/avatars/{{ $r->user()->avatar }}" alt="user_avatar" class="small_user_avatar">
                    <span class="comment_author">{{ $r->user()->name }}</span> <br>
                </a>
                <p class="comment_body">{{ $r->comment }}</p>
                <span class="comment_date">{{ $r->created_at }}</span>
            </div>

        </div>

    @endforeach
    <div class="col-md-8 col-md-offset-2">
        {{ $rating->links() }}
    </div>
