<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Video;

class Rating extends Model
{

    protected $fillable = array('comment', 'rating', 'video_id', 'user_id');

    public function video(){
        return Video::where('id', $this->video_id)->first();
    }
    public function user(){
        return User::where('id',$this->user_id)->first();
    }



    const CREATED_AT = 'created_at';
    const UPDATED_AT = false;

}
