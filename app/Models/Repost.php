<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repost extends Model
{
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function Reposter(){
        return User::find($this->reposter_id)->first();
    }
}
