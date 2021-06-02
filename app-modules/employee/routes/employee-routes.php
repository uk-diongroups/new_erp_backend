<?php


 use Modules\Employee\Http\Controllers\EmployeeController;

 Route::prefix('api')->group(function () {
    Route::post('employees/login', [EmployeeController::class, 'login'])->name('employees.login');
    Route::get('fetchEmployees', [EmployeeController::class, 'getEmployees'])->name('getEmployees');
 });

 Route::middleware('auth:sanctum')->prefix('api')->group(function () {
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employee/logout', [EmployeeController::class, 'logout'])->name('employee.logout');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
 });

