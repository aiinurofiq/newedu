<?php

use App\Http\Controllers\ArsipController;
use App\Http\Livewire\admin\Learningadmin;
use App\Http\Livewire\admin\WsLivewire;
use App\Http\Livewire\Quizdetail;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KnowController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TribeController;
use App\Http\Controllers\AccsetController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\AccdashController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MaritalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\KnowDashController;
use App\Http\Controllers\LearningController;
use App\Http\Controllers\LpaymentController;
use App\Http\Controllers\ReligionController;
use App\Http\Controllers\BloodtypeController;
use App\Http\Controllers\BumnclassController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\LearnDashController;
use App\Http\Controllers\ValvisionController;
use App\Http\Controllers\BumnsectorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\LTransactionController;
use App\Http\Controllers\CategorylearnController;
use App\Http\Controllers\FieldofpositionController;
use App\Http\Controllers\KkeamananController;
use App\Http\Controllers\JenisarsipController;
use App\Http\Controllers\KeteranganController;
use App\Http\Controllers\DasarpertimbanganController;
use App\Http\Controllers\LearnController;
use App\Http\Livewire\admin\Approveknowledge;
use App\Http\Livewire\admin\CategoryLivewire;
use App\Http\Livewire\admin\DivisiLivewire;
use App\Http\Livewire\admin\Sectionmodule;
use App\Http\Livewire\Checkout;
use App\Http\Livewire\KnowAll;
use App\Http\Livewire\admin\Knowledgeadmin;
use App\Http\Livewire\admin\Permission;
use App\Http\Livewire\admin\Requestknowledge;
use App\Http\Livewire\admin\TopicLivewire;
use App\Http\Livewire\LearnAll;
use App\Http\Livewire\Quiz;
use App\Http\Livewire\admin\Authlogin;


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
Route::get('/all-learning', [LearnAll::class, 'render'])->name('learn-all');
Route::get('/all-knowledge', [KnowAll::class, 'render'])->name('know-all');

Route::get('/listpegawai', [LandingController::class, 'changepegawai'])->name('listpegawai');
Route::post('/loginpegawai', [Authlogin::class, 'login'])->name('loginpegawai');


Route::post('/dropzone/store', [Learningadmin::class, 'dropzoneStore'])->name('dropzonestore');

Route::get('/about', function () {
    return view('app-landing.about');
});
Route::get('/help', function () {
    return view('app-landing.help');
});


Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('arsips', ArsipController::class);
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
        Route::resource('learnings', LearningController::class);
        Route::resource('coupons', CouponController::class);
        Route::resource('categorylearns', CategorylearnController::class);
        Route::resource('l-transactions', LTransactionController::class);
        Route::resource('lpayments', LpaymentController::class);
        Route::resource(
            'dasarpertimbangans',
            DasarpertimbanganController::class
        );
        Route::resource('jenisarsips', JenisarsipController::class);
        Route::resource('keterangans', KeteranganController::class);
        Route::resource('kkeamanans', KkeamananController::class);
        Route::get('/account-dashboard', [AccdashController::class, 'index'])->name('accdash');
        Route::get('/knowledge/{id}', [LandingController::class, 'show'])->name('knows-detail');
        Route::get('/learning/{id}', [LandingController::class, 'showlearn'])->name('learns-detail');
        Route::get('/checkout/{id}', Checkout::class)->name('checkout');
        Route::get('/my-profile', [ProfileController::class, 'index'])->name('my-profile');
        Route::get('/my-knowledge', [KnowController::class, 'index'])->name('my-knowledge');
        Route::get('/my-learning', [LearnController::class, 'index'])->name('my-learning');
        Route::get('/my-quiz', Quiz::class)->name('my-quiz');
        Route::get('/my-quiz-detail/{id}', Quizdetail::class)->name('my-quiz-detail');
        Route::get('/learn-dashboard', [LearnDashController::class, 'index'])->name('learn-dashboard');
        Route::get('/know-dashboard', [KnowDashController::class, 'index'])->name('know-dashboard');
        
        Route::get('/admin/learning', Learningadmin::class)->name('adminlearning');
        Route::get('/admin/sectionmodule', Sectionmodule::class)->name('sectionmodule');
        Route::get('/admin/knowledge', Knowledgeadmin::class)->name('knowledge');
        Route::get('/admin/approve', Approveknowledge::class)->name('approve');
        Route::get('/admin/request', Requestknowledge::class)->name('request');
        Route::get('/view/{id}', [LandingController::class, 'view'])->name('view');
        Route::post('requestlanding', [LandingController::class, 'requestlanding'])->name('requestlanding');
        Route::get('/admin/permission', Permission::class)->name('permission');
        Route::get('/admin/topic', TopicLivewire::class)->name('topic');
        Route::get('/admin/category', CategoryLivewire::class)->name('category');
        Route::get('/admin/ws', WsLivewire::class)->name('ws');
        Route::get('/admin/divisi', DivisiLivewire::class)->name('divisi');
    });
