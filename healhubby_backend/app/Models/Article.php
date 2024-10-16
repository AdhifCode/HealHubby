<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $primaryKey = 'article_id';
    protected $table ='articles';
    protected $fillable = [
        'article_id',
        'article_title',
        'article_content',
        'article_image',
        'user_id',
        'total_favorites'
    ];
    
    
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updateTotalFavorites()
    {
        $totalFavorites = Favorite::where('article_id', $this->article_id)->count();
        $this->total_favorites = $totalFavorites;
        $this->save();
    }
}
