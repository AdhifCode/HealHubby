<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Verification;
use App\Models\profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class ArticleController extends Controller
{

    public function updateTotalFavorites($articleId)
    {
        $totalFavorites = Favorite::where('article_id', $articleId)->count();

        Article::where('article_id', $articleId)->update(['total_favorites' => $totalFavorites]);
    }

    public function getAllArticles()
    {
        $Articles = Article::with(['user'])->get();

        $transformedArticles = $Articles->map(function ($Article) {
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

        return response()->json(['Articles' => $transformedArticles]);
    }

    public function getArticleById($articleName)
    {
        $Article = Article::with(['user'])
            ->where('article_title', $articleName)
            ->first();

        if (!$Article) {
            return response()->json(['error' => 'Article not found'], 404);
        }

        $transformedArticle = [
            'article_id' => $Article->article_id,
            'article_image' => $Article->article_image,
            'author' => $Article->user,
            'title' => $Article->article_title,
            'content' => $Article->article_content,
            'total_favorites' => $Article->total_favorites,
            'datetime' => Carbon::parse($Article->created_at)->format('M d, Y'),
        ];

        return response()->json(['Article' => $transformedArticle]);
    }    

    public function getTop3ArticlesByFavorites()
{
    $top3Articles = Article::with(['user'])
        ->leftJoin('favorites', 'articles.article_id', '=', 'favorites.article_id')
        ->select(
            'articles.article_id',
            'articles.article_image',
            'articles.article_title',
            'articles.article_content',
            'articles.user_id',
            DB::raw('COUNT(favorites.article_id) as favorites_count')
        )
        ->groupBy('articles.article_id', 'articles.article_image', 'articles.article_title','articles.article_content', 'articles.user_id')
        ->orderByDesc('favorites_count')
        ->take(3)
        ->get();

    $transformedArticles = $top3Articles->map(function ($Article) {
        return [
            'article_id' => $Article->article_id,
            'name' => $Article->user->name,
            'email' => $Article->user->email,
            'profession' => $Article->user->profession->name,
            'user_image' => $Article->user->image,
            'article_image' => $Article->article_image,
            'title' => $Article->article_title,
            'content' => $Article->article_content,
            'total_favorites' => $Article->favorites_count,
        ];
    });

    return response()->json(['top_Articles' => $transformedArticles]);
    }

    public function getUserArticles(Request $request)
    {
        $user_id = $request->input('user_id');

        if (!$user_id) {
            return response()->json(['error' => 'User ID not provided'], 400);
        }
    
        $articles = Article::where('user_id', $user_id)->get();
    
        $transformedArticles = $articles->map(function ($article) {
            return [
                'article_id' => $article->article_id,
                'user_image' => $article->user->image,
                'article_image' => $article->article_image,
                'author' => $article->user->name,
                'title' => $article->article_title,
                'profession' => $article->user->profession,
                'content' => $article->article_content,
                'total_favorites' => $article->total_favorites,
                'datetime' => Carbon::parse($article->created_at)->format('M d, Y'),
            ];
        });
    
        return response()->json(['articles' => $transformedArticles]);
    }

    public function requestArticleVerification(Request $request)
{
    $request->validate([
        'article_title' => 'required|string||unique:articles,article_title',
        'article_content' => 'required|string',
        'article_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'user_id' => 'required|exists:users,id',
    ]);

    $input = $request->all();

    if ($request->hasFile('article_image')) {
        $imagePath = $request->file('article_image')->store('article_images', 'public');
        $input['article_image'] = $imagePath;
    }

    $verification = Verification::create($input);

    return response()->json(['message' => 'Article verification requested successfully', 'verification' => $verification], 201);
}

public function getAllVerifications()
{
    $verifications = Verification::with('user.profession')->get();

    return response()->json(['verifications' => $verifications]);
}


public function approveArticle($verificationId)
{
    $verification = Verification::find($verificationId);

    if (!$verification) {
        return response()->json(['error' => 'Verification not found'], 404);
    }

    $articleData = [
        'article_title' => $verification->article_title,
        'article_content' => $verification->article_content,
        'article_image' => $verification->article_image,
        'user_id' => $verification->user_id,
        'total_favorites' => 0,
    ];

    $article = Article::create($articleData);

    $verification->delete();

    return response()->json(['message' => 'Article approved and created successfully', 'article' => $article], 200);
}

    public function rejectArticle($verificationId)
    {
        $verification = Verification::find($verificationId);

        if (!$verification) {
            return response()->json(['error' => 'Verification not found'], 404);
        }
        
        if ($verification->article_image) {
            Storage::delete('public/' . $verification->article_image);
        }

        $verification->delete();

        return response()->json(['message' => 'Article verification rejected successfully'], 200);
    }


    public function deleteArticle($articleId)
        {
            $article = Article::find($articleId);
            if (!$article) {
                return response()->json(['error' => 'Article not found'], 404);
            }
            
            if ($article->article_image) {
                Storage::delete('public/' . $article->article_image);
            }
            
            $article->delete();
            
            Favorite::where('article_id', $articleId)->delete();

            return response()->json(['message' => 'Article deleted successfully'], 200);
        }
}
