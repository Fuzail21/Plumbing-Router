<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobInformations;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\PublicPortalController;
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
    Route::get('/warehouse', [JobInformations::class, 'warehouse'])->name('warehouse');

    Route::get('/sfh-eng-search', [JobInformations::class, 'sfh_eng_search'])->name('sfh_eng_search');

    Route::get('/sfh-eng-ops', [JobInformations::class, 'sfh_eng_ops'])->name('sfh_eng_ops');

    Route::get('/search-editBy-dateFeild', [JobInformations::class, 'search_editBy_dateField'])->name('search_editBy_dateField');
    Route::get('/bulk_edit', [JobInformations::class, 'bulk_edit'])->name('bulk_edit');

    Route::put('/update-job/{recnum}', [JobInformations::class, 'updateJob']);
    Route::post('/insert-job', [JobInformations::class, 'addRow'])->name('insert.job');



    Route::post('/search-editBy-dateFeild/export_excel', [JobInformations::class, 'export_excel_view_search_editBy_dateFeild'])->name('export.excel_search-editBy-dateFeild');

    Route::post('/bulk_edit/export_excel', [JobInformations::class, 'export_excel_view_bulkEdit'])->name('export.excel_bulk_edit');

    Route::post('/sfh-eng-search/export_excel', [JobInformations::class, 'export_excel_view_sf_eng_search'])->name('export.excel_sfh-eng-search');
    Route::post('/sfh-eng-ops/export_excel', [JobInformations::class, 'export_excel_view_sf_eng_ops'])->name('export.excel_sfh-eng-ops');


    Route::post('/search/export_excel', [JobInformations::class, 'export_excel_view_search'])->name('export.excel_search');

    Route::post('/warehouse/export_excel', [JobInformations::class, 'export_excel_view_warehouse'])->name('export.warehouse_excel');

    Route::get('/admin/logout', [JobInformations::class, 'AdminLogout'])->name('admin_logout');


    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('updatePassword');



    Route::get('/sf-sort-filter', [JobInformations::class, 'sf_sort_filter'])->name('sf_sort_filter');

    Route::get('/supervisors/add', [SupervisorController::class, 'showAddPage'])->name('supervisors.add');
    Route::post('/supervisors/store/{model}', [SupervisorController::class, 'store'])->name('supervisor.store');
    Route::put('/supervisors/update/{model}/{id}', [SupervisorController::class, 'update'])->name('supervisor.update');
    Route::delete('/supervisors/delete/{model}/{id}', [SupervisorController::class, 'destroy'])->name('supervisor.delete');



    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/user/list', [UserController::class, 'list'])->name('user.list');
        Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
        Route::post('/user/add', [UserController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/edit/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

        Route::get('/deleted-records', [JobInformations::class, 'deletedRecords'])->name('deleted.records');
        Route::patch('/jobs/restore/{recnum}', [JobInformations::class, 'restore'])
            ->name('jobs.restore');
        Route::delete('/jobs/hard-delete/{recnum}', [JobInformations::class, 'hardDelete'])
            ->name('jobs.hardDelete');

    });

    Route::patch('/recnum/delete/{recnum}', [JobInformations::class, 'softDelete'])->name('recnum.delete');
    


});


    Route::prefix('portal')->group(function () {
        Route::get('/', [PublicPortalController::class, 'home'])->name('portal.home');
        Route::get('/data-view', [PublicPortalController::class, 'data_view'])->name('portal.data_view');
        Route::get('/search', [PublicPortalController::class, 'search'])->name('portal.search');

        Route::get('/sfh-eng', [PublicPortalController::class, 'sfh_eng'])->name('portal.sfh_eng');
        Route::get('/com-eng', [PublicPortalController::class, 'com_eng'])->name('portal.com_eng');
        Route::get('/warehouse', [PublicPortalController::class, 'warehouse'])->name('portal.warehouse');

        Route::get('/sfh-eng-search', [PublicPortalController::class, 'sfh_eng_search'])->name('portal.sfh_eng_search');
        Route::get('/sf-sort-filter', [PublicPortalController::class, 'sf_sort_filter'])->name('portal.sf_sort_filter');
    });

require __DIR__.'/auth.php';
