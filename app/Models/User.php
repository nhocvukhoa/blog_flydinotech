<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value) 
    {
        $this->attributes['password'] = Hash::make($value);
    }
    
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function news() 
    {
        return $this->hasMany(News::class, 'user_id', 'id');
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }

    public function getDateFormatAttribute($date)
    {
        return date('d-m-Y', strtotime($this->attributes[$date]));
    }
    
    public function getViewedUserAttribute($user)
    {
        return Post::where([
                ['user_id', $user],
                ['status', PostStatus::ACTIVE]
            ])
            ->sum('viewed');
    }

    public function getViewed($viewed)
    {
        $viewed = number_format($viewed);
        $viewedCount = substr_count($viewed, ',');

        if ($viewedCount != 0) {
            if ($viewedCount == 1) {
                return substr($viewed, 0, -4) . 'K';
            } elseif ($viewedCount == 2) {
                return substr($viewed, 0, -8) . 'M';
            } else {
                return substr($viewed, 0, -12) . 'B';
            }
        } else {
            return $viewed;
        }
    }

    public function socialAccount()
    {
        return $this->hasMany(SocialAccount::class, 'user_id');
    }
}
