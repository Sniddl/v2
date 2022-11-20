<?php

namespace App\Models;

use App\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Timeline extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $dates = ['deleted_at'];
    protected $table = 'timeline';

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user() {
      return $this->belongsTo(User::class, 'added_by');
    }

    public function likes() {
        return $this->hasMany(Like::class, 'post_id');
    }

    public function authLike() {
        return $this->hasOne(Like::class, 'post_id')
            ->where('user_id', Auth::id());
    }
}
