<?php

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

// イベント関連
// create: 新規作成用のフォームページ
Route::get('/events/create', 'EventsController@create')->name('events.create');

// イベントの新規登録を処理（新規登録画面を表示するためのものではありません）
Route::post('/events/store', 'EventsController@store')->name('events.store');

//登録後、完了画面を表示
Route::get('/events/{id}/complete', "EventsController@complete")->name("events.complete");

// edit: 更新用のフォームページ
Route::get('/events/{id}/edit', 'EventsController@edit')->name('events.edit');

// イベントの更新処理（編集画面を表示するためのものではありません）
Route::put('/events/{id}', 'EventsController@update')->name('events.update');

// show:日程追加用のフォームページ表示
Route::get('/events/{token}/show', 'EventsController@show')->name('events.show');

// show:ゲストを追加
Route::post('/guests/store', 'GuestsController@store')->name('guests.store');

// store:ゲストスケジュールの追加もしくはそのまま進む
Route::get('/guest_schedules/{token}/{guest_id}/store', 'GuestSchedulesController@store')->name('guest_schedules.store');

//ゲストコメント・ゲストスケジュールの更新ページへ遷移
Route::get('/guest_schedules/{token}/{guest_id}/edit', 'GuestSchedulesController@edit')->name('guest_schedules.edit');

//ゲストスケジュールの更新
Route::post('/guest_schedules/{token}/{guest_id}/{schedule_id}/update', 'GuestSchedulesController@update')->name('guest_schedules.update');

//ゲストコメントの更新
Route::put('/guest/{guest_id}/update', 'GuestsController@update')->name('guests.update');