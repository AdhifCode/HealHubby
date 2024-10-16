<?php

namespace App\Http\Controllers\api;

use App\Models\Favorite;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FavoriteController extends Controller
{
    public function toggleFavorite(Request $request, $articleid)
    {
        $userId = $request->input('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User ID not provided'], 400);
        }

        $favorite = Favorite::where('user_id', $userId)->where('Article_id', $articleid)->first();

        if ($favorite) {
            $favorite->delete();
            $message = 'Article removed from favorites';
        } else {
            Favorite::create([
                'user_id' => $userId,
                'article_id' => $articleid,
            ]);
            $message = 'Article added to favorites';
        }

        $Article = Article::find($articleid);
        $Article->updateTotalFavorites();

        $isFavorite = Favorite::where('user_id', $userId)->where('Article_id', $articleid)->exists();

        return response()->json(['message' => $message, 'is_favorite' => $isFavorite]);
    }

    public function getFavoriteStatus(Request $request, $articleid)
    {
        $userId = $request->input('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User ID not provided'], 400);
        }

        $isFavorite = Favorite::where('user_id', $userId)->where('Article_id', $articleid)->exists();

        // \Log::info("User ID: $userId, Article ID: $articleid, Is Favorite: " . ($isFavorite ? 'true' : 'false'));

        return response()->json(['is_favorite' => $isFavorite]);
    }

    public function getUserFavorites(Request $request)
    {
        $userId = $request->input('user_id');

        if (!$userId) {
            return response()->json(['error' => 'User ID not provided'], 400);
        }

        $userFavorites = Favorite::where('user_id', $userId)->with('user')->get();

        $transformedFavorites = $userFavorites->map(function ($favorite) {
            $Article = $favorite->Article;
// dd($Article);
            
            return [
                'article_id' => $Article->article_id,
                'user_image' => $Article->user->image,
                'article_image' => $Article->article_image,
                'author' => $Article->user->name,
                'title' => $Article->article_title,
                'profession' => $Article->user->profession,
                'content' => $Article->article_content,
                'total_favorites' => $Article->total_favorites,
                'datetime' => Carbon::parse($Article->created_at)->format('M d, Y'),
            ];
        });
        // dd($transformedFavorites);

        return response()->json(['favorites' => $transformedFavorites]);
    }
}
