<?php

namespace App\Http\Controllers;

use App\Rating;
use App\User;
use App\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class VideoPageController extends Controller
{
    protected $rating;

    public function __construct(Rating $rating)
    {
        $this->rating = $rating;
    }

    public function index(Request $request, $id)
    {
        $rating = $this->rating->where('video_id', $id)->latest('created_at')->paginate(5);
        $video = Video::where('id', $id)->first();

        if ($video === null || ($video->deletedFlag == 1 && (\Auth::guest() || \Auth::user()->id != $video->user_id))) {

            $videos = Video::orderBy('created_at', 'desc')
                ->where('deletedFlag', 0)
                ->take(8)
                ->get();

            return view('missing_video', array(
                'videos' => $videos
            ));
        } elseif ($request->ajax()) { //ajax video comments pagination
            return view('videoPage.videoComments',
                array(
                    'rating' => $rating,
                    'video' => $video,
                ))->render();
        }

        $video->increment('viewsCounter'); //incrementing views counter


        return view('videoPage.video', array(
            'rating' => $rating,
            'video' => $video,
        ));
    }


    public function storeComment(Request $request, $id)
    {

        $comment = $request->comment;
        $rating = $request->rating;

        if (\Auth::guest()) {
            return redirect('login');
        } else {
            \DB::table('ratings')->insert(
                ['comment' => $comment, 'rating' => $rating, 'video_id' => $id, 'user_id' => \Auth::user()->id, 'created_at' => Carbon::now()]
            );

            return redirect()->back();
        }

    }

}
