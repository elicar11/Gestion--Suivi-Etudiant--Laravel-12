<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnneeController;
use App\Http\Controllers\DiplomeController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ObtenirController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use Illuminate\Auth\Middleware\Authenticate;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    // return view('welcome');
    return view('Authentification.connexion');
})->name('home');


require __DIR__.'/settings.php';


Route::get('/login',[UserController::class, 'connexion'])->name('login');
Route::post('/connexion_traitement', [UserController::class, 'connexion_traitement'])->name('login.process');
Route::get('/inscription',[UserController::class, 'inscription']);
Route::post('/inscription_traitement', [UserController::class, 'inscription_traitement']);
Route::post('/deconnexion', [UserController::class, 'deconnexion'])->name('logout');

Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth', 'prevent-back'])->group(function(){
    Route::get('/Dashboard', [DashboardController::class, 'index'])->name('Dashboard');

    Route::resource('annees',   AnneeController::class);
    Route::resource('etudiants', EtudiantController::class);
    Route::resource('diplomes', DiplomeController::class);

    Route::get('/obtenirs/pdf', [ObtenirController::class, 'generatePdf'])->name('obtenirs.pdf');
    Route::resource('obtenirs', ObtenirController::class);

    // Route::redirect('/etudiant', '/etudiants');
    // Route::redirect('/diplome', '/diplomes');
    // Route::redirect('/obtenir', '/obtenirs');

});







