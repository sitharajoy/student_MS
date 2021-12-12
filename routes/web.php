<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentMarkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//student
Route::get('/', [StudentController::class, 'index'])->name('studentList');
Route::post('/create', [StudentController::class, 'addStudent'])->name('addStudent');
Route::get('/{id}/show',[StudentController::class, 'updateStudentView'])->name('updateStudentView');
Route::post('/{id}/edit',[StudentController::class, 'updateStudent'])->name('updateStudent');
Route::delete('/delete', [StudentController::class, 'deleteStudent'])->name('deleteStudent');

//student marks
Route::get('/marks',[StudentMarkController::class, 'addStudentView'])->name('addStudentMarkView');
Route::post('add/marks',[StudentMarkController::class, 'addStudentMarks'])->name('addStudentMark');
Route::get('/{id}/{term}/show-marks',[StudentMarkController::class, 'updateStudentMarkView'])->name('updateStudentMarkView');
Route::post('/edit-marks',[StudentMarkController::class, 'updateStudentMark'])->name('updateStudentMark');
Route::delete('/delete-mark', [StudentMarkController::class, 'deleteStudentMark'])->name('deleteStudentMark');
