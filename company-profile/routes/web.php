<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\HomeContentController;
use App\Http\Controllers\Admin\WhyContentController;
use App\Http\Controllers\LayananListController;


/*
|--------------------------------------------------------------------------
| Halaman Depan (Pengunjung)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'frontendIndex'])->name('products.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/contact', [ContactController::class, 'frontendIndex'])->name('contact.index');
Route::get('/contact/{contact}', [ContactController::class, 'show'])->name('contact.show');
Route::get('/marketplace', [MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/{marketplace}', [MarketplaceController::class, 'show'])->name('marketplace.show');
Route::get('/profile', [\App\Http\Controllers\ProfilController::class, 'index'])->name('profile.index');
Route::get('/profile/{profile}', [\App\Http\Controllers\ProfilController::class, 'show'])->name('profile.show');
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/home/{home}', [\App\Http\Controllers\HomeController::class, 'show'])->name('home.show');


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

    /* KONTEN ADMIN & SUPERADMIN */ 
    Route::prefix('{role}')
        //->middleware('auth')
        ->where(['role' => 'admin|superadmin'])
        ->group(function () {
            // Kontak
            Route::get('/contact/edit', [ContactController::class, 'editPage'])->name('admin.contact.editpage');
            Route::post('/contact/update', [ContactController::class, 'updatePage'])->name('admin.contact.updatepage');

            // Profil
            Route::get('/profil/edit', [ProfilController::class, 'edit'])->name('profil.edit');
            Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

            // Profil Section
            Route::post('/profil/tambah-section', [ProfilController::class, 'tambahSection'])->name('profil.tambahSection');
            Route::put('/profil/edit-section/{id}', [ProfilController::class, 'editSection'])->name('profil.editSection');
            Route::delete('/profil/hapus-section/{id}', [ProfilController::class, 'hapusSection'])->name('profil.hapusSection');

            // Layanan
            Route::get('/profil/layanan', [LayananController::class, 'index'])->name('layanan.index');
            Route::post('/profil/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
            Route::put('/profil/layanan/update/{id}', [LayananController::class, 'update'])->name('layanan.update');
            Route::delete('/profil/layanan/delete/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

            // tambah layanan
            Route::post('/profil/tambah-layanan', [ProfilController::class, 'tambahLayanan'])->name('layanan.store');
            Route::delete('/profil/hapus-layanan/{id}', [ProfilController::class, 'hapusLayanan'])->name('layanan.destroy');

            // Marketplace
            Route::get('/marketplace/edit', [MarketplaceController::class, 'editPage'])->name('admin.marketplace.edit');
            Route::post('/marketplace/store', [MarketplaceController::class, 'store'])->name('admin.marketplace.store');
            Route::delete('/marketplace/{id}', [MarketplaceController::class, 'destroy'])->name('admin.marketplace.destroy');
            Route::get('/marketplace/edit/{id}', [MarketplaceController::class, 'edit'])->name('admin.marketplace.edit.single');
            Route::post('/marketplace/update/{id}', [MarketplaceController::class, 'update'])->name('admin.marketplace.update');

            //products
            Route::resource('products', ProductController::class)->names('admin.products');

            // HOME CONTENT 
            Route::get('/home_content/edit', [HomeContentController::class, 'edit']) ->name('admin.home_content.edit'); 
            Route::post('/home_content/update', [HomeContentController::class, 'update']) ->name('admin.home_content.update'); 
            //Route::put('/home_content/update/{role}', [HomeContentController::class, 'update']) ->name('admin.home_content.update');

            // SLIDER 
            Route::post('/home_content/slider/store', [HomeContentController::class, 'addSlider']) ->name('admin.slider.store'); 
            Route::delete('/home_content/slider/delete/{id}', [HomeContentController::class, 'deleteSlider']) ->name('admin.slider.delete');
            
           // LAYANAN LIST
            Route::post('/layananlist/add',[HomeContentController::class, 'addLayananList'])->where('role', 'admin|superadmin')->name('admin.layananlist.add');
            Route::post('/layananlist/update/{id}',[HomeContentController::class, 'updateLayananList'])->where('role', 'admin|superadmin')->name('admin.layananlist.update');
            Route::delete('/layananlist/delete/{id}',[HomeContentController::class, 'deleteLayananList'])->where('role', 'admin|superadmin')->name('admin.layananlist.delete');

            //why
            Route::get('/home_content/why/edit/{id}', [WhyContentController::class, 'edit'])->name('admin.why.edit');
            Route::post('/home_content/why/update/{id}', [WhyContentController::class, 'update'])->name('admin.why.update');
            Route::delete('/home_content/why/delete/{id}', [WhyContentController::class, 'delete'])->name('admin.why.delete');
            Route::post('/home_content/why/store', [WhyContentController::class, 'store'])->name('admin.why.store');

        });

    

    // KHUSUS ADMIN
    Route::prefix('admin')->middleware('auth')->group(function () {
        Route::resource('products', ProductController::class)->names('admin.products');
    });


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


