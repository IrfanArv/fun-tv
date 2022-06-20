<?php

use App\Events\PushQuiz;
use Illuminate\Support\Facades\Route;


Route::get('players/login', 'Auth\PlayerAuthController@getLogin')->name('players.login');
Route::post('players/login', 'Auth\PlayerAuthController@postLogin');
Route::post('players/logout', 'Auth\PlayerAuthController@postLogout')->name('players.logout');


Route::middleware('auth:players')->group(function(){
    Route::get('/', 'MainController@index');
    // Route::get('/', function () {
    //     PushQuiz::dispatch('hello');
    //     return 'MainController@index';
    // });
});



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
    // Route::resource('trivia-quiz', Backpage\QuestionController::class);
    // quiz by rooms
    Route::get('/rooms/trivia-quiz/{id}', 'Backpage\QuestionController@question_by_rooms')->name('quiz_by_room');
    // players by rooms
    Route::get('/rooms/players/{id}', 'Backpage\PlayerController@player_by_rooms')->name('players_by_room');
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
