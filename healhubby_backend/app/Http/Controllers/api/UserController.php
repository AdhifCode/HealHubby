<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;
use App\Models\Role;
use App\Models\Profession;
use App\Models\Favorite;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{   

    public function getUserById($id)
{
    try {
        $user = User::with(['role','profession'])->findOrFail($id);
    
        return response()->json([
            'data' => $user,
            'message' => 'Berhasil ambil data user dengan ID ' . $id,
            'success' => true,
            'status' => 200,
        ], 200);
    } catch (\Throwable $e) {
        return response()->json([
            'data' => null,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            'success' => false,
            'status' => 500,
        ], 500);
    }
    
}

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
                'role_id' => 'nullable|exists:roles,role_id',
                'profession_id' => 'nullable|exists:profession,profession_id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $input = $request->all();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('user_images', 'public');
                $input['image'] = $imagePath;
            }
            $user = User::create($input);
    
            return response()->json([
                'data' => $user,
                'message' => 'Berhasil menambahkan data user',
                'success' => true,
                'status' => 201,
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }

    public function update(Request $request, $id)
{
    try {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'string',
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'string|min:6',
            'role_id' => 'nullable|exists:roles,role_id',
            'profession_id' => 'nullable|exists:professions,profession_id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $imagePath = $request->file('image')->store('user_images', 'public');
            $input['image'] = $imagePath;
            
        } elseif ($request->hasFile('image') && $user->image === null) {
            $uploadImage = $request->file('image')->store('user_images', 'public');
            $input['image'] = $uploadImage;
        }                

        $user->update($input);

        return response()->json([
            'data' => $user,
            'message' => 'Berhasil update data user',
            'success' => true,
            'status' => 200,
        ], 200);
    } catch (\Throwable $e) {
        return response()->json([
            'data' => null,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            'success' => false,
            'status' => 500,
        ], 500);
    }
}

public function deleteUser($id)
{
    try {
        $user = User::findOrFail($id);

        // Hapus semua artikel yang terkait dengan pengguna
        Article::where('user_id', $user->id)->delete();

        // Hapus semua data favorit yang terkait dengan pengguna
        Favorite::where('user_id', $user->id)->delete();

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully',
            'success' => true,
            'status' => 200,
        ], 200);
    } catch (\Throwable $e) {
        return response()->json([
            'message' => 'Error deleting user: ' . $e->getMessage(),
            'success' => false,
            'status' => 500,
        ], 500);
    }
}




    public function getAllUsers()
    {
        try {
            $users = User::with('role','profession')->get();

            return response()->json([
                'data' => $users,
                'message' => 'Berhasil ambil semua data user',
                'success' => true,
                'status' => 200,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }
    
    public function getChartData()
    {
        try {
            $users = User::select('created_at')->get();
    
            $chartData = $users->groupBy(function ($user) {
                return $user->created_at->format('Y-m-d');
            })->map(function ($groupedData, $date) {
                $totalCount = $groupedData->count();
                $formattedDate = "Date.UTC(" . $groupedData[0]->created_at->year . ", " . ($groupedData[0]->created_at->month - 1) . ", " . $groupedData[0]->created_at->day . ")";
                return [$formattedDate, $totalCount];
            });
    
            return response()->json([
                'data' => $chartData->values(),
                'message' => 'Berhasil ambil data chart',
                'success' => true,
                'status' => 200,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }

   public function getAllRoles()
    {
        try {
            $roles = Role::all();

            return response()->json([
                'data' => $roles,
                'message' => 'Berhasil ambil semua data role',
                'success' => true,
                'status' => 200,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }

    public function getAllProfessions()
    {
        try {
            $professions = Profession::all();

            return response()->json([
                'data' => $professions,
                'message' => 'Berhasil ambil semua data profession',
                'success' => true,
                'status' => 200,
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => null,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'success' => false,
                'status' => 500,
            ], 500);
        }
    }
}
