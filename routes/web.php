<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\ChildProfileController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Parent features
    Route::resource('children', ChildProfileController::class);

    // Stories
    Route::get('/stories', [StoryController::class, 'index'])->name('stories.index');
    Route::get('/stories/{story:slug}', [StoryController::class, 'show'])->name('stories.show');
    Route::get('/stories/{story:slug}/read', [StoryController::class, 'read'])->name('stories.read');
    Route::post('/stories/{story:slug}/progress', [StoryController::class, 'saveProgress'])->name('stories.progress');

    // Admin features
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('dashboard');
        
        // Admin story management
        Route::get('/stories/create', [AdminController::class, 'create'])->name('stories.create');
        Route::post('/stories', [AdminController::class, 'store'])->name('stories.store');
        Route::get('/stories/{story}/edit', [AdminController::class, 'edit'])->name('stories.edit');
        Route::put('/stories/{story}', [AdminController::class, 'update'])->name('stories.update');
        Route::delete('/stories/{story}', [AdminController::class, 'destroy'])->name('stories.destroy');
    });
});

require __DIR__.'/auth.php';
