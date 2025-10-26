<?php

use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUser;


Route::get('/', function () {
    return view('welcome');
});





///Only for User
Route::middleware(['auth',IsUser::class])->group(function(){
       Route::get('/dashboard', function(){
       return view('dashboard');
    })->name('dashboard');
});

///Only for Admin
Route::prefix('admin')->middleware(['auth',IsAdmin::class])->group(function(){
       Route::get('/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
       Route::get('/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
       Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
       Route::post('/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
       Route::get('/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
       Route::post('/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

       Route::controller(PlanController::class)->group(function(){
        Route::get('/all/plans', 'AllPlans')->name('all.plans');
        Route::get('/add/plans', 'AddPlans')->name('add.plans');
        Route::post('/store/plans', 'StorePlans')->name('store.plans');
        Route::get('/edit/plans/{id}', 'EditPlans')->name('edit.plans');
        Route::post('/update/plan', 'UpdatePlan')->name('update.plans');
        Route::get('/delete/plan/{id}', 'DeletePlan')->name('delete.plan');


       });

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::post('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/verify', [AdminController::class, 'ShowVerification'])->name('custom.verification.form');
Route::post('/verify', [AdminController::class, 'VerificationVerify'])->name('custom.verification.verify');


