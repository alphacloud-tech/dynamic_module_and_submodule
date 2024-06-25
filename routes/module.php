<?php

use App\Http\Controllers\MasterRolePermission\ModuleController;
use App\Http\Controllers\MasterRolePermission\SubModuleController;
use App\Http\Controllers\MasterRolePermission\AssignModuleRoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    //user modules
    Route::get('module/create', [ModuleController::class, 'index'])->name('index');

    Route::post('module/add', [ModuleController::class, 'create']);
    Route::post('module/update', [ModuleController::class, 'update']);
    Route::post('module/delete', [ModuleController::class, 'destroy']);

    // Sub-module route
    Route::get('sub-module/create', [SubModuleController::class, 'index'])->name('index');
    Route::post('sub-module/add', [SubModuleController::class, 'store']);
    Route::post('sub-module/update', [SubModuleController::class, 'update']);
    Route::post('sub-module/delete', [SubModuleController::class, 'destroy']);


    Route::any('/assign-module/create', [AssignModuleRoleController::class, 'index'])->name('AssignModule');
    Route::post('/assign-module/assign',   [AssignModuleRoleController::class, 'assignSubModule']);
});
