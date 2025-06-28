<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GitHubController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TemplateController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search.page');
Route::get('/template/{id}', [TemplateController::class, 'show'])->name('template.show');


// Show login form
Route::get('/login', [LoginController::class, 'login'])->name('login');

// Handle login form submission (POST)
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');

Route::get('/register', [LoginController::class, 'showRegister'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/github/redirect', [GitHubController::class, 'redirect']);
Route::get('/github/callback', [GitHubController::class, 'callback']);
Route::get('/template/{id}/push-to-github', [GitHubController::class, 'pushFromTemplate'])->middleware('auth');
