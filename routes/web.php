<?php

use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/questionnaire/deceased/{questionnaireName}', [DeceasedController::class, 'index'])->name('deceased.questionnaire');
Route::get('/questionnaire/imgDelete/{id}', [DeceasedController::class, 'destroyImg'])->name('deceased.destroyImg');
Route::get('/questionnaire/questions/{questionnaireName}', [QuestionController::class, 'index'])->name('questions.questionnaire');

Route::resource('questionnaire', QuestionnaireController::class);

Route::get('questionnaire/deceased', [QuestionnaireController::class, 'deceased'])->name('questionnaire.deceased');
Route::post('/question/store', [QuestionController::class, 'storeQuestion'])->name('questions.storeQuestion');
Route::resource('questions', QuestionController::class);
Route::resource('deceased', DeceasedController::class);


require __DIR__.'/auth.php';
