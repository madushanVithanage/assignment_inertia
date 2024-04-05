<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;
use Inertia\Inertia;


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

// Route::get('/', function () {
//     return Inertia::render('login', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get('/', [studentController::class, 'view_all'])->name('student.all');
Route::get('/list', [studentController::class, 'studentList'])->name('student.list');
Route::get('/editView/{student_id}', [studentController::class, 'viewEditData'])->name('student.viewEdit');
Route::post('/update/{student_id}', [studentController::class, 'updateStudent'])->name('student.update');
Route::post('/saveStudentData', [studentController::class, 'saveStudent'])->name('student.save');
Route::delete('/deleteStudentData/{student_id}', [studentController::class, 'deleteStudent'])->name('student.delete');

Route::get('/addnew', function () {
    return Inertia::render('Student/index');
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
