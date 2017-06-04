<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Video;

class UserController extends Controller
{
    public function show($id){
        $user = User::where('id', $id)->first();

        $videos = \DB::table('videos')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        if ($user->id == \Auth::user()->id)  return redirect('home');

        else return view('user', array(
            'user'=>$user,
            'videos'=>$videos
        ));
    }


}
