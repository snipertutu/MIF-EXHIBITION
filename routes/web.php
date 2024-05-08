<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\MahasiswaDashboardController;
use App\Http\Controllers\ProjectMahasiswaController;
use App\Http\Controllers\ProjectAdminController;
use App\Http\Controllers\ProjectDetailController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AdminCarouselController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UploadDataController;
//use App\Http\Controllers\PortfolioController;
use Illuminate\Http\Request;
use App\Models\User;
//use App\Models\Project;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/landingpage', [IndexController::class, 'index'])->name('landingpage');
//Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');

Route::get('/project-details/{id}', [ProjectDetailController::class, 'show'])->name('project.details');



Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forgot-password.email');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::middleware(['auth.user'])->group(function () {
    Route::get('/adm', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/mhs', [ProfileController::class, 'show'])->name('dashboard-mhs');
});
Route::get('/adm', [AdminDashboardController::class, 'home'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
});

Route::get('tables/project-mhs', [ProjectMahasiswaController::class, 'index'])->name('project-mhs');
Route::post('/projects', [ProjectMahasiswaController::class, 'store'])->name('projects.store');
Route::get('/searchs', [ProjectMahasiswaController::class, 'search'])->name('projects.search');
Route::get('/get-members/{projectId}', [ProjectMahasiswaController::class, 'getMembers'])->name('projects.getMembers');
Route::post('/upload-gambar', [ProjectMahasiswaController::class, 'uploadGambar'])->name('upload.gambar');
Route::post('/upload/video', [ProjectMahasiswaController::class, 'uploadVideo'])->name('upload.video');
Route::get('/projects/{id}/edit', [ProjectMahasiswaController::class, 'edit'])->name('projects.edit');
Route::put('/projects/{id}', [ProjectMahasiswaController::class, 'update'])->name('projects.update');

Route::get('tables/project', [ProjectAdminController::class, 'index'])->name('project.index');
Route::get('tables/project/{id}', [ProjectAdminController::class, 'hidden'])->name('project.hidden');
Route::get('/search', [ProjectAdminController::class, 'searchMahasiswa'])->name('project.search');
Route::get('/get-member/{projectId}', [ProjectAdminController::class, 'getMembersProject'])->name('project.getMembers');
Route::get('/project/{id}/edit', [ProjectAdminController::class, 'editProject'])->name('project.edit');
Route::put('/project/{id}', [ProjectAdminController::class, 'updateAnggotaProject'])->name('project.update');
Route::delete('/projects/{id}', [ProjectAdminController::class, 'delete'])->name('projects.delete');


Route::get('tables/mahasiswa', [UserController::class, 'index'])->name('mahasiswa.index');
Route::post('tables/mahasiswa/store', [UserController::class, 'store'])->name('mahasiswa.store');
Route::post('tables/mahasiswa/delete', [UserController::class, 'destroy'])->name('mahasiswa.destroy');
Route::get('/mahasiswa/{id}/edit', [UserController::class, 'edit'])->name('mahasiswa.edit');
Route::put('/mahasiswa/{id}/update', [UserController::class, 'update'])->name('mahasiswa.update');



Route::get('/homepage', [AdminCarouselController::class, 'index'])->name('homepage.index');
Route::post('/homepage', [AdminCarouselController::class, 'store'])->name('homepage.store');
Route::delete('/homepage/{id}', [AdminCarouselController::class, 'destroy'])->name('homepage.destroy');
Route::post('/upload-excel', [UploadDataController::class, 'upload'])->name('upload.excel');


Route::get('/project-details', function () {
    return view('project-details');
})->name('project-details');

Route::group(['prefix' => 'tables'], function(){
    Route::get('Project-mhs', function () { return view('pages.tables.Project-mhs'); });
    Route::get('data-table', function () { return view('pages.tables.data-table'); });
    Route::get('js-grid', function () { return view('pages.tables.js-grid'); });
    Route::get('sortable-table', function () { return view('pages.tables.sortable-table'); });
});

Route::group(['prefix' => 'user-pages'], function(){
    Route::get('profile', function () { return view('pages.user-pages.profile'); });
    Route::get('profile-mhs', function () { return view('pages.user-pages.profile-mhs'); });
});


Route::group(['prefix' => 'error-pages'], function(){
    Route::get('error-404', function () { return view('pages.error-pages.error-404'); });
    Route::get('error-500', function () { return view('pages.error-pages.error-500'); });
});

// For Clear cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error-pages.error-404');
})->where('page','.*');