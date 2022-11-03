<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'content',
        'status',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $table = 'contacts';

    public function getDateFormatAttribute($date)
    {
        return date('d-m-Y', strtotime($this->attributes[$date]));
    }
}
