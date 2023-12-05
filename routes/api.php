<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\KidController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\TribeController;
use App\Http\Controllers\Api\AwardController;
use App\Http\Controllers\Api\ExsumController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\GenderController;
use App\Http\Controllers\Api\WifhusController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\JurnalController;
use App\Http\Controllers\Api\MaritalController;
use App\Http\Controllers\Api\SpeakerController;
use App\Http\Controllers\Api\UserKidsController;
use App\Http\Controllers\Api\CityKidsController;
use App\Http\Controllers\Api\ReligionController;
use App\Http\Controllers\Api\PositionController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DivisionController;
use App\Http\Controllers\Api\CityUsersController;
use App\Http\Controllers\Api\BloodtypeController;
use App\Http\Controllers\Api\ValvisionController;
use App\Http\Controllers\Api\BumnclassController;
use App\Http\Controllers\Api\KnowledgeController;
use App\Http\Controllers\Api\UserAwardsController;
use App\Http\Controllers\Api\GenderKidsController;
use App\Http\Controllers\Api\TribeUsersController;
use App\Http\Controllers\Api\UniversityController;
use App\Http\Controllers\Api\BumnsectorController;
use App\Http\Controllers\Api\EduhistoryController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserSocialsController;
use App\Http\Controllers\Api\GenderUsersController;
use App\Http\Controllers\Api\ExplanationController;
use App\Http\Controllers\Api\UserWifhusesController;
use App\Http\Controllers\Api\UserSpeakersController;
use App\Http\Controllers\Api\MaritalUsersController;
use App\Http\Controllers\Api\CityWifhusesController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\UserPositionsController;
use App\Http\Controllers\Api\UserInterestsController;
use App\Http\Controllers\Api\UserLearningsController;
use App\Http\Controllers\Api\ReligionUsersController;
use App\Http\Controllers\Api\UserValvisionsController;
use App\Http\Controllers\Api\UserKnowledgesController;
use App\Http\Controllers\Api\GenderWifhusesController;
use App\Http\Controllers\Api\BloodtypeUsersController;
use App\Http\Controllers\Api\BumnclassUsersController;
use App\Http\Controllers\Api\UserBumnsectorsController;
use App\Http\Controllers\Api\UserBumnclassesController;
use App\Http\Controllers\Api\FieldofpositionController;
use App\Http\Controllers\Api\BumnsectorUsersController;
use App\Http\Controllers\Api\KnowledgeExsumsController;
use App\Http\Controllers\Api\TopicKnowledgesController;
use App\Http\Controllers\Api\UserEduhistoriesController;
use App\Http\Controllers\Api\CityEduhistoriesController;
use App\Http\Controllers\Api\KnowledgeReportsController;
use App\Http\Controllers\Api\KnowledgeJurnalsController;
use App\Http\Controllers\Api\UserOrganizationsController;
use App\Http\Controllers\Api\UserReqknowledgesController;
use App\Http\Controllers\Api\UserLTransactionsController;
use App\Http\Controllers\Api\DivisionPositionsController;
use App\Http\Controllers\Api\ExsumReqknowledgesController;
use App\Http\Controllers\Api\CategoryKnowledgesController;
use App\Http\Controllers\Api\ReportReqknowledgesController;
use App\Http\Controllers\Api\JurnalReqknowledgesController;
use App\Http\Controllers\Api\KnowledgeExplanationsController;
use App\Http\Controllers\Api\UniversityEduhistoriesController;
use App\Http\Controllers\Api\FieldofpositionPositionsController;
use App\Http\Controllers\Api\ExplanationReqknowledgesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('users', UserController::class);

        // User Socials
        Route::get('/users/{user}/socials', [
            UserSocialsController::class,
            'index',
        ])->name('users.socials.index');
        Route::post('/users/{user}/socials', [
            UserSocialsController::class,
            'store',
        ])->name('users.socials.store');

        // User Awards
        Route::get('/users/{user}/awards', [
            UserAwardsController::class,
            'index',
        ])->name('users.awards.index');
        Route::post('/users/{user}/awards', [
            UserAwardsController::class,
            'store',
        ])->name('users.awards.store');

        // User Eduhistories
        Route::get('/users/{user}/eduhistories', [
            UserEduhistoriesController::class,
            'index',
        ])->name('users.eduhistories.index');
        Route::post('/users/{user}/eduhistories', [
            UserEduhistoriesController::class,
            'store',
        ])->name('users.eduhistories.store');

        // User Wifhuses
        Route::get('/users/{user}/wifhuses', [
            UserWifhusesController::class,
            'index',
        ])->name('users.wifhuses.index');
        Route::post('/users/{user}/wifhuses', [
            UserWifhusesController::class,
            'store',
        ])->name('users.wifhuses.store');

        // User Kids
        Route::get('/users/{user}/kids', [
            UserKidsController::class,
            'index',
        ])->name('users.kids.index');
        Route::post('/users/{user}/kids', [
            UserKidsController::class,
            'store',
        ])->name('users.kids.store');

        // User Positions
        Route::get('/users/{user}/positions', [
            UserPositionsController::class,
            'index',
        ])->name('users.positions.index');
        Route::post('/users/{user}/positions', [
            UserPositionsController::class,
            'store',
        ])->name('users.positions.store');

        // User Organizations
        Route::get('/users/{user}/organizations', [
            UserOrganizationsController::class,
            'index',
        ])->name('users.organizations.index');
        Route::post('/users/{user}/organizations', [
            UserOrganizationsController::class,
            'store',
        ])->name('users.organizations.store');

        // User Speakers
        Route::get('/users/{user}/speakers', [
            UserSpeakersController::class,
            'index',
        ])->name('users.speakers.index');
        Route::post('/users/{user}/speakers', [
            UserSpeakersController::class,
            'store',
        ])->name('users.speakers.store');

        // User Interests
        Route::get('/users/{user}/interests', [
            UserInterestsController::class,
            'index',
        ])->name('users.interests.index');
        Route::post('/users/{user}/interests', [
            UserInterestsController::class,
            'store',
        ])->name('users.interests.store');

        // User Valvisions
        Route::get('/users/{user}/valvisions', [
            UserValvisionsController::class,
            'index',
        ])->name('users.valvisions.index');
        Route::post('/users/{user}/valvisions', [
            UserValvisionsController::class,
            'store',
        ])->name('users.valvisions.store');

        // User Knowledges
        Route::get('/users/{user}/knowledges', [
            UserKnowledgesController::class,
            'index',
        ])->name('users.knowledges.index');
        Route::post('/users/{user}/knowledges', [
            UserKnowledgesController::class,
            'store',
        ])->name('users.knowledges.store');

        // User Reqknowledges
        Route::get('/users/{user}/reqknowledges', [
            UserReqknowledgesController::class,
            'index',
        ])->name('users.reqknowledges.index');
        Route::post('/users/{user}/reqknowledges', [
            UserReqknowledgesController::class,
            'store',
        ])->name('users.reqknowledges.store');

        // User Learnings
        Route::get('/users/{user}/learnings', [
            UserLearningsController::class,
            'index',
        ])->name('users.learnings.index');
        Route::post('/users/{user}/learnings', [
            UserLearningsController::class,
            'store',
        ])->name('users.learnings.store');

        // User L Transactions
        Route::get('/users/{user}/l-transactions', [
            UserLTransactionsController::class,
            'index',
        ])->name('users.l-transactions.index');
        Route::post('/users/{user}/l-transactions', [
            UserLTransactionsController::class,
            'store',
        ])->name('users.l-transactions.store');

        // User Bumnsectors
        Route::get('/users/{user}/bumnsectors', [
            UserBumnsectorsController::class,
            'index',
        ])->name('users.bumnsectors.index');
        Route::post('/users/{user}/bumnsectors/{bumnsector}', [
            UserBumnsectorsController::class,
            'store',
        ])->name('users.bumnsectors.store');
        Route::delete('/users/{user}/bumnsectors/{bumnsector}', [
            UserBumnsectorsController::class,
            'destroy',
        ])->name('users.bumnsectors.destroy');

        // User Bumnclasses
        Route::get('/users/{user}/bumnclasses', [
            UserBumnclassesController::class,
            'index',
        ])->name('users.bumnclasses.index');
        Route::post('/users/{user}/bumnclasses/{bumnclass}', [
            UserBumnclassesController::class,
            'store',
        ])->name('users.bumnclasses.store');
        Route::delete('/users/{user}/bumnclasses/{bumnclass}', [
            UserBumnclassesController::class,
            'destroy',
        ])->name('users.bumnclasses.destroy');

        Route::apiResource('maritals', MaritalController::class);

        // Marital Users
        Route::get('/maritals/{marital}/users', [
            MaritalUsersController::class,
            'index',
        ])->name('maritals.users.index');
        Route::post('/maritals/{marital}/users', [
            MaritalUsersController::class,
            'store',
        ])->name('maritals.users.store');

        Route::apiResource('cities', CityController::class);

        // City Users
        Route::get('/cities/{city}/users', [
            CityUsersController::class,
            'index',
        ])->name('cities.users.index');
        Route::post('/cities/{city}/users', [
            CityUsersController::class,
            'store',
        ])->name('cities.users.store');

        // City Eduhistories
        Route::get('/cities/{city}/eduhistories', [
            CityEduhistoriesController::class,
            'index',
        ])->name('cities.eduhistories.index');
        Route::post('/cities/{city}/eduhistories', [
            CityEduhistoriesController::class,
            'store',
        ])->name('cities.eduhistories.store');

        // City Wifhuses
        Route::get('/cities/{city}/wifhuses', [
            CityWifhusesController::class,
            'index',
        ])->name('cities.wifhuses.index');
        Route::post('/cities/{city}/wifhuses', [
            CityWifhusesController::class,
            'store',
        ])->name('cities.wifhuses.store');

        // City Kids
        Route::get('/cities/{city}/kids', [
            CityKidsController::class,
            'index',
        ])->name('cities.kids.index');
        Route::post('/cities/{city}/kids', [
            CityKidsController::class,
            'store',
        ])->name('cities.kids.store');

        Route::apiResource('genders', GenderController::class);

        // Gender Users
        Route::get('/genders/{gender}/users', [
            GenderUsersController::class,
            'index',
        ])->name('genders.users.index');
        Route::post('/genders/{gender}/users', [
            GenderUsersController::class,
            'store',
        ])->name('genders.users.store');

        // Gender Wifhuses
        Route::get('/genders/{gender}/wifhuses', [
            GenderWifhusesController::class,
            'index',
        ])->name('genders.wifhuses.index');
        Route::post('/genders/{gender}/wifhuses', [
            GenderWifhusesController::class,
            'store',
        ])->name('genders.wifhuses.store');

        // Gender Kids
        Route::get('/genders/{gender}/kids', [
            GenderKidsController::class,
            'index',
        ])->name('genders.kids.index');
        Route::post('/genders/{gender}/kids', [
            GenderKidsController::class,
            'store',
        ])->name('genders.kids.store');

        Route::apiResource('religions', ReligionController::class);

        // Religion Users
        Route::get('/religions/{religion}/users', [
            ReligionUsersController::class,
            'index',
        ])->name('religions.users.index');
        Route::post('/religions/{religion}/users', [
            ReligionUsersController::class,
            'store',
        ])->name('religions.users.store');

        Route::apiResource('bloodtypes', BloodtypeController::class);

        // Bloodtype Users
        Route::get('/bloodtypes/{bloodtype}/users', [
            BloodtypeUsersController::class,
            'index',
        ])->name('bloodtypes.users.index');
        Route::post('/bloodtypes/{bloodtype}/users', [
            BloodtypeUsersController::class,
            'store',
        ])->name('bloodtypes.users.store');

        Route::apiResource('tribes', TribeController::class);

        // Tribe Users
        Route::get('/tribes/{tribe}/users', [
            TribeUsersController::class,
            'index',
        ])->name('tribes.users.index');
        Route::post('/tribes/{tribe}/users', [
            TribeUsersController::class,
            'store',
        ])->name('tribes.users.store');

        Route::apiResource(
            'fieldofpositions',
            FieldofpositionController::class
        );

        // Fieldofposition Positions
        Route::get('/fieldofpositions/{fieldofposition}/positions', [
            FieldofpositionPositionsController::class,
            'index',
        ])->name('fieldofpositions.positions.index');
        Route::post('/fieldofpositions/{fieldofposition}/positions', [
            FieldofpositionPositionsController::class,
            'store',
        ])->name('fieldofpositions.positions.store');

        Route::apiResource('universities', UniversityController::class);

        // University Eduhistories
        Route::get('/universities/{university}/eduhistories', [
            UniversityEduhistoriesController::class,
            'index',
        ])->name('universities.eduhistories.index');
        Route::post('/universities/{university}/eduhistories', [
            UniversityEduhistoriesController::class,
            'store',
        ])->name('universities.eduhistories.store');

        Route::apiResource('valvisions', ValvisionController::class);

        Route::apiResource('bumnclasses', BumnclassController::class);

        // Bumnclass Users
        Route::get('/bumnclasses/{bumnclass}/users', [
            BumnclassUsersController::class,
            'index',
        ])->name('bumnclasses.users.index');
        Route::post('/bumnclasses/{bumnclass}/users/{user}', [
            BumnclassUsersController::class,
            'store',
        ])->name('bumnclasses.users.store');
        Route::delete('/bumnclasses/{bumnclass}/users/{user}', [
            BumnclassUsersController::class,
            'destroy',
        ])->name('bumnclasses.users.destroy');

        Route::apiResource('bumnsectors', BumnsectorController::class);

        // Bumnsector Users
        Route::get('/bumnsectors/{bumnsector}/users', [
            BumnsectorUsersController::class,
            'index',
        ])->name('bumnsectors.users.index');
        Route::post('/bumnsectors/{bumnsector}/users/{user}', [
            BumnsectorUsersController::class,
            'store',
        ])->name('bumnsectors.users.store');
        Route::delete('/bumnsectors/{bumnsector}/users/{user}', [
            BumnsectorUsersController::class,
            'destroy',
        ])->name('bumnsectors.users.destroy');

        Route::apiResource('knowledges', KnowledgeController::class);

        // Knowledge Reports
        Route::get('/knowledges/{knowledge}/reports', [
            KnowledgeReportsController::class,
            'index',
        ])->name('knowledges.reports.index');
        Route::post('/knowledges/{knowledge}/reports', [
            KnowledgeReportsController::class,
            'store',
        ])->name('knowledges.reports.store');

        // Knowledge Exsums
        Route::get('/knowledges/{knowledge}/exsums', [
            KnowledgeExsumsController::class,
            'index',
        ])->name('knowledges.exsums.index');
        Route::post('/knowledges/{knowledge}/exsums', [
            KnowledgeExsumsController::class,
            'store',
        ])->name('knowledges.exsums.store');

        // Knowledge Explanations
        Route::get('/knowledges/{knowledge}/explanations', [
            KnowledgeExplanationsController::class,
            'index',
        ])->name('knowledges.explanations.index');
        Route::post('/knowledges/{knowledge}/explanations', [
            KnowledgeExplanationsController::class,
            'store',
        ])->name('knowledges.explanations.store');

        // Knowledge Jurnals
        Route::get('/knowledges/{knowledge}/jurnals', [
            KnowledgeJurnalsController::class,
            'index',
        ])->name('knowledges.jurnals.index');
        Route::post('/knowledges/{knowledge}/jurnals', [
            KnowledgeJurnalsController::class,
            'store',
        ])->name('knowledges.jurnals.store');

        Route::apiResource('categories', CategoryController::class);

        // Category Knowledges
        Route::get('/categories/{category}/knowledges', [
            CategoryKnowledgesController::class,
            'index',
        ])->name('categories.knowledges.index');
        Route::post('/categories/{category}/knowledges', [
            CategoryKnowledgesController::class,
            'store',
        ])->name('categories.knowledges.store');

        Route::apiResource('topics', TopicController::class);

        // Topic Knowledges
        Route::get('/topics/{topic}/knowledges', [
            TopicKnowledgesController::class,
            'index',
        ])->name('topics.knowledges.index');
        Route::post('/topics/{topic}/knowledges', [
            TopicKnowledgesController::class,
            'store',
        ])->name('topics.knowledges.store');

        Route::apiResource('divisions', DivisionController::class);

        // Division Positions
        Route::get('/divisions/{division}/positions', [
            DivisionPositionsController::class,
            'index',
        ])->name('divisions.positions.index');
        Route::post('/divisions/{division}/positions', [
            DivisionPositionsController::class,
            'store',
        ])->name('divisions.positions.store');
    });
