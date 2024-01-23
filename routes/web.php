<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CompanyController;
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
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/questionnaire/information/{questionnaireName}', [QuestionnaireController::class, 'filledin'])->name('questionnaire.filledin');
    Route::get('/questionnaire/deceased/{questionnaireName}', [DeceasedController::class, 'index'])->name('deceased.questionnaire');
    Route::get('/questionnaire/imgDelete/{id}', [DeceasedController::class, 'destroyImg'])->name('deceased.destroyImg');
    Route::get('/questionnaire/questions/{questionnaireName}', [QuestionController::class, 'index'])->name('questions.questionnaire');
    Route::get('questionnaire/deceased', [QuestionnaireController::class, 'deceased'])->name('questionnaire.deceased');
});

Route::middleware(['auth', 'checkadmin'])->group(function () {
    Route::get('/question', [QuestionController::class, 'questionDashboard'])->name('question.dashboard');
    Route::post('/question/store', [QuestionController::class, 'questionStore'])->name('question.storeQuestion');
    Route::put('/question/update/{question}', [QuestionController::class, 'questionUpdate'])->name('question.update');
    Route::delete('/question/delete/{question}', [QuestionController::class, 'questionDelete'])->name('question.destroy');
});

Route::resource('questions', QuestionController::class);
Route::resource('deceased', DeceasedController::class);
Route::post('deceased/{questionnaireName1}', [DeceasedController::class, 'store'])->name('deceased.store');

Route::middleware(['auth', 'checkadmin'])->group(function () {
    Route::get('/companies/{companyName}', [CompanyController::class, 'edit'])->name('companie.edit');
    Route::resource('companies', CompanyController::class);
});

Route::post('/answer/check', [AnswerController::class, 'check'])->name('answer.check');
Route::get('/answer/{customercode}', [AnswerController::class, 'show'])->name('answers.show');
Route::resource('answer', AnswerController::class);
Route::get('/questionnaire/{questionnaireName}', [QuestionnaireController::class, 'show'])->name('questionnaire.show');
Route::resource('questionnaire', QuestionnaireController::class)->middleware('auth');

require __DIR__.'/auth.php';
