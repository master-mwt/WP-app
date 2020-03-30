<?php

namespace App\Http\Controllers;

use Auth;
use \App\Post;
use \App\Channel;
use \App\Comment;
use \App\Reply;
use \App\UserPostSaved;
use \App\UserPostHidden;
use \App\UserPostReported;
use \App\UserChannelRole;
use \App\Role;
use Illuminate\Http\Request;

class PageHomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::User();

        return view('dashboard.home', compact(
            'user'
        ));
    }

    public function settings()
    {
        return view('dashboard.settings');
    }
    
    public function postOwned()
    {
        $user = Auth::User();
        $myposts = Post::where('user_id', $user->id)->paginate(10);

        foreach($myposts as $post) {
            $post->channel_id = Channel::findOrFail($post->channel_id);
            $post->user_id = $user;
        }

        return view('dashboard.post.list', compact(
            'myposts'
        ));
    }

    public function postSaved()
    {
        $user = Auth::User();
        $myposts = UserPostSaved::where('user_id', $user->id)->paginate(10);

        foreach($myposts as $post) {
            $post->post_id = Post::findOrFail($post->post_id);
            $post->user_id = $user;
            //destructuring
            $post->channel_id = Channel::findOrFail($post->post_id->channel_id);
            $post->title = $post->post_id->title;
            $post->upvote = $post->post_id->upvote;
            $post->downvote = $post->post_id->downvote;
        }

        return view('dashboard.post.list', compact(
            'myposts'
        ));
    }

    public function postHidden()
    {
        $user = Auth::User();
        $myposts = UserPostHidden::where('user_id', $user->id)->paginate(10);

        foreach($myposts as $post) {
            $post->post_id = Post::findOrFail($post->post_id);
            $post->user_id = $user;
            //destructuring
            $post->channel_id = Channel::findOrFail($post->post_id->channel_id);
            $post->title = $post->post_id->title;
            $post->upvote = $post->post_id->upvote;
            $post->downvote = $post->post_id->downvote;
        }

        return view('dashboard.post.list', compact(
            'myposts'
        ));
    }

    public function postReported()
    {
        $user = Auth::User();
        $myposts = UserPostReported::where('user_id', $user->id)->paginate(10);

        foreach($myposts as $post) {
            $post->post_id = Post::findOrFail($post->post_id);
            $post->user_id = $user;
            //destructuring
            $post->channel_id = Channel::findOrFail($post->post_id->channel_id);
            $post->title = $post->post_id->title;
            $post->upvote = $post->post_id->upvote;
            $post->downvote = $post->post_id->downvote;
        }

        return view('dashboard.post.list', compact(
            'myposts'
        ));
    }

    public function replyOwned()
    {
        return view('dashboard.reply.list');
    }

    public function commentOwned()
    {
        return view('dashboard.comment.list');
    }

    public function channelOwned()
    {
        $user = Auth::User();
        $mychannels = UserChannelRole::where(['user_id' => $user->id, 'role_id' => 1])->paginate(10);

        foreach($mychannels as $channel) {
            $channel->channel_id = Channel::findOrFail($channel->channel_id);
            $channel->user_id = $user;
            $channel->role_id = Role::findOrFail($channel->role_id);
            //destructuring
            $channel->id = $channel->channel_id;
            $channel->name = $channel->channel_id->name;
        }

        return view('dashboard.channel.list', compact(
            'mychannels'
        ));
    }

    public function channelJoined()
    {
        $user = Auth::User();
        $mychannels = UserChannelRole::where('user_id', $user->id)->whereIn('role_id', [2,3,4])->paginate(10);

        foreach($mychannels as $channel) {
            $channel->channel_id = Channel::findOrFail($channel->channel_id);
            $channel->user_id = $user;
            $channel->role_id = Role::findOrFail($channel->role_id);
            //destructuring
            $channel->id = $channel->channel_id;
            $channel->name = $channel->channel_id->name;
        }

        return view('dashboard.channel.list', compact(
            'mychannels'
        ));
    }
}
