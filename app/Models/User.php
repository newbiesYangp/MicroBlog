<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Notifications\ResetPassword;
use Auth;
class User extends Authenticatable
{
    use Notifiable; //消息通知相关功能引用

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($user){
            $user->activation_token = str_random(30);
        });
    }

    //获取头像 "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "&s=" . $size;
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "https://www.gravatar.com/avatar/".$hash."?s=".$size;
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    //一个用户拥有多条微博--关联
    public function statuse()
    {
        return $this->hasMany(Status::Class);
    }

    //获取当前用户发布过的所有微博数据
    public function feed()
    {
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);
        // return $this->statuse()->orderBy('created_at','desc');
        return Status::whereIn('user_id',$user_ids)
                        ->with('user')
                        ->orderBy('created_at','desc');
    }


    //粉丝表与用户表 形成中间关联表

    //关联-获取粉丝列表
     public function followers()
    {
        return $this->belongsToMany(User::Class,'followers','user_id','follower_id');
    }

    //关联-获取关注人列表
    public function followings()
    {
        return $this->belongsToMany(User::Class,'followers','follower_id','user_id');
    }

    //关注
    public function follow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);
    }
    //取消关注
       //关注
    public function unfollow($user_ids)
    {
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    //判断某用户是否在登录用户的关注人列表上
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id); //登录用户关注人列表中是否用$user_id
    }
}
