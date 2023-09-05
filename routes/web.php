<?php

use App\Http\Controllers\AccdashController;
use App\Http\Controllers\AccsetController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TribeController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MaritalController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\BloodtypeController;
use App\Http\Controllers\BumnclassController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\ValvisionController;
use App\Http\Controllers\BumnsectorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\FieldofpositionController;

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
    return view('welcome');
});

Route::get('/', [LandingController::class, 'index'])->name('welcome');

Route::get('/about', function () {
    return view('app-landing.about',['categories' => Category::all()]);
});
Route::get('/help', function () {
    return view('app-landing.help', ['categories' => Category::all()]);
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('users', UserController::class);
        Route::resource('maritals', MaritalController::class);
        Route::resource('cities', CityController::class);
        Route::resource('genders', GenderController::class);
        Route::resource('religions', ReligionController::class);
        Route::resource('bloodtypes', BloodtypeController::class);
        Route::resource('tribes', TribeController::class);
        Route::resource('fieldofpositions', FieldofpositionController::class);
        Route::resource('universities', UniversityController::class);
        Route::resource('valvisions', ValvisionController::class);
        Route::resource('bumnclasses', BumnclassController::class);
        Route::resource('bumnsectors', BumnsectorController::class);
        Route::resource('knowledges', KnowledgeController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('topics', TopicController::class);
        Route::resource('divisions', DivisionController::class);
        Route::get('/account-dashboard', [AccdashController::class, 'index'])->name('accdash');
        Route::get('/knowledge/{id}', [LandingController::class, 'show'])->name('knows-detail');
    });
