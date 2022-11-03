<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enums\PostStatus;
use Illuminate\Support\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'content',
        'viewed',
        'status',
        'image',
        'deleted_at',
        'published_at',
        'created_at',
        'updated_at',
    ];

    public function comment()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->orderByDesc('id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getDateFormatAttribute($date)
    {
        return date('d-m-yy', strtotime($this->attributes[$date]));
    }

    public function getPublicationDateFormatAttribute($date)
    {
        return date('d/m/Y - H:m A', strtotime($this->attributes[$date]));
    }

    public function getCreateDateFormatAttribute($date)
    {
        return date('Y-m-d', strtotime($this->attributes[$date]));
    }

    public function getTimeAttribute($time)
    {
        Carbon::setLocale('vi');
        $time = Carbon::parse($time); 

        return $time->diffForHumans(Carbon::now());
    }

    public function scopeActivePost($query)
    {
        return $query->where('status', '=', PostStatus::ACTIVE);
    }

    public function scopePostByMonth($query)
    {
        $month = Carbon::now()->format('Y-m');

        return $query->where('published_at', 'like', '%' . $month . '%');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
