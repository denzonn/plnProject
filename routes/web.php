<?php

use App\Http\Controllers\BaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IKController;
use App\Http\Controllers\MaterialsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\sendEmailNotificationController;
use App\Http\Controllers\SOPController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [BaseController::class, 'index'])->name('home');
Route::get('/materials', [BaseController::class, 'materials']);
Route::get('/materials/{slug}', [BaseController::class, 'materialsDetail'])->name('material-detail');
Route::get('/sop', [BaseController::class, 'sop']);
Route::get('/instruksi-kerja', [BaseController::class, 'instruksiKerja']);
Route::get('/about', [BaseController::class, 'about']);

Route::get('get-sop', [SOPController::class, 'getData'])->name('get-data');
Route::get('get-ik', [IKController::class, 'getData'])->name('get-data-ik');
Route::get('get-data-limit', [BaseController::class, 'getDataLimit'])->name('get-data-limit');

Route::get('/sendEmailNotification', [sendEmailNotificationController::class, 'index'])->name('sendEmailNotification');

Route::prefix('admin')
    ->middleware(['auth', 'isAdmin'])
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);

        //SOP
        Route::get('sop', [SOPController::class, 'index'])->name('index-sop');
        Route::get('create-sop', [SOPController::class, 'create'])->name('create-sop');
        Route::post('create-sop', [SOPController::class, 'store'])->name('store-sop');
        Route::get('detail/{id}', [SOPController::class, 'edit'])->name('edit-sop');
        Route::put('edit-sop/{id}', [SOPController::class, 'update'])->name('update-sop');
        Route::delete('delete-sop/{id}', [SOPController::class, 'destroy'])->name('delete-sop');

        //IK
        Route::get('ik', [IKController::class, 'index'])->name('index-ik');
        Route::get('create-ik', [IKController::class, 'create'])->name('create-ik');
        Route::post('create-ik', [IKController::class, 'store'])->name('store-ik');
        Route::get('detail/ik/{id}', [IKController::class, 'edit'])->name('edit-ik');
        Route::put('edit-ik/{id}', [IKController::class, 'update'])->name('update-ik');
        Route::delete('delete-ik/{id}', [IKController::class, 'destroy'])->name('delete-ik');

        //Material
        Route::get('materials/filter', [MaterialsController::class, 'filter'])->name('index-filter');
        Route::get('materials/fast-moving', [MaterialsController::class, 'fastMoving'])->name('index-fast-moving');
        Route::get('materials/critical', [MaterialsController::class, 'critical'])->name('index-critical');
        Route::get('materials/slow-moving', [MaterialsController::class, 'slowMoving'])->name('index-slow-moving');
        Route::get('materials/create', [MaterialsController::class, 'create'])->name('create-materials');
        Route::get('materials/import-excel', [MaterialsController::class, 'importIndex'])->name('index-import-materials');
        Route::post('materials/create', [MaterialsController::class, 'store'])->name('store-materials');
        Route::post('materials/import', [MaterialsController::class, 'import'])->name('import-materials');
        Route::get('materials/export', [MaterialsController::class, 'export'])->name('export-materials');

        Route::get('materials/get-data-filter', [MaterialsController::class, 'getDataFilter'])->name('get-data-filter');
        Route::get('materials/get-data-fast-moving', [MaterialsController::class, 'getDataFastMoving'])->name('get-data-fast-moving');
        Route::get('materials/get-data-slow-moving', [MaterialsController::class, 'getDataSlowMoving'])->name('get-data-slow-moving');
        Route::get('materials/get-data-critical', [MaterialsController::class, 'getDataCritical'])->name('get-data-critical');

        Route::get('materials/detail/{id}', [MaterialsController::class, 'edit'])->name('edit-material');
        Route::put('materials/update/{id}', [MaterialsController::class, 'update'])->name('update-materials');
        Route::delete('materials/delete/{id}', [MaterialsController::class, 'destroy'])->name('delete-materials');

        Route::get('/admin/materials/similar', [MaterialsController::class, 'getSimilarMaterial'])->name('get-material-similar');
        Route::delete('/admin/materials/delete-selected', [MaterialsController::class, 'deleteSelected'])->name('materials.delete-selected');
        Route::delete('/admin/sop/delete-selected', [SOPController::class, 'deleteSelected'])->name('sop.delete-selected');
        Route::delete('/admin/ik/delete-selected', [IKController::class, 'deleteSelected'])->name('ik.delete-selected');
    });

require __DIR__.'/auth.php';
