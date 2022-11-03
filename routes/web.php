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

// CRUD
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

