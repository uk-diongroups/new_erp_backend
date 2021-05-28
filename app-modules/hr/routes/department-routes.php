<?php

use Modules\Hr\Http\Controllers\DepartmentController;

Route::prefix('api')->middleware(['auth:sanctum'])->group(function () {
   Route::get('/employees', [DepartmentController::class, 'index'])->name('employees.index');
   Route::get('/employee/logout', [DepartmentController::class, 'logout'])->name('employee.logout');
   // Route::get('/employees/create', [DepartmentController::class, 'create'])->name('employees.create');
   // Route::post('/employees', [DepartmentController::class, 'store'])->name('employees.store');
   // Route::get('/employees/{employee}', [DepartmentController::class, 'show'])->name('employees.show');
   // Route::get('/employees/{employee}/edit', [DepartmentController::class, 'edit'])->name('employees.edit');
   // Route::put('/employees/{employee}', [DepartmentController::class, 'update'])->name('employees.update');
   // Route::delete('/employees/{employee}', [DepartmentController::class, 'destroy'])->name('employees.destroy');
});
