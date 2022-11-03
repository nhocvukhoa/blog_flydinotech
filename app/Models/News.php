<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes, Sluggable;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'content',
        'status',
        'image',
        'viewed',
        'slug',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $table = 'news';

    public function getViewedAttribute()
    {
        return number_format($this->attributes['viewed'], 0, ',', '.');
    }

    public function getDateFormatAttribute($date)
    {
        return date('d-m-Y', strtotime($this->attributes[$date]));
    }

    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
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
