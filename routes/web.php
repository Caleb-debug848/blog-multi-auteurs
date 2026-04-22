<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AdminController;

// Page d'accueil
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// Routes authentifiées
Route::middleware(['auth'])->group(function () {

    // ✅ Auteurs et admins — create AVANT show
    Route::middleware(['isAuthor'])->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
        Route::get('/my-posts', [PostController::class, 'myPosts'])->name('posts.my-posts');
    });

    // Likes et commentaires
    Route::post('/posts/{post}/like', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    // ✅ Profil
    Route::get('/profile/show', function() {
        return view('profile.show');
    })->name('profile.show');

});

// ✅ Posts publics — show APRÈS create
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Routes admin uniquement
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/articles', [AdminController::class, 'articles'])->name('admin.articles');
    Route::get('/comments', [AdminController::class, 'comments'])->name('admin.comments');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/posts/{post}/approve', [AdminController::class, 'approvePost'])->name('admin.approvePost');
    Route::post('/posts/{post}/reject', [AdminController::class, 'rejectPost'])->name('admin.rejectPost');
    Route::post('/comments/{comment}/approve', [AdminController::class, 'approveComment'])->name('admin.approveComment');
    Route::post('/users/{user}/role/{role}', [AdminController::class, 'updateUserRole'])->name('admin.updateUserRole');
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
});

require __DIR__.'/auth.php';