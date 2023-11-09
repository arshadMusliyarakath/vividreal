<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::post('login', [ApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('companies', [ApiController::class, 'allCompanies']);
    Route::post('company', [ApiController::class, 'company']);
    Route::post('add-company', [ApiController::class, 'addCompany']);
    Route::post('edit-company', [ApiController::class, 'editCompany']);
    Route::post('delete-company', [ApiController::class, 'deleteCompany']);

    Route::post('employees', [ApiController::class, 'allEmployees']);
    Route::post('employee', [ApiController::class, 'employee']);
    Route::post('add-employee', [ApiController::class, 'addEmployee']);
    Route::post('edit-employee', [ApiController::class, 'editEmployee']);
    Route::post('delete-employee', [ApiController::class, 'deleteEmployee']);

    Route::post('logout', [ApiController::class, 'logout']);
});


