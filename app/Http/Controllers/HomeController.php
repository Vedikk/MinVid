<?php

namespace App\Http\Controllers;

use App\Video;
use Intervention\Image\Facades\Image;

use Illuminate\Http\Request;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('home', array('videos' => $videos, 'user' => Auth::user()));
    }

    public function uploadAvatar(Request $request)
    {

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $fileName = md5(time()) . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar->getRealPath())
                ->resize(300, 300)
                ->save(public_path('/avatars/') . $fileName);
            $user = Auth::user();
            $user->avatar = $fileName;
            $user->save();
        }

        return redirect('home');

    }

    public function deleteVideo(Request $request){

        if ($request->ajax()) {
            $id = $request->id;
            $video = Video::where('id', $id);
            $video->update(['deletedFlag' => 1]);

        }

    }

    public function returnVideo(Request $request){

        if ($request->ajax()){
            $id = $request->id;
            $video = Video::where('id', $id);
            $video->update(['deletedFlag' =>0]);
        }
    }

}
