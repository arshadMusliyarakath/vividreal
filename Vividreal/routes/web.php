<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FrondEndController;
use Illuminate\Support\Facades\Route;

Route::get('login', [FrondEndController::class, 'userLogin'])->name('login');

Route::post('do-login', [FrondEndController::class, 'doLogin'])->name('user.do.login');

Route::group(['middleware' => 'user_auth'], function(){
    Route::get('logout', [FrondEndController::class, 'userLogout'])->name('user.logout');

    Route::get('/', [FrondEndController::class, 'home'])->name('home');
    Route::get('companies', [CompanyController::class, 'companies'])->name('companies');

    Route::get('company-data', [CompanyController::class, 'companyData'])->name('companyData');

    Route::get('add-company', [CompanyController::class, 'addCompany'])->name('company.add');
    Route::post('do-add-company', [CompanyController::class, 'doAddCompany'])->name('company.do.add');

    Route::get('edit-company/{company_id}', [CompanyController::class, 'editCompany'])->name('company.edit');
    Route::post('do-edit-company', [CompanyController::class, 'doEditCompany'])->name('company.do.edit');

    Route::get('delete-company/{company_id}', [CompanyController::class, 'deleteCompany'])->name('company.delete');

    Route::get('employees', [EmployeeController::class, 'employees'])->name('employees');
    Route::get('employee-data', [EmployeeController::class, 'employeeData'])->name('employeeData');

    Route::get('add-employee', [EmployeeController::class, 'addEmployee'])->name('employee.add');
    Route::post('do-add-employee', [EmployeeController::class, 'doAddEmployee'])->name('employee.do.add');

    Route::get('edit-employee/{employee_id}', [EmployeeController::class, 'editEmployee'])->name('employee.edit');
    Route::post('do-edit-employee', [EmployeeController::class, 'doEditEmployee'])->name('employee.do.edit');

    Route::get('delete-employee/{employee_id}', [EmployeeController::class, 'deleteEmployee'])->name('employee.delete');
});


