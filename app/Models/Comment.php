<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'sastra_tulis_id',
        'user_id',
        'body',
    ];

    public function post()
    {
        return $this->belongsTo(SastraTulis::class, 'sastra_tulis_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

