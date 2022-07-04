<?php

use App\Events\PushQuiz;
use Illuminate\Support\Facades\Route;

// auth
Route::get('players/login', 'Auth\PlayerAuthController@getLogin')->name('players.login');
Route::post('players/login', 'Auth\PlayerAuthController@postLogin');
Route::post('players/logout', 'Auth\PlayerAuthController@postLogout')->name('players.logout');
Route::get('players/register', 'Auth\PlayerAuthController@getRegister')->name('players.register');
Route::post('players/register', 'Auth\PlayerAuthController@postRegister');
// end auth
// otp
Route::get('get-otp', 'Auth\PlayerAuthController@getOTP')->name('players.otp');
Route::post('get-otp', 'Auth\PlayerAuthController@postOTP');
// end otp
// profile
Route::post('update-profile', 'MainController@updateProfile')->name('players.update');
Route::post('available-user', 'MainController@user_check');
Route::post('save-profile', 'MainController@saveProfile');
// end profile
// index
Route::get('/', 'MainController@index')->name('home');
// question
Route::get('questions', 'QuestController@index')->name('quest');
Route::post('questions', 'QuestController@postAnswer');
// lead
Route::get('leadboard', 'QuestController@leadboard');



// Route::middleware('auth:players')->group(function(){
//     Route::get('/watch', 'MainController@watch');
// });

// administrator area
Auth::routes();
Route::group([
    'name' => 'dashboard.',
    'prefix' => 'dashboard',
    'middleware' => 'auth'
], function () {
    Route::resource('/', Backpage\Dashboard::class);
    Route::resource('roles', Backpage\RoleController::class);
    Route::resource('users', Backpage\UserController::class);
    Route::resource('rooms', Backpage\RoomController::class);
    Route::get('/players', 'Backpage\PlayerController@index');
    // Route::resource('playres', Backpage\PlayerController::class);
    // Route::resource('trivia-quiz', Backpage\QuestionController::class);
    // quiz by rooms
    Route::get('/rooms/trivia-quiz/{id}', 'Backpage\QuestionController@question_by_rooms')->name('quiz_by_room');
    // players by rooms
    // Route::get('/rooms/players/{id}', 'Backpage\PlayerController@player_by_rooms')->name('players_by_room');
    // save player
    Route::post('players/store', 'Backpage\PlayerController@store');
    // question
    Route::post('trivia-quiz/store', 'Backpage\QuestionController@store');
    // run quiz
    Route::get('run-quiz/{id}', 'Backpage\Dashboard@run_quiz');
    // stop quiz
    Route::get('stop-quiz/{id}', 'Backpage\Dashboard@stop_quiz');
    // reset quiz
    Route::get('reset-quiz/{id}', 'Backpage\Dashboard@reset_quiz');
});
