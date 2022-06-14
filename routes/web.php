<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\User_ControllerTache;
use App\Http\Controllers\User_ControlletProject;
use App\Http\Controllers\User_controllerInfo;

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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');


Route::group(['middleware' => ['isAdmin']], function () {
    Route::resource('project', projectController::class);
    Route::resource('user', ControllerUser::class);
    Route::resource('tache', ControllerTache::class);
    Route::resource('categorie', ControllerCategorie::class);
    Route::get('/chart',[dashboardController::class,'index']);
    Route::get('/showtache/{id}', 'ControllerTache@detailsTache')->name('showtache');
    Route::get('/dashboard', 'ControllerTache@tacheaujourd')->name('dashboard');
    Route::get('/indexCat', 'projectController@indexCat')->name('indexCat');
    Route::get('/indexCalPro/{id}', 'projectController@indexCalPro')->name('indexCalPro');
    Route::get('/validate/{id}', 'projectController@valider')->name('validate');
    Route::get('/ProjetValider', 'projectController@ProjetValider')->name('ProjetValider');
    Route::get('/ProjetEnCours', 'projectController@ProjetEnCours')->name('ProjetEnCours');
    Route::get('/validate_tache/{id}', 'ControllerTache@valider')->name('validate_tache');
    Route::get('/TacheEnCours', 'ControllerTache@TacheEnCours')->name('TacheEnCours');
    Route::get('/TacheValider', 'ControllerTache@TacheValider')->name('TacheValider');
    Route::get('/TacheNull', 'ControllerTache@TacheNull')->name('TacheNull');
    Route::get('/SelectUser/{id}', 'ControllerTache@SelectUser')->name('SelectUser');
    Route::POST('/AffecterTache', 'ControllerTache@AffecterTache')->name('AffecterTache');
    Route::POST('/pdf', 'ControllerTache@pdf')->name('pdf');
    Route::get('/Periode/{id}', 'ControllerTache@Periode')->name('Periode');
    Route::get('/Rapport', 'ControllerUser@Rapport')->name('Rapport');
    Route::get('/Rapport_Par_Jours', 'ControllerTache@Rapport_Par_Jours')->name('Rapport_Par_Jours');








    



 });
 
 Route::group(['middleware' => ['isBU']], function () {
     Route::resource('BU_project',BU_ControllerProject::class);
     Route::resource('BU_user', BU_ControllerUser::class);
     Route::resource('BU_categorie', BU_ControllerCategorie::class);
     Route::resource('BU_tache', BU_ControllerTache::class);
     Route::get('/BU_showtache/{id}', 'BU_ControllerTache@detailsTache')->name('BU_showtache');
    // Route::get('/dashboardBu', 'BU_ControllerProject@indexCat')->name('dashboardBu');
    // Route::get('/BU_indexCalPro', 'BU_ControllerProject@indexCalPro')->name('BU_indexCalPro');
    Route::get('/BU_validate/{id}', 'BU_ControllerProject@valider')->name('BU_validate');
    Route::get('/BU_ProjetValider', 'BU_ControllerProject@ProjetValider')->name('BU_ProjetValider');
    Route::get('/BU_ProjetEnCours', 'BU_ControllerProject@ProjetEnCours')->name('BU_ProjetEnCours');
    Route::get('/BU_validate_tache/{id}', 'BU_ControllerTache@valider')->name('BU_validate_tache');
    Route::get('/BU_TacheEnCours', 'BU_ControllerTache@TacheEnCours')->name('BU_TacheEnCours');
    Route::get('/BU_TacheValider', 'BU_ControllerTache@TacheValider')->name('BU_TacheValider');
    Route::get('/BU_TacheNull', 'BU_ControllerTache@TacheNull')->name('BU_TacheNull');
    Route::get('/BU_Rapport', 'BU_ControllerUser@Rapport')->name('BU_Rapport');
    Route::get('/BU_Periode/{id}', 'BU_ControllerTache@Periode')->name('BU_Periode');
    Route::POST('/BU_pdf', 'ControllerTache@pdf')->name('BU_pdf');
    Route::get('/dashboardBu', 'BU_ControllerTache@tacheaujourd')->name('dashboardBu');
    Route::get('/BU_Rapport_Par_Jours', 'BU_ControllerTache@Rapport_Par_Jours')->name('BU_Rapport_Par_Jours');
    Route::get('/BU_SelectUser/{id}', 'BU_ControllerTache@SelectUser')->name('BU_SelectUser');
    Route::POST('/BU_AffecterTache', 'BU_ControllerTache@AffecterTache')->name('BU_AffecterTache');







  });

  
  Route::group(['middleware' => ['isUser']], function () {
    
    Route::resource('User_tache',User_ControllerTache::class);
    Route::resource('User_project',User_ControlletProject::class);
    Route::get('/User_TacheValider', 'User_ControllerTache@TacheValider')->name('User_TacheValider');
    Route::get('/User_TacheEnCours', 'User_ControllerTache@TacheEnCours')->name('User_TacheEnCours');
    Route::get('/User_validate_tache/{id}', 'User_ControllerTache@valider')->name('User_validate_tache');
    Route::get('/User_showtache/{id}', 'User_ControllerTache@detailsTache')->name('User_showtache');
    Route::get('/tacheaujourd', 'User_ControllerTache@tacheaujourd')->name('tacheaujourd');
    Route::get('/search', 'User_ControllerTache@search')->name('search');
    Route::get('/count_tache', 'User_ControllerTache@count_tache')->name('count_tache');
    Route::get('/profile', 'User_controllerInfo@profile')->name('profile');
    Route::resource('User_Info',User_ControllerInfo::class);
    Route::PUT('/editPassword', 'User_controllerInfo@editPassword')->name('editPassword');









 });
  
 
 
 
 
 Route::get('/home',[HomeController::class,'redirect']);
 Auth::routes();
require __DIR__.'/auth.php';
