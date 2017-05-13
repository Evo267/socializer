<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;
use DB;

use Auth;
use App\User;
use App\Post;
use App\Image;
use App\Comment;

class User extends Authenticatable
{
    use Notifiable;

    protected $userImagePath = 'img/users/';

    protected $userCoverPath = 'img/users/cover/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'dob', 'email', 'password', 'cover', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'pivot'
    ];

    public function getAvatarImagePath(){
        return asset($this->userImagePath . $this->avatar);
    }

    public function getCoverImagePath(){
        return asset($this->userCoverPath . $this->cover);
    }

    public function getCoverPath(){
        return $this->userCoverPath;
    }

    public function getAvatarPath(){
        return $this->userImagePath;
    }

    public function getFullName(){
        return $this->first_name . ' ' . $this->last_name;
    }

    public function likedPost($id){
        if ($this->likes()->whereLikeableId($id)->whereLikeableType('App\Post')->whereUserId(Auth::id())->first()){
            return true;
        } else {
            return false;
        }
    }

    public function savedPost($id){
        if ($this->saves()->wherePostId($id)->whereUserId(Auth::user()->id)->first()){
            return true;
        } else {
            return false;
        }
    }

    public function getTimeline(){

        return $posts = Post::where(function($query){
            return $query->where('user_id', Auth::user()->id)->orWhereIn('user_id', Auth::user()->friends()->pluck('id'));
        })->orderBy('created_at', 'desc')->get();
    }

    public function getImages(){
        return Image::where('imageable_type', 'App\Post')->whereIn('imageable_id', [11])->get();
    }

    public function imagesFromPosts(){
        return $this->posts()->whereHas('images', function($query){
            $query->where('imageable_type', 'App\Post');
        })->get();
    }

    public function updateOnlineStatus(){
        $now = Carbon::now();
        if ($this->online()->count()){
            // update
            $this->online()->update([
                'last' => $now
            ]);
        } else {
            // create
            $this->online()->create([
                'last' => $now
            ]);
        }
    }

    public function isOnline(){
        $now = Carbon::now()->subMinutes(2);
        if ($online = $this->online()->whereUserId($this->id)->first()){
            if ($online->last > $now){
                // online
                return true;
            } else {
                // offline
                return false;
            }
        }
    }

    public function PendingMessages($friend){
        return Message::where('read', 0)->where('user_id', $friend->id)->where('receiver', $this->id)->count();
    }

    public function friendsLastActivity(){
        $friendList = $this->friends()->pluck('id');

        // posts, comments, Likes,

        $posts = Post::whereIn('user_id', $friendList)->orderBy('created_at', 'desc')->take(3)->get();
        $comments = Comment::whereIn('user_id', $friendList)->orderBy('created_at', 'desc')->take(3)->get();
        $likes = Like::whereIn('user_id', $friendList)->orderBy('created_at', 'desc')->take(3)->get();

        $activity = "";

        foreach ($posts as $post){
            $activity .= '<a href="'. route('profile.view', ['id' => $post->user->id]) .'">'.$post->user->getFullName() . '</a> has made a new post ' . $post->created_at->diffForHumans() . '.<br>';
        }

        foreach ($comments as $comment){
            $activity .= '<a href="'. route('profile.view', ['id' => $comment->user_id]) .'">'.$comment->user->getFullName() . "</a> has commented " . $comment->created_at->diffForHumans() . " on ". '<a href="'. route('profile.view', ['id' => $comment->post->user_id]) .'">'.$comment->post->user->getFullName() ."</a>'s post.<br>";
        }

        foreach ($likes as $like){
            $activity .= '<a href="'. route('profile.view', ['id' => $like->user_id]) .'">'.$like->user->getFullName() . '</a> has liked <a href="'. route('profile.view', ['id' => $like->likeable->user_id]).'">'. $like->likeable->user->getFullName() ."'s</a> post.<br>";
        }


        return $activity;
    }

    /* Relations */

    public function notifications(){
        return $this->hasMany('App\Notification');
    }

    public function online(){
        return $this->hasOne('App\Online');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function messagesInverse(){
        return $this->hasMany('App\Message', 'receiver');
    }

    public function conversation($friend){
        $this->messagesInverse()->where('user_id', $friend->id)->update([
            'read' => true
        ]);
        $collect1 = $this->messages()->where('receiver', $friend->id)->get();
        $collect2 = $this->messagesInverse()->where('user_id', $friend->id)->get();
        $conversation = $collect1->merge($collect2)->sortBy('id');;
        return $conversation;
    }

    public function events(){
        return $this->hasMany('App\Event');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function likes(){
        return $this->hasMany('App\Like');
    }

    public function saves(){
        return $this->hasMany('App\Save');
    }

    public function friendsOfMine(){
        return $this->belongsToMany('App\User', 'friends', 'user_id', 'friend_id');
    }

    public function friendOf(){
        return $this->belongsToMany('App\User', 'friends', 'friend_id', 'user_id');
    }

    public function friends(){
        return $this->friendsOfMine()->wherePivot('accepted', true)->get()
        ->merge($this->friendOf()->wherePivot('accepted', true)->get());
    }

    public function friendRequests(){
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }

    public function friendRequestsPending(){
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user){
        return (bool) $this->friendRequestsPending()->where('id', $user->id)->count();
    }

    public function hasFriendRequestPendingFrom(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function HasAnyFriendRequestsPending(){
        return $this->friendsOfMine()->wherePivot('user_id', Auth::user()->id)->where('accepted', 0)->get();
    }

    public function addFriend(User $user){
        return $this->friendOf()->attach($user->id);
    }

    public function removeFriend(User $user){
        return $this->friendOf()->detach($user->id);
    }

    public function acceptFriend(User $user){
        return (bool) $this->friendRequests()->where('id', $user->id)->first()->pivot->update([
                'accepted' => true
            ]);
    }

    public function isFriendsWith(User $user){
        return (bool) $this->friends()->where('id', $user->id)->count();
    }


}
