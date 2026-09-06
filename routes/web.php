<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Product;
use App\Models\Program;
use App\Models\Recipe;
use App\Models\Video;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::view('/programs', 'programs.index')->name('programs');
Route::get('/programs/{program:slug}', function (Program $program) {
    abort_unless($program->published_at !== null && $program->published_at <= now(), 404);

    return view('programs.show', compact('program'));
})->name('programs.show');

Route::post('/programs/{program:slug}/complete', function (Program $program) {
    $done = session()->get('completed_programs', []);
    if (in_array($program->slug, $done, true)) {
        $done = array_values(array_diff($done, [$program->slug]));
    } else {
        $done[] = $program->slug;
    }
    session()->put('completed_programs', $done);

    return redirect()->route('programs.show', $program);
})->name('programs.complete');

Route::view('/videos', 'videos.index')->name('videos');
Route::get('/videos/{video:slug}', function (Video $video) {
    abort_unless($video->published_at !== null && $video->published_at <= now(), 404);

    return view('videos.show', ['video' => $video]);
})->name('videos.show');

Route::view('/recipes', 'recipes.index')->name('recipes');
Route::get('/recipes/{recipe:slug}', function (Recipe $recipe) {
    abort_unless($recipe->published_at !== null && $recipe->published_at <= now(), 404);

    return view('recipes.show', compact('recipe'));
})->name('recipes.show');

Route::view('/store', 'store.index')->name('store');
Route::get('/store/{product:slug}', function (Product $product) {
    abort_unless($product->published_at !== null && $product->published_at <= now(), 404);

    return view('store.show', compact('product'));
})->name('store.show');

Route::view('/community', 'community')->name('community');
Route::redirect('/c/fitness-discussions', '/community');
Route::redirect('/journey', '/login');
Route::view('/about', 'about')->name('about');

Route::middleware('guest')->group(function () {
    Route::get('/signup', [RegisteredUserController::class, 'create'])->name('signup');
    Route::post('/signup', [RegisteredUserController::class, 'store'])->name('signup.store');
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
