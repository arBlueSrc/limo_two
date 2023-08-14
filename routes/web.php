<?php

use App\Http\Controllers\chooseController;
use App\Http\Controllers\CompetitionRegistrationFormsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserFormController;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
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
    return view('home');
})->name('home');

//Route::get('sendSMS',[\App\Http\Controllers\SMSController::class,'sendSms']);
Route::get('sendSingleResultSms',[\App\Http\Controllers\SMSController::class,'sendSingleResultSms']);





Route::get('/dashboard', function () {
    return Redirect::to(url('/admin'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')->group(function () {

    Route::middleware(['auth', 'can:is_ostani_admin'])->group(function () {

        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');

        //group routes
        Route::get('/group/', [\App\Http\Controllers\GroupController::class, 'index'])->name('group.index');
        Route::post('group/search', [\App\Http\Controllers\GroupController::class, 'filterUsers'])->name('group.search');
        Route::get('group/search/show', [\App\Http\Controllers\GroupController::class, 'filterGroupsShow'])->name('group.search.show');
        Route::get('/group/show/{user}', [\App\Http\Controllers\GroupController::class, 'show'])->name('group.show');
        Route::get('group/export/allgroupss', [\App\Http\Controllers\GroupController::class, 'exportAllGroups'])->name('excel.allgroups.download');

        //user
        Route::resource('user', 'App\Http\Controllers\UserController');
        Route::get('users/ostanUsers', [UserController::class, 'ostanUsers'])->name('users.ostanUsers');
        Route::post('users/search', [UserController::class, 'filterUsers'])->name('users.search');
        Route::get('users/search/show', [UserController::class, 'filterUsersShow'])->name('users.search.show');
        Route::get('users/exportExcel', [UserController::class, 'exportExcel'])->name('users.exportExcel');
        Route::get('form/edit', [UserFormController::class, 'edit'])->name('form.edit');
        Route::post('form/update', [UserFormController::class, 'update'])->name('form.update');


        //family routes
        Route::get('family', [\App\Http\Controllers\FamilyController::class, 'index'])->name('family.index');
        Route::post('family/search', [\App\Http\Controllers\FamilyController::class, 'filterUsers'])->name('family.search');
        Route::get('family/search/show', [\App\Http\Controllers\FamilyController::class, 'filterFamiliesShow'])->name('family.search.show');
        Route::get('/family/show/{user}', [\App\Http\Controllers\FamilyController::class, 'show'])->name('family.show');
        Route::get('family/export/allfamilies', [\App\Http\Controllers\FamilyController::class, 'exportAllFamilies'])->name('excel.allfamilies.download');



    });


    Route::middleware(['auth', 'can:is_participant'])->group(function () {

        Route::get('/participate', [\App\Http\Controllers\ParticipateController::class, 'index'])->name('participate');

    });
});






Route::middleware('auth')->group(function () {

    Route::get('users/export', [UserController::class, 'export'])->name('excel.download');
    Route::get('users/export/allusers', [UserController::class, 'exportAllUsers'])->name('excel.allusers.download');

    //forms_Competition
    Route::get('/singleForm', [CompetitionRegistrationFormsController::class, 'individualForm'])->middleware('single-form')->name('single');
    Route::get('/groupForm', [CompetitionRegistrationFormsController::class, 'groupForm'])->name("group");
    Route::get('/familyForm', [CompetitionRegistrationFormsController::class, 'familyForm'])->name("family");

    //check response
    Route::post('checkResponseSingle', [UserFormController::class, 'checkResponseSingle'])->middleware('single-form')->name('checkResponseSingle');
    Route::post('checkResponseGroup', [UserFormController::class, 'checkResponseGroup'])->name('checkResponseGroup');
    Route::post('checkResponseFamily', [UserFormController::class, 'checkResponseFamily'])->name('checkResponseFamily');
    Route::get('/form-complete', [UserFormController::class, 'showFormComplete'])->name('form.complete');

    //edit check response
    Route::post('checkResponseSingleEdit', [UserFormController::class, 'checkResponseSingleEdit'])->name('checkResponseSingleEdit');
    Route::post('checkResponseGroupEdit', [UserFormController::class, 'checkResponseGroupEdit'])->name('checkResponseGroupEdit');
    Route::post('checkResponseFamilyEdit', [UserFormController::class, 'checkResponseFamilyEdit'])->name('checkResponseFamilyEdit');

    //edit forms
    Route::get('/singleEdit/{id}', [UserFormController::class, 'singleEdit'])->name('singleEdit');
    Route::get('/groupEdit/{id}', [UserFormController::class, 'groupEdit'])->name('groupEdit');
    Route::get('/familyEdit/{id}', [UserFormController::class, 'familyEdit'])->name('familyEdit');

    //choose category
    Route::get('/choose', [chooseController::class, 'catgory'])->name('choose');
    Route::get('/showForm', [UserFormController::class, 'showForm'])->name('show_form');
//    Route::get('/showFormEdit', [UserFormController::class, 'showFormEdit'])->name('showFormEdit');

});






Route::post('get-child-shahrestans',[CompetitionRegistrationFormsController::class,'getChildShahrestans']);
Route::post('get-related-masjeds',[CompetitionRegistrationFormsController::class,'getRelatedMasjeds']);

Route::get('/aaa', function (){
    $user=auth()->user();
    $user=User::where('mobile','09380969944')->first();
    Notification::send($user,new \App\Notifications\SendCodeNotification(rand(1111,9999)));
});


require __DIR__ . '/auth.php';



