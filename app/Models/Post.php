<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $dates = ['deleted_at', 'created_at'];
    protected $appends = ['date'];


    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reposts()
    {
        return $this->hasMany(Repost::class);
    }

    public function op()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Replies(){
        return Reply::where('replyto_id',"=",$this->id)->get();
    }
    public function ReplyTo(){
        $getreply = Reply::withTrashed()->where('post_id',"=",$this->id)->first();
        $getop = Post::withTrashed()->find($getreply->replyto_id);
        return $getop;
    }

    public function TimelineOP(){
      return Timeline::withTrashed()
                      ->where('post_id','=',$this->id)
                      ->first();
    }


    public function getDateAttribute() {
        return $this->created_at->diffForHumans();
    }

}
