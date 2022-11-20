<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use App\Models\Repost;
use App\Models\Friend;
use App\Models\Timeline;
use App\Models\Reply;
use DB;
use App\Events\CreatedPost;
use App\Events\NotificationUpdate;
use App\Models\Community;
use App\Notifications\TimelineEvent;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{

    public function create(Request $request, $method=null){
        $this->validate($request, [
          'text' => 'required|string',]);
        $op = Post::withTrashed()->find($request->id); //find the original post.
        $user = Auth::user();
        $post = new Post();
        $post->text = $request->text;
        $post->user_id = $user->id;
        $post->community_id = null;
        if ($method == "reply"){
            $post->isReply = 1;}
        $post->save();
        $post_id = $post->id;

        $timeline = new Timeline();
        $timeline->post_id = $post_id;
        $timeline->added_by = $user->id;
        $timeline->is_repost = 0;
        if ($method == "reply"){
            if ($op->trashed()) {
              flash('Sorry, the post you were trying to reply to has been deleted.', 'danger');
              return back();
            }
            $timeline->is_reply = 1;
            $r = new Reply();
            $r->replyto_id = $op->id;//get the id global.js @reply click function.
            $r->post_id = $post_id; //the id of this post.
            $r->user_id = $user->id; //id of this user.
            $r->save();
            $timeline->save();

            if ($op->user->id != Auth::user()->id) {
              $op->user->notify(new TimelineEvent(Timeline::find($timeline->id)));
              event( new NotificationUpdate($op->user) );
              event( new CreatedPost("reply") );
            }}

        if ($method == null){
          $timeline->save();
          event( new CreatedPost("post") );
          return back();}}



    public function get(){
        $communities = Community::limit(10)->get();
        $timeline = Timeline::with(['user', 'post.op', 'authLike'])
            ->orderBy('id', 'DESC')
            ->where('is_reply', false)
            ->get();
        return Inertia::render('Timeline/Index', compact('timeline', 'communities'));
        return view('showAllPosts', compact('timeline'));
    }



    public function like(Timeline $timeline) {

        $liked = $timeline->authLike()->exists();

        if (!$liked) {
            $timeline->likes()->firstOrCreate([
                'user_id' => Auth::id(),
            ]);
        } else {
            $timeline->authLike->delete();
        }

        return response()->json([
            'liked' => !$liked,
        ]);
    }




    public function repost(Request $request){
        $post = Post::find($request->id);
        $already_reposted = $post->reposts()->where('reposter_id', '=', Auth::user()->id)->exists();
        if (!$already_reposted && $post->user != Auth::user()->username) {
            $repost = new Repost;
            $repost->op_id = $post->user_id;
            $repost->post_id = $post->id;
            $repost->reposter_id = Auth::user()->id;
            $repost->save();
            $timeline = new Timeline();
            $timeline->post_id = $post->id;
            $timeline->added_by = Auth::user()->id;
            $timeline->is_repost = 1;
            $timeline->save();
        } else {
            Repost::where('reposter_id', '=', Auth::user()->id)
                    ->where('post_id', '=', $post->id)
                    ->delete();
            Timeline::where('post_id', '=', $post->id)
                      ->where('is_repost', '=', 1)
                      ->where('added_by', '=', Auth::user()->id)
                      ->delete();}
        return response()->json([
        'repostAmount' => $post->reposts->count()]);}




    public function sort(){
        $friends = Friend::where('follower_id', '=', Auth::user()->id)->get();
        $array = [];
        foreach ($friends as $friend) {
            $friendID = $friend->user_being_followed()->id;
            array_push($array, $friendID);
        }
        $timeline = Timeline::orderBy('id', 'DESC')->whereIn('added_by', $array)->where('is_reply', '=', '0')->get();
        return view('showAllPosts', compact('timeline'));
      }







    public function url($timeline_id) {
      $getPostByUrl = Timeline::withTrashed()->find($timeline_id);
      if($getPostByUrl->trashed()){
        flash('The post you were trying to access has been deleted.', 'danger');
        return back();
      }
      return view('layouts.post-rendered')->with('timeline', $getPostByUrl);}



}//end of class








//
