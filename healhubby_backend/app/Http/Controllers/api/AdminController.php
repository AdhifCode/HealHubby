<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function getStatistics()
{
    try {
        $totalArticles = Article::count();
        $totalUsers = User::count();

        $usersWithArticles = DB::table('articles')
            ->select('user_id')
            ->distinct()
            ->count();

        return response()->json([
            'message' => 'Statistics retrieved successfully',
            'total_articles' => $totalArticles,
            'total_users' => $totalUsers,
            'users_with_articles' => $usersWithArticles
        ]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to retrieve statistics', 'error' => $e->getMessage()], 500);
    }
}
    public function submitForApproval(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'profession_id' => 'required|exists:professions,profession_id',
            'article_title' => 'required',
            'article_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $articleImage = $request->file('article_image')->store('article_images', 'public');
    
        $approvalPermit = ApprovalPermit::create([
            'user_id' => $request->input('user_id'),
            'profession_id' => $request->input('profession_id'),
            'article_title' => $request->input('article_title'),
            'article_image' => $articleImage,
        ]);
    
        return response()->json([
            'message' => 'Permohonan persetujuan berhasil dikirim',
        ], 201);
    }

    public function getAllApprovalPermits()
{
    try {
        $permits = ApprovalPermit::with(['user', 'profession'])->get();

        $approvalPermits = $permits->map(function ($permit) {
            return [
                'id' => $permit->id,
                'user_id' => $permit->user->name,
                'profession_id' => $permit->profession->name,
                'article_title' => $permit->article_title,
                'article_image' => $permit->article_image,
                'created_at' => $permit->created_at,
            ];
        });

        return response()->json(['message' => 'Data approval permits retrieved successfully', 'approval_permits' => $approvalPermits]);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Failed to retrieve approval permits', 'error' => $e->getMessage()], 500);
    }
}


    public function deleteApproval($id)
    {
        try {
            $approval = ApprovalPermit::find($id);

            if (!$approval) {
                return response()->json(['message' => 'Approval not found'], 404);
            }

            $approval->delete();

            return response()->json(['message' => 'Approval deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete approval', 'error' => $e->getMessage()], 500);
        }
    }
}
