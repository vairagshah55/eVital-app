<?php

use App\Http\Controllers\Web\ProductController;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    //TODO RENDER WITH ('/')
    // Route::get('/', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');

    //REDIRECT TO DASHBOARD AFTER LOGIN
    Route::get('/', function () {
        return to_route('dashboard');
    });

    //TODO RENDER WITH ('/dashboard')
    // Route::get('/dashboard', function () {
    //     return Inertia::render('Dashboard');
    // })->name('dashboard');

    //Dashboard Render
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('dashboard');


    //priduct store route -- create
    Route::post('/dashboard', [ProductController::class, 'store'])->name('products.store');

    Route::get('/products/list', [ProductController::class, 'productsList'])->name('products-list');

    Route::put('products/{product}/edit', [ProductController::class, 'productsUpdate'])->name('products.update');

    Route::get('/products/{product}/edit', [ProductController::class, 'productsEdit'])->name('products-edit');

    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});
