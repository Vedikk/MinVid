<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class Video extends Model
{


    protected $fillable = array('video_name', 'user_id', 'path', 'screenshot_path', 'short_name', 'deletedFlag');

    public function rating(){
        return Rating::where('video_id', $this->id)->first();
    }

    public function ratingAvg(){
        return Rating::where('video_id', $this->id)->avg('rating');
    }

    public function user(){
        return User::where('id', $this->user_id)->first();
    }
    public function commentsCount(){
        $count = Rating::where('video_id', $this->id)->count();
        return $count;
    }

    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';
}
