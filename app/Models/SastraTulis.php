<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SastraTulis extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'body',
        'image',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'sastra_tulis_id')->latest();
    }

}
