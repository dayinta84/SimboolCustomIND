<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\AboutController;

/*
|--------------------------------------------------------------------------
| Halaman Depan (Pengunjung)
|--------------------------------------------------------------------------
*/
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [ContactController::class, 'frontendIndex'])->name('contact.index');
Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
Route::get('/marketplaces', [MarketplaceController::class, 'index'])->name('marketplaces.index');
Route::get('/marketplaces/{marketplace}', [MarketplaceController::class, 'show'])->name('marketplaces.show');
Route::get('/profile', [ProfilController::class, 'index'])->name('profile.index');
Route::get('/profile/{profile}', [ProfilController::class, 'show'])->name('profile.show');


/*
|--------------------------------------------------------------------------
| Login dan Logout
|--------------------------------------------------------------------------
*/
Route::get('/administrator', function () {
    // Jika user sudah login, logout otomatis dulu
    if (Auth::check()) {
        Auth::logout();
    }
    // Panggil tampilan form login dari controller
    return app(LoginController::class)->showLoginForm();
})->name('administrator-login');

Route::post('/administrator', [LoginController::class, 'login'])
    ->name('administrator-login.submit');

Route::post('/logout', [LoginController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Dashboard (Hanya untuk user yang sudah login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard Superadmin
    Route::get('/superadmin/dashboard', function () {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Akses ditolak');
        }
        return view('auth.dashboard');
    })->name('superadmin.dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        if (Auth::user()->role !== 'admin') {
            abortz(403, 'Akses ditolak');
        }
        return view('auth.admin');
    })->name('admin.dashboard');

            //KONTEN ADMIN
    // Kelola halaman kontak
    Route::get('/{role}/contact/edit', [\App\Http\Controllers\ContactController::class, 'editPage'])
        ->where('role', 'admin|superadmin')
        ->name('admin.contact.editpage');
    Route::post('/{role}/contact/update', [\App\Http\Controllers\ContactController::class, 'updatePage'])
        ->where('role', 'admin|superadmin')
        ->name('admin.contact.updatepage');

    // Kelola halaman profil
    Route::get('/{role}/profil/edit', [App\Http\Controllers\Admin\ProfilController::class, 'edit'])
        ->where('role', 'admin|superadmin')
        ->name('profil.edit');
    Route::post('/{role}/profil/update', [App\Http\Controllers\Admin\ProfilController::class, 'update'])
        ->where('role', 'admin|superadmin')
        ->name('profil.update');




    //recources lainnya
    Route::resource('/profile', \App\Http\Controllers\ProfilController::class);
    Route::resource('/product', \App\Http\Controllers\ProductController::class);
    Route::resource('/marketplace', \App\Http\Controllers\MarketplaceController::class);
    Route::resource('/contact', \App\Http\Controllers\ContactController::class);
    
    // ============================
    // CRUD USER (khusus superadmin)
    // ============================
    Route::group(['prefix' => 'superadmin', 'middleware' => 'auth'], function () {
        Route::group(['middleware' => function ($request, $next) {
            if (Auth::user()->role !== 'superadmin') {
                abort(403, 'Akses ditolak');
            }
            return $next($request);
        }], function () {
            Route::resource('users', \App\Http\Controllers\Admin\UserController::class)
                ->names('superadmin.users');
        });
    });
    
});






// routes untuk admin mengelola konten homepage
// di bagian middleware(['auth'])->group(...) BLM KEPAKE
Route::get('/admin/home-content/edit', [\App\Http\Controllers\Admin\HomeContentController::class, 'edit'])
    ->name('admin.home-content.edit')
    ->middleware('can:manage-content'); // opsional: gunakan gate/ability atau cek role di middleware

Route::post('/admin/home-content/update', [\App\Http\Controllers\Admin\HomeContentController::class, 'update'])
    ->name('admin.home-content.update')
    ->middleware('can:manage-content');