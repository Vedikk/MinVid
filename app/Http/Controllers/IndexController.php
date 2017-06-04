<?php

namespace App\Http\Controllers;

use App\Rating;
use App\User;
use App\Video;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('created_at', 'desc')
            ->paginate(8);

        return view('welcome', array(
            'videos' => $videos,
        ));

    }

    public function byRating(){



        $videos = Video::leftJoin('ratings', 'videos.id', '=', 'ratings.video_id')
            ->select(array('videos.*',
                \DB::raw('AVG(ratings.rating) as ratings_average')
            ))
            ->groupBy('videos.id')
            ->orderBy('ratings_average', 'desc')
            ->paginate(8);

        return view('welcome', array(
            'videos' => $videos,
        ));

    }

}
