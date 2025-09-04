<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SastraTulis extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'penulis',
        'category',
        'body',
        'image',
        'views',
        'status',
        'user_id',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'sastra_tulis_id')->latest();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
