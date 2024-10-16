<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\Auth\SocialiteController;
use App\Http\Controllers\api\Auth\RegisterController;
use App\Http\Controllers\api\Auth\LoginController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ArticleCOntroller;
use App\Http\Controllers\api\DoctorController;
use App\Http\Controllers\api\AdminController;
use App\Http\Controllers\api\FavoriteController;
use App\Http\Controllers\api\MainPageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
    // Login And Register
        Route::post('/auth/register', [RegisterController::class, 'register']);
        Route::post('/auth/login', [LoginController::class, 'login']);
        Route::post('/auth/loginSocialite', [LoginController::class, 'loginSocialite']);

    // With Socialite
        Auth::routes();
        Route::get('/auth/{provider}', [SocialiteController::class, 'redirectToProvider']);
        Route::get('/auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);
        // Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');


    // Articles API
        Route::post('/requestarticle', [ArticleCOntroller::class, 'requestArticleVerification']);
        Route::get('/getrequest', [ArticleCOntroller::class, 'getAllVerifications']);
        Route::put('/pusharticle/{verificationId}', [ArticleCOntroller::class, 'approveArticle']);
        Route::delete('/rejectarticle/{verificationId}', [ArticleCOntroller::class, 'rejectArticle']);
        Route::delete('/deletemyarticle/{articleId}', [ArticleCOntroller::class, 'deleteArticle']);
        Route::get('/getarticles', [ArticleCOntroller::class, 'getAllarticles']);
        Route::get('/getarticlebyname/{article}', [ArticleCOntroller::class, 'getarticleById']);
        Route::post('/favorite/{article}', [FavoriteController::class, 'toggleFavorite']);
        Route::get('/favorite/{article}/status', [FavoriteController::class, 'getFavoriteStatus']);
        Route::get('/userarticle', [ArticleController::class, 'getUserArticles']);
        Route::get('/userfavorite', [FavoriteController::class, 'getUserFavorites']);
        Route::get('/top3', [ArticleCOntroller::class, 'getTop3articlesByFavorites']);

    // User & Admin
        Route::post('/postuser', [UserController::class, 'store']);
        Route::post('/updateuser/{id}', [UserController::class, 'update']);
        Route::get('/users/{id}/', [UserController::class, 'getUserById'])->name('users.get');
        Route::get('/getusers', [UserController::class, 'getAllUsers']);
        Route::delete('/deleteuser/{id}', [UserController::class, 'deleteUser']);
        Route::get('/getuserchart', [UserController::class, 'getChartData']);
        Route::get('/getrole', [UserController::class, 'getAllRoles']);
        Route::get('/getprofession', [UserController::class, 'getAllProfessions']);
        Route::get('/getstat', [AdminController::class, 'getStatistics']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
