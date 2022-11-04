<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Event;  //ここを追加
use App\Schedule;  //ここを追加
use App\Guest;  //ここを追加
use App\GuestSchedule;  //ここを追加
use Illuminate\Support\Facades\DB;  //ここを追加

class GuestSchedulesController extends Controller
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
    public function store($token, $guest_id)
    {
        //tokenの値でidを検索
        $event = Event::where('token', $token)->first();
        $id = $event->id;
        
        //イベントIDを元にスケジュールIDの呼び出し
        $schedules = Event::findOrFail($id)->schedules;
        
        //該当IDのデータがなかったら作成、あったらそのまま表示
        foreach ($schedules as $schedule) {
            $guest_schedules = GuestSchedule::firstOrCreate([
                'schedule_id' => $schedule->id,
                'guest_id' => $guest_id,
            ], [
                'schedule_id'   => $schedule->id,
                'guest_id'   => $guest_id,
                'preferred'   => ''
            ]);
        }
        
        // 更新用ページへリダイレクトさせる
        return redirect()->route('guest_schedules.edit', ['token' => $token , 'guest_id' => $guest_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($token, $guest_id)
    {
        //tokenの値でidを検索
        $event = Event::where('token', $token)->first();
        $id = $event->id;
        
        // idの値でイベントを検索して取得
        $event = Event::findOrFail($id);
        
        // idの値でゲストを検索して取得
        $guest = Guest::findOrFail($guest_id);
        
        // 親に紐づいたschedulesのテーブルを取得
        $schedules = Event::findOrFail($id)->schedules;
        
        // メッセージ編集ビューでそれを表示
        return view('guest_schedules.edit', [
            'event' => $event,
            'schedules' => $schedules,
            'guest' => $guest,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $token,$guest_id,$schedule_id)
    {
        //ゲストスケジュール取得
        $guest_schedules = GuestSchedule::where('guest_id', $guest_id)->where('schedule_id', $schedule_id)->first();
        
        // ゲストスケジュールを更新
        $guest_schedules->preferred = $request->preferred;
        $guest_schedules->save();
        
        // editページへリダイレクトさせる
        return redirect()->route('guest_schedules.edit', ['token' => $token , 'guest_id' => $guest_id]);
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
