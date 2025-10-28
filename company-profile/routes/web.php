<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ContactController;
// use App\Http\Controllers\AboutController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\Admin\ProfilController;


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
// Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/contact', [ContactController::class, 'frontendIndex'])->name('contact.index');
Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/{marketplace}', [MarketplaceController::class, 'show'])->name('marketplace.show');
Route::get('/profile', [ProfilController::class, 'index'])->name('profile.index');
Route::get('/profile/{profile}', [ProfilController::class, 'show'])->name('profile.show');


/*
|--------------------------------------------------------------------------
| Login dan Logout
|--------------------------------------------------------------------------
*/
Route::get('/administrator', function () {
    // Jika user sudah login, langsung arahkan ke dashboard sesuai role
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'superadmin') {
            return redirect()->route('superadmin.dashboard');
        } elseif ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect('/');
        }
    }

    // Kalau belum login, tampilkan form login
    return app(\App\Http\Controllers\Auth\LoginController::class)->showLoginForm();
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
        if (!Auth::check()) {
            return redirect()->route('administrator-login');
        }
        $user = Auth::user();

        // Kalau yang login bukan superadmin, redirect ke dashboard sesuai rolenya
        if ($user->role !== 'superadmin') {
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect('/');
        }
        return view('auth.dashboard');
    })->name('superadmin.dashboard');

    // Dashboard Admin
    Route::get('/admin/dashboard', function () {
        if (!Auth::check()) {
            return redirect()->route('administrator-login');
        }
        $user = Auth::user();

        // Kalau yang login bukan admin, redirect ke dashboard sesuai rolenya
        if ($user->role !== 'admin') {
            if ($user->role === 'superadmin') {
                return redirect()->route('superadmin.dashboard');
            }
            return redirect('/');
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
    Route::get('/{role}/profil/edit', [ProfilController::class, 'edit'])
        ->where('role', 'admin|superadmin')
        ->name('profil.edit');
    Route::put('/{role}/profil/update', [ProfilController::class, 'update'])
        ->where('role', 'admin|superadmin')
        ->name('profil.update');

    // Bagian tambahan ProfilSection
    Route::post('/{role}/profil/tambah-section', [ProfilController::class, 'tambahSection'])
        ->where('role', 'admin|superadmin')
        ->name('profil.tambahSection');
    Route::put('/{role}/profil/edit-section/{id}', [ProfilController::class, 'editSection'])
        ->where('role', 'admin|superadmin')
        ->name('profil.editSection');
    Route::delete('/{role}/profil/hapus-section/{id}', [ProfilController::class, 'hapusSection'])
        ->where('role', 'admin|superadmin')
        ->name('profil.hapusSection');

    // Kelola layanan
    Route::get('/{role}/profil/layanan', [LayananController::class, 'index'])
        ->where('role', 'admin|superadmin')
        ->name('layanan.index');
    Route::post('/{role}/profil/layanan/store', [LayananController::class, 'store'])
        ->where('role', 'admin|superadmin')
        ->name('layanan.store');
    Route::post('/{role}/profil/layanan/update/{id}', [LayananController::class, 'update'])
        ->where('role', 'admin|superadmin')
        ->name('layanan.update');
    Route::delete('/{role}/profil/layanan/delete/{id}', [LayananController::class, 'destroy'])
        ->where('role', 'admin|superadmin')
        ->name('layanan.destroy');

    // Bagian layanan edit
    Route::post('/{role}/profil/tambah-layanan', [ProfilController::class, 'tambahLayanan'])
        ->where('role', 'admin|superadmin')
        ->name('layanan.store');

    // Route::put('/{role}/profil/edit-layanan/{id}', [ProfilController::class, 'editLayanan'])
    //     ->where('role', 'admin|superadmin')
    //     ->name('layanan.update');

    Route::delete('/{role}/profil/hapus-layanan/{id}', [ProfilController::class, 'hapusLayanan'])
        ->where('role', 'admin|superadmin')
        ->name('layanan.destroy');

        
   // ✅ Kelola Marketplace
    Route::get('/{role}/marketplace/edit', [App\Http\Controllers\MarketplaceController::class, 'editPage'])
        ->where('role', 'admin|superadmin')
        ->name('admin.marketplace.edit');

    Route::post('/{role}/marketplace/store', [App\Http\Controllers\MarketplaceController::class, 'store'])
        ->where('role', 'admin|superadmin')
        ->name('admin.marketplace.store');

    Route::delete('/{role}/marketplace/{id}', [App\Http\Controllers\MarketplaceController::class, 'destroy'])
        ->where('role', 'admin|superadmin')
        ->name('admin.marketplace.destroy');

    Route::get('/{role}/marketplace/edit/{id}', [App\Http\Controllers\MarketplaceController::class, 'edit'])
        ->where('role', 'admin|superadmin')
        ->name('admin.marketplace.edit.single');

    Route::post('/{role}/marketplace/update/{id}', [App\Http\Controllers\MarketplaceController::class, 'update'])
        ->where('role', 'admin|superadmin')
        ->name('admin.marketplace.update');






    //recources lainnya
    Route::resource('/profile', \App\Http\Controllers\ProfilController::class); //link tampilan pengunjung
    Route::resource('/product', \App\Http\Controllers\ProductController::class);
   
    
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