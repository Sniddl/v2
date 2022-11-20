<?php

namespace App\Models;

use App\Relations\Traits\BelongsToThrough;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{

    use BelongsToThrough;

    protected $fillable = [
        'user_id',
    ];

    public function entry () {
        return $this->belongsTo(Timeline::class, 'post_id');
    }

    public function post () {
        return $this->belongsToThrough(Post::class, Timeline::class, 'post_id', 'post_id', 'id', 'id');
    }
}
