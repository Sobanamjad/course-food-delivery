<?php

use App\Http\Controllers\ProfileController;
use App\Models\Permission;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/test-permissions', function () {
//     $user = Auth::user();

//     if (!$user) {
//         return 'No user logged in!';
//     }

//     echo "<h2>User: {$user->name} ({$user->email})</h2><hr>";

//     foreach (Permission::pluck('name') as $permission) {
//         $has = $user->hasPermission($permission) ? '✅ Has' : '❌ Missing';
//         echo $permission . ' : ' . $has . '<br>';
//     }
// })->middleware('auth');

Route::get('/test-permissions', function () {
    dd(Permission::pluck('name')->toArray(), Auth::user()->permissions(), Gate::allows('restaurant.viewAny'));
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/vendor.php';
