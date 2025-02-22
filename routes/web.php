<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobInformations;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('auth.login');
// });


Route::get('/', [JobInformations::class, 'home'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/add', [JobInformations::class, 'add'])->name('form.add');
    Route::post('/add', [JobInformations::class, 'insert'])->name('form.insert');
    Route::get('/edit/{recnum}', [JobInformations::class, 'edit'])->name('form.edit');
    Route::post('/edit/{recnum}', [JobInformations::class, 'update'])->name('form.update');



    Route::get('/data-view', [JobInformations::class, 'data_view'])->name('data_view');
    Route::get('/search', [JobInformations::class, 'search'])->name('search');


    Route::get('/sfh-eng', [JobInformations::class, 'sfh_eng'])->name('sfh_eng');
    Route::get('/com-eng', [JobInformations::class, 'com_eng'])->name('com_eng');

    Route::get('/sfh-eng-search', [JobInformations::class, 'sfh_eng_search'])->name('sfh_eng_search');

    Route::get('/search-editBy-dateFeild', [JobInformations::class, 'search_editBy_dateField'])->name('search_editBy_dateField');
    Route::get('/bulk_edit', [JobInformations::class, 'bulk_edit'])->name('bulk_edit');

    Route::put('/update-job/{recnum}', [JobInformations::class, 'updateJob']);



    Route::post('/search-editBy-dateFeild/export_excel', [JobInformations::class, 'export_excel_view_search_editBy_dateFeild'])->name('export.excel_search-editBy-dateFeild');

    Route::post('/bulk_edit/export_excel', [JobInformations::class, 'export_excel_view_bulkEdit'])->name('export.excel_bulk_edit');

    Route::post('/sfh-eng-search/export_excel', [JobInformations::class, 'export_excel_view_sf_eng_search'])->name('export.excel_sfh-eng-search');


    Route::post('/search/export_excel', [JobInformations::class, 'export_excel_view_search'])->name('export.excel_search');

    Route::get('/admin/logout', [JobInformations::class, 'AdminLogout'])->name('admin_logout');




    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/user/list', [UserController::class, 'list'])->name('user.list');
        Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
        Route::post('/user/add', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');
    });


});

require __DIR__.'/auth.php';
