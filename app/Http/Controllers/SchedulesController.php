<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;  //ここを追加
use App\Schedule;  //ここを追加
use App\Guest;  //ここを追加
use App\GuestSchedules;  //ここを追加
use Illuminate\Support\Facades\DB;  //ここを追加

class SchedulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'name' => 'required',
        ]);
        
        //新規ゲスト作成
        $guest = new Guest;
        $guest->event_id = $id;
        $guest->name = $request->name;
        $guest->save();
        
        // ゲストスケジュールの作成へリダイレクトさせる
        return redirect()->route('guest_schedules.store', ['id' => $id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($token)
    {
        //tokenの値でidを検索
        $event = Event::where('token', $token)->first();
        $id = $event->id;
        
        // idの値でイベントを検索して取得
        $event = Event::findOrFail($id);
        
        // 親に紐づいたscheduleのテーブルを取得
        $schedules = Event::findOrFail($id)->schedules;

        // メッセージ詳細ビューでそれを表示
        return view('schedules.show', [
            'event' => $event,
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //該当IDのデータがなかったら作成、あったらそのまま表示
        $guest_schedules = GuestSchedules::firstOrCreate([
            'id' => $id
        ], [
            'schedule_id'   => 1,
            'guest_id'   => 'firstOrCreate()とは...',
            'preferred'   => ''
        ]);
        
        // idの値でイベントを検索して取得
        $event = Event::findOrFail($id);

        // 日程編集ビューでそれを表示
        return view('events.edit', [
            'event' => $event,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
