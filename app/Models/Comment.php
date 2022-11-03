<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory,
        SoftDeletes;

    protected $fillable = [
        'user_id', 
        'post_id', 
        'content', 
        'status', 
        'deleted_at',
        'parent_id'
    ];

    protected $table = 'comments';

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post() 
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id')->orderBy('id', 'DESC');
    }

    public function getDateFormatAttribute($date)
    {
        return date('d/m/Y - H:m A', strtotime($this->attributes[$date]));
    }
}
