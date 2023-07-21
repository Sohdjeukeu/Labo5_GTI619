<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

// creation des routes
Route::middleware(['auth','role:Administrateur'])->group(function(){

    Route::get('/pageAdmin',function(){

        return "<h1>Bonjour les administrateurs</h1> ";
        //return Inertia::render('LesComposantReact/unComposant');
    });
});

Route::get('/post',function(){
    return Inertia::render('LesComposantReact/unComposant');
});



Route::middleware(['auth','role:Préposé aux clients résidentiels'])->group(function(){

    Route::get('/pagePreposeClientResidentiels',function(){
        return '<h1>Bonjour les Préposé aux clients résidentiels !!!</h1>';
    });
});

Route::middleware(['auth','role:Préposé aux clients d’affaire'])->group(function(){

    Route::get('/pagePreposeClientAffaire',function(){
        return '<h1>Bonjour Préposé aux clients d’affaire !!!</h1>';
    });
});




require __DIR__.'/auth.php';
