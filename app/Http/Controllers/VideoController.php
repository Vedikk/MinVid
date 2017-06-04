<?php

namespace App\Http\Controllers;

use App\Providers\AuthServiceProvider;
use App\Video;
use FFMpeg\Coordinate\TimeCode;
use FFMpeg\FFProbe;
use Illuminate\Http\Request;
use FFMpeg\FFMpeg;
use Intervention\Image\Facades\Image;


class VideoController extends Controller
{
    public function add()
    {
        if (\Auth::guest()){
            return view('auth.login');
        }
        else {
            return view('video_add');
        }

    }

    public function store(Request $request)
    {

        $this->validate($request, [

            'video_name' => 'required|max:255',
            'path' => 'required'

        ]);

        /*original file path*/
        $file_path = $request->file('path');

        /*initialize FFMpeg*/
        $ffmpeg = FFMpeg::create();

        /*open video with ffpeg*/
        $vidFrame = $ffmpeg->open($file_path);

        /*initialize ffprobe to get video duration*/
        $ffprobe = FFProbe::create();
        $duration = $ffprobe->format($file_path)->get('duration');

        /*get the screenshot */
        $frame = $vidFrame->frame(TimeCode::fromSeconds(round($duration/2)));

        /*give name to screenshot*/
        $frame_name = 'thumbnails/'.  md5(time()*time()) . '.jpg';

        /*save frame*/
        $frame->save( $frame_name);

        /*resize frame*/
        Image::make($frame_name)->resize(640,360)->save($frame_name);

        /*give name to video, and move it to server*/
        $extension = $file_path->getClientOriginalExtension();
        $file_name = md5(time() * time());
        $file_path->move(public_path('videos'), $file_name . '.' . $extension);

        /*create and fill Video model*/
        $data = $request->all();
        $video = new Video;
        $video->fill($data);
        $video->user_id = \Auth::user()->id;
        $video->path = ('/videos/') . $file_name . '.' . $extension;
        $video->screenshot_path = $frame_name;
        $video->short_name = substr($data['video_name'], 0, 27) . '...';

        $video->save();


        return redirect()->back();


    }

   /* public function show()
    {

        $video = \DB::table('videos')->orderBy('created_at', 'desc')->take(10)->get();

        return view('video')->with('video', $video);


    }*/


}
