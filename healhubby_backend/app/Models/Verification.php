<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_title',
        'article_content',
        'article_image',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
