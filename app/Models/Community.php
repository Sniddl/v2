<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
  use SoftDeletes;
  use HasFactory;
  protected $dates = ['deleted_at'];
  protected $fillable = ['name', 'description', 'url', 'avatar'];
  protected $table = 'communities';


  public function Posts() {
    return Post::where('community_id','=',$this->id);}

  public function Owner() {
    return User::find($this->id);}


}//end of class
