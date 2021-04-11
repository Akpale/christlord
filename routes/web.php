<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
	UserController,LoginController,
	LogoutController,DepartementController,
	MembreController,MemController,GroupeController,FichierController,
 };

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
// page d'accueil
Route::get('/', function () {
    return view('auth/login');
});


/* pour gerer le user*/
Route::get('user',[UserController::class,'create'])->name('user.create');

Route::resource('users', UserController::class);

Route::get('user',[UserController::class,'show'])->name('user.show');

Route::post('user/store',[UserController::class,'store'])->name('user.store');

Route::delete('destroy/{user}',[UserController::class,'destroy'])->name('user.destroy');

Route::get('edit/{user}',[UserController::class,'edit'])->name('user.edit');

Route::get('user/membre',[UserController::class,'touslesmembres'])->name('user.membre');

Route::any('/recherche', [UserController::class,'recherche'])->name('recherche');

Route::any('/programme', [UserController::class,'programme'])->name('programme');

// pour se connecter

Route::get('login',[LoginController::class,'index'])->name('login');

Route::get('logout',[LogoutController::class,'logout'])->name('logout');

Route::post('login',[LoginController::class,'login'])->name('post.login');



/*route du model departement*/
Route::post('departement/store',[DepartementController::class,'store'])->name('post.departement');



Route::get('show',[DepartementController::class,'show'])->name('departement.show');

Route::get('editer/{departement}',[DepartementController::class,'edit'])->name('departement.edit');

Route::get('departement/create',[DepartementController::class,'create'])->name('departement.create');

Route::delete('destroy/{departement}',[DepartementController::class,'destroy'])->name('departement.destroy');


//Route::post('departement',[DepartementController::class,'update'])->name('departement.update');

Route::resource('departements', DepartementController::class);



/*route pour la modification du password*/
Route::post('password',[UserController::class,'updatePassword'])->name('update.password');

Route::get('user/password',[UserController::class,'password'])->name('user.password');

Route::get('membre/password',[MembreController::class,'password'])->name('membre.password');

Route::post('password2',[MembreController::class,'updatePassword'])->name('update.password2');



Route::get('layouts', function () {
    return view('layouts.tbbord');
});



/*route pour gerer le statut*/

Route::post('statut/{user}',[UserController::class,'statut'])->name('user.statut');

/*route pour gerer les membres*/

Route::resource('membres', MembreController::class);

Route::get('membre/show',[MembreController::class,'show'])->name('membre.show');

Route::post('store',[MembreController::class,'store'])->name('membre.store');

//Route::get('mem/show',[MembreController::class,'show2'])->name('mem.show');


Route::get('membre2',[MembreController::class,'index2'])->name('mem.index');

Route::get('mem/create',[MembreController::class,'create2'])->name('mem.create');

Route::get('mem/show',[MembreController::class,'show2'])->name('mem.show');

Route::get('mem/password',[MembreController::class,'password2'])->name('mem.password');


Route::get('mem/{membre}/edit',[MembreController::class,'edit2'])->name('mem.edit');

Route::delete('mem/{membre}',[MembreController::class,'destroy2'])->name('mem.destroy');

Route::post('mem/store',[MembreController::class,'store2'])->name('mem.store');


Route::post('mem/{membre}',[MembreController::class,'update2'])->name('mem.update');

//Route::post('password2',[MembreController::class,'updatePassword'])->name('update.password2');

Route::resource('groupes', GroupeController::class);

Route::resource('fichiers', FichierController::class);

Route::get('fichier.show',[FichierController::class,'show'])->name('fichier.show');

Route::get('groupe/{fichier}/edit',[GroupeController::class,'edit'])->name('groupe.edit');

Route::post('groupes/{fichier}',[GroupeController::class,'update'])->name('groupe.update');

Route::get('/storage/fichiers/{fichier}/',[FichierController::class,'telecharger'])->name('fichier.telecharger');

