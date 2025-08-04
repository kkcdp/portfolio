<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PortfolioItemController;
use App\Http\Controllers\Admin\PortfolioSectionSetting;
use App\Http\Controllers\Admin\PortfolioSectionSettingController;
use App\Http\Controllers\Admin\TyperTitleController;
use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/blog', function () {
    return view('frontend.blog');
});

Route::get('/blog-details', function () {
    return view('frontend.blog-details');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])
->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('portfolio-details/{id}', [HomeController::class, 'showPortfolio'])->name('show.portfolio');

/**  Admin Routes */

Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::resource('hero', HeroController::class);
    Route::resource('typer-title', TyperTitleController::class);

    /** Service route */
    Route::resource('service', ServiceController::class);

    /** About route */
    Route::get('resume/download', [AboutController::class, 'resumeDownload'])->name('resume.download');
    Route::resource('about', AboutController::class);

    /** Portfolio Category route */
    Route::resource('category', CategoryController::class);

    /** Portfolio Item route */
    Route::resource('portfolio-item', PortfolioItemController::class);

    /** Portfolio Section Setting  route */
    Route::resource('portfolio-section-setting', PortfolioSectionSettingController::class);
});

